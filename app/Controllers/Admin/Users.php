<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Validation\ValidationRules as ShieldValidationRules;
use Exception;

class Users extends BaseController
{
    private bool $active = false;

    /** @var string[] */
    private array $groups = [];

    /** @var string[] */
    private array $permissions = [];

    private bool $already_sync = false;

    public function index(): string | RedirectResponse
    {
        if (!auth()->user()->can('users.access', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar usuários.');

        $limit = $this->request->getPost('limit') ?? 10;
        $order_by = $this->request->getPost('order_by') ?? 'id';
        $order = $this->request->getPost('order') ?? 'ASC';

        $model = auth()->getProvider();
        $users = $model->select(['id', 'username', 'active', 'created_at'])
            ->orderBy($order_by, $order)
            ->paginate($limit);

        return view('admin/users/index', ['users' => $users, 'pager' => $model->pager]);
    }

    public function createView(): string | RedirectResponse
    {
        if (!auth()->user()->can('users.create', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar usuários.');

        return view('admin/users/form');
    }

    public function editView(int $id): string | RedirectResponse
    {
        if (!auth()->user()->can('users.edit', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar usuários.');

        return view('admin/users/form', [
            'user' => auth()->getProvider()->findById($id)
        ]);
    }

    public function createAction(): RedirectResponse
    {
        if (!auth()->user()->can('users.create', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar usuários.');

        if ($this->already_sync) $this->already_sync = false;
        $rules = self::getValidationRules();
        $data = $this->request->getPost();

        if (! $this->validateData($data, $rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $users = auth()->getProvider();

        $user = new User([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => $data['password']
        ]);

        try{
            $users->save($user);
            if (auth()->user()->can('admin.manage')) {
                $user = $users->findById($users->getInsertID());
                $users->addToDefaultGroup($user);
                $this->syncUser($user);
            }
            return redirect()->route('users')->with('message', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            return self::logUnexpectedError($e);
        }
    }

    public function editAction(int $id): RedirectResponse
    {
        if (!auth()->user()->can('users.edit', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar usuários.');

        if ($this->already_sync) $this->already_sync = false;
        $rules = self::getValidationRules();
        $data = $this->request->getPost();

        $users = auth()->getProvider();

        $user = $users->findById($id);
        $changed = [
            'username' => false,
            'email'    => false,
            'password' => false
        ];

        if ($data['username'] == $user->username) unset($rules['username']);
        else $changed['username'] = true;

        if ($data['email'] == $user->email) unset($rules['email']);
        else $changed['email'] = true;

        if (!$data['password']) unset($rules['password']);
        else $changed['password'] = true;

        if ($changed['username'] || $changed['email'] || $changed['password']) {
            if (! $this->validateData($data, $rules))
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        if ( $changed['username'] ) $user->fill(['username' => $data['username']]);
        if ( $changed['email']    ) $user->setEmail($data['email']);
        if ( $changed['password'] ) $user->setPassword($data['password']);
        try {
            $users->save($user);
            if (auth()->user()->can('admin.manage'))
                $this->syncUser($user);
            return redirect()->route('users')->with('message', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            return self::logUnexpectedError($e);
        }
    }

    public function removeAction(int $id): RedirectResponse
    {
        if (!auth()->user()->can('users.delete', 'admin.manage'))
            return redirect()->back()->with('error', 'Você não tem permissão para remover usuários.');
        try {
            auth()->getProvider()->delete($id);
            return redirect()->back()->with('message', 'Usuário removido com sucesso.');
        } catch (Exception $e) {
            return self::logUnexpectedError($e);
        }
    }

    private function syncUser(User $user): void
    {
        $this->sync();

        if ($this->active) $user->activate();
        if ($this->groups) $user->syncGroups(...$this->groups);
        if ($this->permissions) $user->syncPermissions(...$this->permissions);
    }

    private function sync(): void
    {
        if ($this->already_sync) return;
        else $this->already_sync = true;

        $groups = setting('AuthGroups.groups');
        $permissions = setting('AuthGroups.permissions');
        unset($groups['user']);

        $user_groups = ['user'];
        $user_permissions = [];

        foreach (array_keys($groups) as $group)
            if ($this->request->getPost('group_'.$group)) $user_groups[] = $group;

        foreach (array_keys($permissions) as $permission)
            if ($this->request->getPost('permission_'.str_replace('.', '-', $permission))) $user_permissions[] = $permission;

        $this->active = $this->request->getPost('active') === true;
        $this->permissions = $user_permissions;
        $this->groups = $user_groups;
    }

    private static function getValidationRules(): array
    {
        $rules = (new ShieldValidationRules())->getRegistrationRules();

        unset($rules['password_confirm']);
        return $rules;
    }

    private static function logUnexpectedError(Exception $e): RedirectResponse
    {
        log_message('critical', $e->getMessage());
        if (auth()->user()->inGroup('developer'))
            return redirect()->back()->with('error', $e->getMessage());
        return redirect()->back()->with('error', 'Erro no servidor, favor contatar o suporte.');
    }
}


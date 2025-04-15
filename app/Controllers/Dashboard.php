<?php

namespace App\Controllers;

use App\Entities\CompleteUserEntity;
use App\Entities\UserComplementEntity;
use App\Libraries\FileManager;
use App\Models\UserComplementModel;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class Dashboard extends BaseController
{
    public function indexView(): RedirectResponse|string
    {

        $model = model(UserComplementModel::class);

        $user = auth()->user();
        $user_id = $user->id;
        $complete_user = $model->findUser($user_id);
        if (!$complete_user)
            $complete_user = new CompleteUserEntity(['username' => $user->username, 'email' => $user->getEmail()]);
        $user_groups = $user->getGroups();
        $group = array_pop($user_groups);
        $group_name = setting('AuthGroups.groups')[$group]['title'];

        return view('auth/dashboard', [
            'user'        => $complete_user,
            'group'       => $group_name,
            'permissions' => $user->getPermissions()
        ]);
    }

    public function indexAction(): RedirectResponse
    {
        $data = $this->request->getPost();
        $uploaded_file_field = 'photo';
        $img = $this->request->getFile($uploaded_file_field);

        $user_id = auth()->user()->id;
        $model = model(UserComplementModel::class);
        /** @var null|UserComplementEntity $user_complement */
        $user_complement = $model->find($user_id);

        /** @var FileManager $file_manager */
        $file_manager = service('file_manager');
        $file_manager_transaction = [];
        $photo = $user_complement?->photo ;
        $name = $data['name'] ?? $user_complement?->name;
        if ($name !== null)
            $data[$uploaded_file_field] = $file_manager::filenameFormat($name).'.user';
        if ($img?->isValid()) {
            if ($name === null)
                return redirect()->back()->withInput()->with('error', "Não é possível salvar uma foto de perfil sem definir o nome completo.");
            if (!$this->validate($file_manager::getRules($uploaded_file_field)))
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

            if ($photo)
                $file_manager_transaction['remove'] = [$photo];

            $data[$uploaded_file_field] .= '.'.$img->getExtension();
            $file_manager_transaction['store'] = [$img, $data[$uploaded_file_field]];
            $file_manager->store($img, $data[$uploaded_file_field]);
        } else if ($name !== null && $user_complement && $user_complement->name !== $name) {
            $data[$uploaded_file_field] .= $file_manager->getExtension($user_complement->photo);
            $file_manager_transaction['rename'] = [
                $user_complement->photo,
                $data[$uploaded_file_field]
            ];
        } else unset($data[$uploaded_file_field]);

        if (!$model->validate($data, true))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        try{
            foreach($file_manager_transaction as $method => $arguments)
                $file_manager->{$method}(...$arguments);
            if ($user_complement)
                $model->update($user_id, $data);
            else
                $model->insert(['user_id' => $user_id, ...$data]);
            return redirect()->back()->with('message', 'Dados salvos com sucesso.');
        } catch (Exception $e) {
            return service('log')::unespectedError($e);
        }
    }
}


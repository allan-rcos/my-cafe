<?php

namespace App\Controllers\Admin;

use App\Enums\AdminViewEnum;
use App\Models\DeliveryItemModel;
use App\Models\UserComplementModel;
use App\Traits\AdminTraits\IndexViewTrait;
use App\Traits\AdminTraits\RemoveActionTrait;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class Delivery extends AdminBaseController
{

    protected $permissions       = [
        'index'  => 'delivery.show',
        'edit'   => 'delivery.edit',
        'remove' => 'delivery.remove'
    ];

    protected $permissionMessages = [
        'index'  => 'Você não tem permissão para visualizar Pedidos',
        'edit'   => 'Você não tem permissão para editar Pedidos',
        'remove' => 'Você não tem permissão para remover Pedidos'
    ];

    protected $successMessages    = [
        'edit'   => 'Pedido editado com sucesso',
        'remove' => 'Pedido removido com sucesso'
    ];

    protected $views = [
        'index' => 'admin/delivery/index',
        'edit'  => 'admin/delivery/form'
    ];

    protected $modelType          = DeliveryItemModel::class;

    protected $table_dir          = 'delivery';
    protected $table_header       = [
        'checkout' => 'Data',
        'user'     => 'Usuário',
        'products' => 'Produtos',
        'total'    => 'Valor Total',
    ];

    protected $redirectRoute       = 'delivery';

    use IndexViewTrait;

    public function editView(int $user_id, string $checked_at): string | RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::EDIT);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        return view($this->views[$view], [
            'itens' => $this->getModel()->findUserDelivery($user_id, $checked_at),
            'user'  => model(UserComplementModel::class)->findUser($user_id)
        ]);
    }

    public function editAction(int $user_id, string $checked_at): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::EDIT);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        $data = $this->request->getPost();

        $model = $this->getModel();

        $rules         = [];
        $messages      = [];
        $to_validate   = [];
        $quantity_rule = $model->getValidationRules()['quantity'];
        $message       = $model->getValidationMessages()['quantity']??null;
        foreach (array_keys($data) as $key) {
            $validation_key = 'quantity_'.((string) $key);
            $to_validate[$validation_key] = $data[$key];
            $rules[$validation_key] = $quantity_rule;
            if ($message) $messages[$validation_key] = $message;
        }

        if (!$this->validateData($to_validate, $rules, $messages))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        try {
            $model->updateMany($data, $user_id, $checked_at);
            return redirect()->route($this->views[$view])->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function editItemQuantityAction(int $id, int $quantity): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::EDIT);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        $data = ['quantity' => $quantity];

        $model = $this->getModel();

        if (!$this->validateData(
                $data,
                ['quantity' => $model->getValidationRules()['quantity']],
                ['quantity' => $model->getValidationMessages()['quantity']]
            )
        )
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        try {
            $model->update($id, $data);
            return redirect()->route($this->views[$view])->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    use RemoveActionTrait {
        RemoveActionTrait::removeAction as removeItemAction;
    }

    public function removeAction(int $user_id, string $checked_at): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::REMOVE);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        try {
            $this->getModel()->where(['user_id' => $user_id, 'checked_at' => $checked_at])->delete();
            return redirect()->back()->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function formatRow(array $row): array
    {
        helper('format');

        $row['checkout'] = time_format($row['checkout']);
        $row['total']    = price_format($row['total']);
        return $row;
    }
}


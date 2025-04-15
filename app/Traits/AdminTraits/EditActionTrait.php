<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

trait EditActionTrait
{
    public function editAction(int $id): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::EDIT);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        $model = $this->getModel();

        $data = $this->request->getPost();

        if (!$model->validate($data, true))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        try {
            $model->update($id, $data);
            return redirect()->route($this->views[$view])->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }
}
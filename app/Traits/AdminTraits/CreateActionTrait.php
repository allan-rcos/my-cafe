<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

trait CreateActionTrait
{
    public function createAction(): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::CREATE);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        $model = $this->getModel();

        $data = $this->request->getPost();

        if (!$model->validate($data))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        try {
            $model->insert($data);
            return redirect()->route($this->redirectRoute)->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }
}
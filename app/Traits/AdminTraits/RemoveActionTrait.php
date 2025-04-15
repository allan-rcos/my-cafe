<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

trait RemoveActionTrait
{
    public function removeAction(int $id): RedirectResponse
    {
        $view = $this->validateConfig(AdminViewEnum::REMOVE);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        try {
            $this->getModel()->delete($id);
            return redirect()->back()->with('message',
                $this->successMessages[$view] ?? $this->defaultSuccessMessage);
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }
}
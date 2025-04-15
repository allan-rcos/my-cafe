<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use CodeIgniter\HTTP\RedirectResponse;

trait EditViewTrait
{
    public function editView(int $id): RedirectResponse|string
    {
        $view = $this->validateConfig(AdminViewEnum::EDIT);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        $model = $this->getModel();

        return view($this->views[$view], [ 'item' => $model->find($id) ]);
    }
}
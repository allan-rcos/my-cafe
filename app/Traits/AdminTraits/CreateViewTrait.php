<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use CodeIgniter\HTTP\RedirectResponse;

trait CreateViewTrait
{
    public function createView(): RedirectResponse | string
    {
        $view = $this->validateConfig(AdminViewEnum::CREATE);

        if ($redirect = $this->checkPermission($view)) return $redirect;

        return view($this->views[$view]);
    }
}
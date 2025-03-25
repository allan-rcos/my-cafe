<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Menu extends BaseController
{
    public function index(): string
    {
        return view('main/menu');
    }
}


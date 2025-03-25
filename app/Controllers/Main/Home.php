<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index(): string
    {
        return view('main/index');
    }
}

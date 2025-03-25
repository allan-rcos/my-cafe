<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index(): string
    {
        return view('main/about');
    }
}

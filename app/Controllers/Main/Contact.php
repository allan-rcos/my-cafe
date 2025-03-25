<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function index(): string
    {
        return view('main/contact');
    }
}


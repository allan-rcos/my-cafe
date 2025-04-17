<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Menu extends BaseController
{
    public function index(): string
    {
        return view('main/menu', ['products' => model(ProductModel::class)->findAllMenu()]);
    }
}


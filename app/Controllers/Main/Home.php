<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('main/index', ['products' => model(ProductModel::class)->findAll(4)]);
    }
}

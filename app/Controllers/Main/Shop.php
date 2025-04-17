<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Shop extends BaseController
{
    public function index(): string
    {

        $categories = model(CategoryModel::class)->findAllSelect('');

        $category_id = $this->request->getGet('category_id') ?? array_key_first($categories);
        $products = model(ProductModel::class)->where('category_id', $category_id)->findAll();

        return view('main/shop', [
            "products"          => $products,
            "categories"        => $categories,
            "selected_category" => $category_id
        ]);
    }

    public function product(int $id): string
    {
        $model = model(ProductModel::class);
        $product = $model->find($id);
        $related = $model->where('category_id', $product->category_id)->where('id != '.$product->id)->findAll(4);

        return view('main/product-single', [
            'product'  => $product,
            'related'  => $related,
            'category' => model(CategoryModel::class)->find($product->id)
        ]);
    }
}


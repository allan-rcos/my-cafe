<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;

class Shop extends BaseController
{
    public function index(): string
    {
        $data = [
            [
                "image_filename" => "menu_1.jpg",
                "name" => "Espresso Tradicional",
                "description" => "Intenso e encorpado, para um despertar clássico.",
                "value" => 5.
            ],
            [
                "image_filename" => "menu_2.jpg",
                "name" => "Cappuccino Cremoso",
                "description" => "Equilíbrio perfeito entre café, leite e espuma.",
                "value" => 8.
            ],
            [
                "image_filename" => "menu_3.jpg",
                "name" => "Mocha Especial",
                "description" => "Chocolate e café, uma combinação irresistível.",
                "value" => 10.
            ],
            [
                "image_filename" => "menu_4.jpg",
                "name" => "Café Gelado Especial",
                "description" => "Refrescante, com toque especial da casa.",
                "value" => 12.
            ],
        ];

        return view('main/shop', ["data" => $data]);
    }
}


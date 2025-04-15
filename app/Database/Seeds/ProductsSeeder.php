<?php

namespace App\DataBase\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{

    public function run(): void
    {
        $now = ( new \DateTime('now') )->format('Y-m-d H:i:s');
        $factories = [
            [
                "name" => "Espresso Tradicional",
                "price" => 5.,
                "filename" => "expresso_tradicional.jpg",
                "description" => "Intenso e encorpado, para um despertar clássico.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Cappuccino Cremoso",
                "price" => 8.,
                "filename" => "cappuccino_cremoso.jpg",
                "description" => "Equilíbrio perfeito entre café, leite e espuma.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Mocha Especial",
                "price" => 10.,
                "filename" => "mocha_especial.jpg",
                "description" => "Chocolate e café, uma combinação irresistível.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Bolo de Cenoura",
                "price" => 10.00,
                "filename" => "bolo_de_cenoura.jpg",
                "description" => "O queridinho, com sua cobertura de chocolate.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Torta",
                "price" => 50.00,
                "filename" => "torta.jpg",
                "description" => "Aniversário não é a mesma coisa sem ela.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Bolo no Pote",
                "price" => 20.00,
                "filename" => "vestido_floral.jpg",
                "description" => "Geladinho, mais refrescante impossível.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Chá de Hortelã",
                "price" => 5.,
                "filename" => "cha_de_hortela.jpg",
                "description" => "Nem acalma de mais, nem de menos, e ainda mantêm seu sabor mesmo sem açúcar.",
                "category_id" => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Chá Capim Cidreira",
                "price" => 5.,
                "filename" => "cha_capim_cidreira.jpg",
                "description" => "Lar doce lar!",
                "category_id" => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Chá Verde",
                "price" => 7.,
                "filename" => "cha_verde.jpg",
                "description" => "Para as manhãs frias, bye bye resfriado!",
                "category_id" => 3,
                'created_at' => $now,
                'updated_at' => $now
            ]

        ];

        $builder = $this->db->table('products');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }
    }
}
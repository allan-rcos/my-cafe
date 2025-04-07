<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{

    public function run(): void
    {
        $now = ( new \DateTime('now') )->format('Y-m-d H:i:s');
        $factories = [
            [
                "name" => "Smartphone X",
                "price" => 1200.00,
                "filename" => "smartphone_x.jpg",
                "description" => "Smartphone com tela grande e câmera de alta resolução.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Laptop Pro",
                "price" => 2500.00,
                "filename" => "laptop_pro.jpg",
                "description" => "Laptop potente para trabalho e jogos.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "TV 4K Ultra",
                "price" => 1800.00,
                "filename" => "tv_4k_ultra.jpg",
                "description" => "TV com imagem nítida e cores vibrantes.",
                "category_id" => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Camiseta Básica",
                "price" => 50.00,
                "filename" => "camiseta_basica.jpg",
                "description" => "Camiseta de algodão confortável para o dia a dia.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Calça Jeans",
                "price" => 120.00,
                "filename" => "calca_jeans.jpg",
                "description" => "Calça jeans clássica com ótimo caimento.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Vestido Floral",
                "price" => 150.00,
                "filename" => "vestido_floral.jpg",
                "description" => "Vestido leve e elegante para ocasiões especiais.",
                "category_id" => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Livro de Ficção",
                "price" => 30.00,
                "filename" => "livro_ficcao.jpg",
                "description" => "Romance envolvente com personagens cativantes.",
                "category_id" => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Livro de História",
                "price" => 40.00,
                "filename" => "livro_historia.jpg",
                "description" => "Livro informativo sobre eventos históricos importantes.",
                "category_id" => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Livro Infantil",
                "price" => 25.00,
                "filename" => "livro_infantil.jpg",
                "description" => "Livro com ilustrações coloridas e histórias divertidas.",
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
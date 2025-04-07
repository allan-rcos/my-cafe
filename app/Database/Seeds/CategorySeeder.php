<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $factories = [
            [
                "name" => "Eletrônicos",
                "description" => "Produtos eletrônicos de última geração, como smartphones, laptops e TVs.",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Roupas",
                "description" => "Vestuário da moda para homens, mulheres e crianças, incluindo roupas casuais e formais.",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Livros",
                "description" => "Uma vasta seleção de livros de ficção, não ficção e educativos para todas as idades.",
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        $builder = $this->db->table('categories');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }
    }
}
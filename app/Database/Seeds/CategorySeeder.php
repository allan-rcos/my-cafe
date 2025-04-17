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
                "name" => "Cafés",
                "description" => "Nossos melhores cafés, fortes, fracos, descafeinados e muito mais.",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Bolos",
                "description" => "Bolos bem macios, que derretem na boca.",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                "name" => "Chás",
                "description" => "Para aqueles que querem diminuir a ansiedade ou repor nutrientes no corpo.",
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
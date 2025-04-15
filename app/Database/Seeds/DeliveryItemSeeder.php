<?php

namespace App\DataBase\Seeds;

use CodeIgniter\Database\Seeder;

class DeliveryItemSeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'user_id'    => 0,
                'product_id' => 7,
                'quantity'   => 1,
                'checked_at' => (new \DateTime('yesterday 9:00'))->format('Y-m-d H:i:s')
            ],
            [
                'user_id'    => 0,
                'product_id' => 4,
                'quantity'   => 2,
                'checked_at' => (new \DateTime('yesterday 9:00'))->format('Y-m-d H:i:s')
            ],
            [
                'user_id'    => 0,
                'product_id' => 5,
                'quantity'   => 1
            ]
        ];

        $builder = $this->db->table('delivery_itens');

        foreach ($factories as $factory) $builder->insert($factory);
    }
}
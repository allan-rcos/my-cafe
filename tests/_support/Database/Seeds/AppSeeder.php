<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSeeder extends Seeder
{

    public function run(): void
    {
        /** @var $seeders array<string, Seeder> */
        $seeders = [
            'category'        => new CategorySeeder($this->config, $this->db),
            'products'        => new ProductsSeeder($this->config, $this->db),
            'user_complement' => new UserComplementSeeder($this->config, $this->db),
            'books'           => new BookSeeder($this->config, $this->db),
            'delivery_itens'  => new DeliveryItemSeeder($this->config, $this->db)
        ];

        foreach ($seeders as $seeder) $seeder->run();
    }
}
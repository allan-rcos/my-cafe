<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSeeder extends Seeder
{

    public function run(): void
    {
        /** @var $seeders array<string, Seeder> */
        $seeders = [
            'category' => new CategorySeeder($this->config, $this->db),
            'products' => new ProductsSeeder($this->config, $this->db)
        ];

        foreach ($seeders as $seeder) {
            $seeder->run();
        }
    }
}
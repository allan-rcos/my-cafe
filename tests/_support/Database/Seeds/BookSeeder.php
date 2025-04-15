<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;
use DateTime;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'user_id'  => 1,
                'datetime' => (new DateTime('today 15:00'))->format('Y-m-d H:i:s'),
                'message'  => 'Bom dia! Vou com minha família comemorar meu aniversário de casamento, umas dez pessoas.'
            ],
            [
                'user_id'  => 2,
                'datetime' => (new DateTime('tomorrow 9:00'))->format('Y-m-d H:i:s'),
                'message'  => 'Já estou até sonhando com seu café! Por favor separe a mesa que fica na varanda.'
            ]
        ];

        $builder = $this->db->table('books');

        foreach ($factories as $factory) $builder->insert($factory);
    }
}
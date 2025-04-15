<?php

namespace App\DataBase\Seeds;

use CodeIgniter\Database\Seeder;

class UserComplementSeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'user_id' => 0,
                'name'    => 'Állan Ricardo Costa',
                'photo'   => 'allan_ricardo_costa.user.jpg',
                'phone'   => '31960716471',
                'address' => 'Capitão Furtado - 232, Santa Matilde - Conselheiro Lafaiete (MG)'
            ],
            [
                'user_id' => 1,
                'name'    => 'Maria das Graças',
                'photo'   => 'maria_das_gracas.user.jpg',
                'phone'   => '11912345678',
                'address' => 'Rua 1 - 600 - Bairro Limpo - Cidade Brasileira (SG)'
            ],
            [
                'user_id' => 2,
                'name'    => 'Maria das Graças',
                'photo'   => 'maria_das_graças_1.user.jpg',
                'phone'   => '81987654321',
                'address' => 'Rua 5 - 0 - Bairro Periférico - Vila Brasileira (GL)'
            ]
        ];

        $builder = $this->db->table('user_complement');

        foreach ($factories as $factory) $builder->insert($factory);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserComplementSeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'user_id' => 1,
                'name'    => 'Állan Ricardo Costa',
                'phone'   => '31960716471',
                'address' => 'Capitão Furtado - 232, Santa Matilde - Conselheiro Lafaiete (MG)'
            ],
            [
                'user_id' => 2,
                'name'    => 'Maria das Graças',
                'phone'   => '11912345678',
                'address' => 'Rua 1 - 600 - Bairro Limpo - Cidade Brasileira (SG)'
            ],
            [
                'user_id' => 3,
                'name'    => 'Maria das Graças',
                'phone'   => '81987654321',
                'address' => 'Rua 5 - 0 - Bairro Periférico - Vila Brasileira (GL)'
            ],
            [
                'user_id' => 4,
                'name'    => 'O Desenvolvedor',
                'photo'   => 'o_desenvolvedor.user.webp',
                'phone'   => '31960716471',
                'address' => 'Binários - 0101, Desenvolvedores - Software (ES)'
            ],
        ];

        $builder = $this->db->table('user_complement');

        foreach ($factories as $factory) $builder->insert($factory);
    }
}

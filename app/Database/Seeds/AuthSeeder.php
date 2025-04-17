<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Authentication\Passwords;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        $now    = ( new \DateTime('now') )->format('Y-m-d H:i:s');
        $tables = setting('Auth.tables');
        /** @var Passwords $passwords */
        $passwords = service('passwords');

        $users = [
            [
                'username'   => 'allan.rcos',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'username'   => 'maria',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'username'   => 'gracinha',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'username'   => 'dev.local',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        $builder = $this->db->table($tables['users']);

        foreach ($users as $user) $builder->insert($user);

        $permissions = [
            [
                'user_id'    => 4,
                'permission' => 'admin.manage',
                'created_at' => $now
            ],
            [
                'user_id'    => 4,
                'permission' => 'admin.settings',
                'created_at' => $now
            ]
        ];

        $builder = $this->db->table($tables['permissions_users']);

        foreach ($permissions as $permission) $builder->insert($permission);

        $identities = [
            [
                'user_id'    => 1,
                'type'       => Session::ID_TYPE_EMAIL_PASSWORD,
                'secret'     => 'ricardo@mycafe.com',
                'secret2'    => $passwords->hash('dontDoThis(123)'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id'    => 2,
                'type'       => Session::ID_TYPE_EMAIL_PASSWORD,
                'secret'     => 'mariadasgracas@gmail.com',
                'secret2'    => $passwords->hash('pai12-12-1912'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id'    => 3,
                'type'       => Session::ID_TYPE_EMAIL_PASSWORD,
                'secret'     => 'mariadasgracas@hotmail.com',
                'secret2'    => $passwords->hash('neto11-11-2011'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id'    => 4,
                'type'       => Session::ID_TYPE_EMAIL_PASSWORD,
                'secret'     => 'developer@mycafe.dev',
                'secret2'    => $passwords->hash('admin'),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        $builder = $this->db->table($tables['identities']);

        foreach ($identities as $identity) $builder->insert($identity);

        $groups = [
            [
                'user_id'    => 1,
                'group'      => 'user',
                'created_at' => $now
            ],
            [
                'user_id'    => 1,
                'group'      => 'superadmin',
                'created_at' => $now
            ],
            [
                'user_id'    => 2,
                'group'      => 'user',
                'created_at' => $now
            ],
            [
                'user_id'    => 3,
                'group'      => 'user',
                'created_at' => $now
            ],
            [
                'user_id'    => 4,
                'group'      => 'user',
                'created_at' => $now
            ],
            [
                'user_id'    => 4,
                'group'      => 'developer',
                'created_at' => $now
            ],
        ];

        $builder = $this->db->table($tables['groups_users']);

        foreach ($groups as $group) $builder->insert($group);
    }
}
<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserComplement extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'user_id' => ['type' => 'int',     'constraint' => 5, 'unsigned' => true, 'unique' => true],
            'name'    => ['type' => 'varchar', 'constraint' => 60],
            'photo'   => ['type' => 'varchar', 'constraint' => 60],
            'phone'   => ['type' => 'char',    'constraint' => 11],
            'address' => ['type' => 'varchar', 'constraint' => 255]
        ]);

        $this->forge->createTable('user_complement');
    }

    public function down(): void
    {
        $this->forge->dropTable('user_complement');
    }
}

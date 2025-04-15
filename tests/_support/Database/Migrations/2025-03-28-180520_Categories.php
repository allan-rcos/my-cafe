<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'name'        => ['type' => 'varchar', 'constraint' => 80],
            'description' => ['type' => 'varchar', 'constraint' => 255],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('categories');
    }

    public function down(): void
    {
        $this->forge->dropTable('categories');
    }
}

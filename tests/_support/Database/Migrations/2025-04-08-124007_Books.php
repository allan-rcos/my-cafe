<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class BooksMigration extends Migration
{
    public function up(): void
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField('id');
        $this->forge->addField([
            'user_id'   => ['type' => 'int', 'constraint' => 5, 'unsigned' => true],
            'datetime'  => ['type' => 'datetime'],
            'message'   => ['type' => 'varchar',  'constraint' => 255]
        ]);

        $this->forge->addForeignKey('user_id', 'user_complement', 'user_id');

        $this->forge->createTable('books');

        $this->db->enableForeignKeyChecks();
    }

    public function down(): void
    {
        $this->forge->dropTable('books');
    }
}

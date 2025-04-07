<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsMigration extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField('id');
        $this->forge->addField([
            'name'        => ['type' => 'varchar', 'constraint' => 60],
            'price'       => ['type' => 'float'],
            'filename'    => ['type' => 'varchar', 'constraint' => 60],
            'description' => ['type' => 'varchar', 'constraint' => 255],
            'category_id' => ['type' => 'int'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('name');
        $this->forge->addForeignKey('category_id', 'categories', 'id');

        $this->forge->createTable('products');

        $this->db->enableForeignKeyChecks();
    }

    public function down(): void
    {
        $this->forge->dropTable('products');
    }
}

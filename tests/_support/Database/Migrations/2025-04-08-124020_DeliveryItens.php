<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeliveryItensMigration extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField('id');

        $this->forge->addField([
            'user_id'    => ['type' => 'int', 'constraint' => 5, 'unsigned' => true],
            'product_id' => ['type' => 'int'],
            'quantity'   => ['type' => 'int'],
            'checked_at' => ['type' => 'datetime', 'null' => true]
        ]);

        $this->forge->addForeignKey('user_id', 'user_complement', 'user_id');
        $this->forge->addForeignKey('product_id', 'products', 'id');

        $this->forge->createTable('delivery_itens');

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('delivery_itens');
    }
}

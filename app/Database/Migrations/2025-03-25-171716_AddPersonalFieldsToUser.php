<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use Config\Auth;

class AddMobileNumberToUsers extends Migration
{
    /**
     * @var string[]
     */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up(): void
    {
        $fields = [
            'name' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'address' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'complement' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'zip' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down(): void
    {
        $fields = [
            'name',
            'phone',
            'address',
            'complement',
            'zip'
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
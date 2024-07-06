<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Potongan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_potongan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_potongan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'pot_iwp' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'pot_pph' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'bappetarum' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_potongan', true);
        $this->forge->createTable('potongan');
    }

    public function down()
    {
        $this->forge->dropTable('potongan');
    }
}

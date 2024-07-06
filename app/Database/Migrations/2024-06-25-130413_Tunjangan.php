<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tunjangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tunjangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_tunjangan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'jumlah_tunjangan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tunjangan_suami_istri' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tunjangan_anak' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tunjangan_jabatan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tunjangan_beras' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tukin' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'uang_makan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'sewa_rumah' => [
                'type' => 'INT',
                'constraint' => 11,
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

        $this->forge->addKey('id_tunjangan', true);
        $this->forge->createTable('tunjangan');
    }

    public function down()
    {
        $this->forge->dropTable('tunjangan');
    }
}

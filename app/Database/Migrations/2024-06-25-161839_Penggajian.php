<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penggajian extends Migration
{
    public function up()
    {
        // Tabel penggajian
        $this->forge->addField([
            'id_penggajian' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255, // Sesuaikan dengan tipe data kolom username di tabel users
            ],
            'id_tunjangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_potongan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'golongan' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'gaji_pokok' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'gaji_bersih' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_penggajian');
        $this->forge->addForeignKey('username', 'users', 'username', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tunjangan', 'tunjangan', 'id_tunjangan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_potongan', 'potongan', 'id_potongan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penggajian');
    }

    public function down()
    {
        $this->forge->dropForeignKey('penggajian', 'penggajian_username_foreign');
        $this->forge->dropForeignKey('penggajian', 'penggajian_id_tunjangan_foreign');
        $this->forge->dropForeignKey('penggajian', 'penggajian_id_potongan_foreign');
        
        $this->forge->dropTable('penggajian');
    }
}

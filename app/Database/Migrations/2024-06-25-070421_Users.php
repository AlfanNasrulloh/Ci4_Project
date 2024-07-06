<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'password_hash'    => ['type' => 'varchar', 'constraint' => 255],
            'reset_hash'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'reset_at'         => ['type' => 'datetime', 'null' => true],
            'reset_expires'    => ['type' => 'datetime', 'null' => true],
            'activate_hash'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status_message'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => false, 'default' => 0],
            'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => false, 'default' => 0],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
            // Additional attributes
            'nama_pegawai'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'tempat_lahir'        => ['type' => 'VARCHAR', 'constraint' => '100'],
            'tanggal_lahir'       => ['type' => 'DATE'],
            'agama'               => ['type' => 'VARCHAR', 'constraint' => '50'],
            'pendidikan'          => ['type' => 'VARCHAR', 'constraint' => '50'],
            'jenkel'              => ['type' => 'CHAR', 'constraint' => '1'],
            'TMT'                 => ['type' => 'DATE'],
            'jabatan'             => ['type' => 'VARCHAR', 'constraint' => '100'],
            'status_kepegawaian'  => ['type' => 'VARCHAR', 'constraint' => '50'],
            'status_pernikahan'   => ['type' => 'VARCHAR', 'constraint' => '50'],
            'no_telp'             => ['type' => 'VARCHAR', 'constraint' => '15'],
            'jumlah_anak'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Pegawai_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'email',
        'username',
        'password_hash',
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'created_at',
        'updated_at',
        'deleted_at',
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'jenkel',
        'TMT',
        'jabatan',
        'status_kepegawaian',
        'status_pernikahan',
        'no_telp',
        'jumlah_anak',
    ];

    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}

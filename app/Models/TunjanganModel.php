<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganModel extends Model
{
    protected $table = 'tunjangan';
    protected $primaryKey = 'id_tunjangan';
    protected $allowedFields = ['nama_tunjangan', 'jumlah_tunjangan', 'tunjangan_suami_istri', 'tunjangan_anak', 'tunjangan_jabatan', 'tunjangan_beras', 'tukin', 'uang_makan', 'sewa_rumah', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    public $returnType = 'object';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PotonganModel extends Model
{
    protected $table = 'potongan';
    protected $primaryKey = 'id_potongan';
    protected $allowedFields = ['nama_potongan', 'pot_iwp', 'pot_pph', 'bappetarum', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}

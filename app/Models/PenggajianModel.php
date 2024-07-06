<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table = 'penggajian';
    protected $primaryKey = 'id_penggajian';
    protected $allowedFields = ['username', 'id_tunjangan', 'id_potongan', 'golongan', 'gaji_pokok', 'gaji_bersih'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'username' => 'required',
        'id_tunjangan' => 'required',
        'id_potongan' => 'required',
        'golongan' => 'required',
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus dipilih'
        ],
        'id_tunjangan' => [
            'required' => 'Tunjangan harus dipilih'
        ],
        'id_potongan' => [
            'required' => 'Potongan harus dipilih'
        ],
        'golongan' => [
            'required' => 'Golongan harus dipilih'
        ]
    ];

    protected $skipValidation = false;

    public function getPenggajianWithDetails($id)
    {
        $builder = $this->builder();
        $builder->select('penggajian.*, tunjangan.*, potongan.*');
        $builder->join('tunjangan', 'tunjangan.id_tunjangan = penggajian.id_tunjangan', 'left');
        $builder->join('potongan', 'potongan.id_potongan = penggajian.id_potongan', 'left');
        $builder->where('penggajian.id_penggajian', $id);
        return $builder->get()->getRowArray();
    }
}

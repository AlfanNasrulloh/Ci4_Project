<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TunjanganModel;

class Tunjangan extends BaseController
{
    protected $tunjanganModel;

    public function __construct()
    {
        $this->tunjanganModel = new TunjanganModel();
    }

    public function index()
    {
        $tunjangan = $this->tunjanganModel->findAll();

        $data = [
            'tunjangan' => $tunjangan,
        ];

        return view('tunjangan/index', $data);
    }

    public function create()
    {
        return view('tunjangan/create');
    }

    public function store()
    {
        $data = [
            'nama_tunjangan' => $this->request->getPost('nama_tunjangan'),
            'jumlah_tunjangan' => $this->request->getPost('jumlah_tunjangan'),
            'tunjangan_suami_istri' => $this->request->getPost('tunjangan_suami_istri'),
            'tunjangan_anak' => $this->request->getPost('tunjangan_anak'),
            'tunjangan_jabatan' => $this->request->getPost('tunjangan_jabatan'),
            'tunjangan_beras' => $this->request->getPost('tunjangan_beras'),
            'tukin' => $this->request->getPost('tukin'),
            'uang_makan' => $this->request->getPost('uang_makan'),
            'sewa_rumah' => $this->request->getPost('sewa_rumah'),
        ];

        $this->tunjanganModel->insert($data);

        return redirect()->to('/tunjangan');
    }

    public function edit($id)
    {
        $tunjangan = $this->tunjanganModel->find($id);

        $data = [
            'tunjangan' => $tunjangan,
        ];

        return view('tunjangan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_tunjangan' => $this->request->getPost('nama_tunjangan'),
            'jumlah_tunjangan' => $this->request->getPost('jumlah_tunjangan'),
            'tunjangan_suami_istri' => $this->request->getPost('tunjangan_suami_istri'),
            'tunjangan_anak' => $this->request->getPost('tunjangan_anak'),
            'tunjangan_jabatan' => $this->request->getPost('tunjangan_jabatan'),
            'tunjangan_beras' => $this->request->getPost('tunjangan_beras'),
            'tukin' => $this->request->getPost('tukin'),
            'uang_makan' => $this->request->getPost('uang_makan'),
            'sewa_rumah' => $this->request->getPost('sewa_rumah'),
        ];

        $this->tunjanganModel->update($id, $data);

        return redirect()->to('/tunjangan');
    }

    public function delete($id)
    {
        $this->tunjanganModel->delete($id);

        return redirect()->to('/tunjangan');
    }
}

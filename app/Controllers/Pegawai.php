<?php

namespace App\Controllers;

use App\Models\Pegawai_model;
use CodeIgniter\Controller;

class Pegawai extends Controller
{
    public function index()
    {
        $model = new Pegawai_model();
        $data['users'] = $model->findAll();

        return view('pegawai/index', $data);
    }

    public function edit($id = null)
    {
        $model = new Pegawai_model();
        $data['users'] = $model->find($id);

        if (empty($data['users'])) {
            return redirect()->to('/pegawai');
        }

        return view('pegawai/edit', $data);
    }

    public function update($id = null)
    {
        $model = new Pegawai_model();

        $validationRules = [
            'username'           => 'required',
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required|valid_date',
            'agama'              => 'required',
            'pendidikan'         => 'required',
            'jenkel'             => 'required|in_list[L,P]',
            'TMT'                => 'required|valid_date',
            'jabatan'            => 'required',
            'status_kepegawaian' => 'required',
            'status_pernikahan'  => 'required',
            'no_telp'            => 'required',
            'jumlah_anak'        => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'           => $this->request->getPost('username'),
            'tempat_lahir'       => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'      => $this->request->getPost('tanggal_lahir'),
            'agama'              => $this->request->getPost('agama'),
            'pendidikan'         => $this->request->getPost('pendidikan'),
            'jenkel'             => $this->request->getPost('jenkel'),
            'TMT'                => $this->request->getPost('TMT'),
            'jabatan'            => $this->request->getPost('jabatan'),
            'status_kepegawaian' => $this->request->getPost('status_kepegawaian'),
            'status_pernikahan'  => $this->request->getPost('status_pernikahan'),
            'no_telp'            => $this->request->getPost('no_telp'),
            'jumlah_anak'        => $this->request->getPost('jumlah_anak'),
        ];

        $model->update($id, $data);

        return redirect()->to('/pegawai');
    }
}

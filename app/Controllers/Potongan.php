<?php

namespace App\Controllers;

use App\Models\PotonganModel;
use CodeIgniter\Controller;

class Potongan extends Controller
{
    public function index()
    {
        $model = new PotonganModel();

        $data = [
            'potongan' => $model->findAll(),
        ];

        return view('potongan/index', $data);
    }

    public function create()
    {
        return view('potongan/create');
    }

    public function store()
    {
        $model = new PotonganModel();

        $data = [
            'nama_potongan' => $this->request->getPost('nama_potongan'),
            'pot_iwp' => $this->request->getPost('pot_iwp'),
            'pot_pph' => $this->request->getPost('pot_pph'),
            'bappetarum' => $this->request->getPost('bappetarum'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return redirect()->to('/potongan');
    }

    public function edit($id)
    {
        $model = new PotonganModel();

        $data = [
            'potongan' => $model->find($id),
        ];

        return view('potongan/edit', $data);
    }

    public function update($id)
    {
        $model = new PotonganModel();

        $data = [
            'nama_potongan' => $this->request->getPost('nama_potongan'),
            'pot_iwp' => $this->request->getPost('pot_iwp'),
            'pot_pph' => $this->request->getPost('pot_pph'),
            'bappetarum' => $this->request->getPost('bappetarum'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->to('/potongan');
    }

    public function delete($id)
    {
        $model = new PotonganModel();
        
        $model->delete($id);

        return redirect()->to('/potongan');
    }
}

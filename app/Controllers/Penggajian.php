<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggajianModel;
use App\Models\Pegawai_model;
use App\Models\TunjanganModel;
use App\Models\PotonganModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

class Penggajian extends BaseController
{
    protected $penggajianModel;
    protected $tunjanganModel;
    protected $potonganModel;

    public function __construct()
    {
        $this->penggajianModel = new PenggajianModel();
        $this->tunjanganModel = new TunjanganModel();
        $this->potonganModel = new PotonganModel();
    }

    public function index()
    {
        $penggajian = $this->penggajianModel->findAll();

        $data = [];
        foreach ($penggajian as $item) {
            // Convert to object if necessary
            if (is_array($item)) {
                $item = (object) $item;
            }

            $tunjangan = $this->tunjanganModel->find($item->id_tunjangan);
            $potongan = $this->potonganModel->find($item->id_potongan);

            // Convert to object if necessary
            if (is_array($tunjangan)) {
                $tunjangan = (object) $tunjangan;
            }

            if (is_array($potongan)) {
                $potongan = (object) $potongan;
            }

            // Calculate total allowance from all related fields in the 'tunjangan' table
            $jumlahTunjangan = 0;
            if ($tunjangan) {
                $jumlahTunjangan += isset($tunjangan->jumlah_tunjangan) ? $tunjangan->jumlah_tunjangan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_suami_istri) ? $tunjangan->tunjangan_suami_istri : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_anak) ? $tunjangan->tunjangan_anak : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_jabatan) ? $tunjangan->tunjangan_jabatan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_beras) ? $tunjangan->tunjangan_beras : 0;
                $jumlahTunjangan += isset($tunjangan->tukin) ? $tunjangan->tukin : 0;
                $jumlahTunjangan += isset($tunjangan->uang_makan) ? $tunjangan->uang_makan : 0;
            }

            // Calculate total deduction from all related fields in the 'potongan' table
            $jumlahPotongan = 0;
            if ($potongan) {
                $jumlahPotongan += isset($potongan->jumlah_potongan) ? $potongan->jumlah_potongan : 0;
                $jumlahPotongan += isset($potongan->pot_iwp) ? $potongan->pot_iwp : 0;
                $jumlahPotongan += isset($potongan->pot_pph) ? $potongan->pot_pph : 0;
                $jumlahPotongan += isset($potongan->bappetarum) ? $potongan->bappetarum : 0;
                $jumlahPotongan += isset($potongan->sewa_rumah) ? $potongan->sewa_rumah : 0;
            }

            // Calculate gaji bersih
            $gajiBersih = $item->gaji_pokok + $jumlahTunjangan - $jumlahPotongan;

            $data[] = [
                'id_penggajian' => $item->id_penggajian,
                'username' => $item->username,
                'golongan' => $item->golongan,
                'jumlah_tunjangan' => $jumlahTunjangan,
                'jumlah_potongan' => $jumlahPotongan,
                'gaji_pokok' => $item->gaji_pokok,
                'gaji_bersih' => $gajiBersih,
            ];
        }

        return view('penggajian/index', ['data' => $data]);
    }

    public function create()
    {
        $pegawaiModel = new Pegawai_model();
        $users = $pegawaiModel->findAll();

        $tunjangan = $this->tunjanganModel->findAll();
        $potongan = $this->potonganModel->findAll();

        $data = [
            'users' => $users,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan
        ];

        return view('penggajian/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'username' => 'required',
            'golongan' => 'required',
            'id_tunjangan' => 'required',
            'id_potongan' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $golongan = $this->request->getPost('golongan');
        $idTunjangan = $this->request->getPost('id_tunjangan');
        $idPotongan = $this->request->getPost('id_potongan');

        $gajiPokok = $this->calculateGajiPokok($golongan);
        $gajiBersih = $this->calculateGajiBersih($gajiPokok, $idTunjangan, $idPotongan);

        $data = [
            'username' => $username,
            'golongan' => $golongan,
            'id_tunjangan' => implode(',', $idTunjangan),
            'id_potongan' => is_array($idPotongan) ? implode(',', $idPotongan) : $idPotongan,
            'gaji_pokok' => $gajiPokok,
            'gaji_bersih' => $gajiBersih
        ];

        $this->penggajianModel->insert($data);
        session()->setFlashdata('message', 'Data penggajian berhasil ditambahkan');
        return redirect()->to('/penggajian');
    }

    public function edit($id)
    {
        $penggajian = $this->penggajianModel->find($id);

        if (!$penggajian) {
            throw new \Exception('Penggajian not found');
        }

        $data = [
            'penggajian' => $penggajian,
            'tunjangan' => $this->tunjanganModel->findAll(),
            'potongan' => $this->potonganModel->findAll()
        ];

        return view('penggajian/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'username' => 'required',
            'id_tunjangan' => 'required',
            'id_potongan' => 'required',
            'golongan' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idTunjangan = $this->request->getPost('id_tunjangan');
        $idPotongan = $this->request->getPost('id_potongan');

        $gajiPokok = $this->calculateGajiPokok($this->request->getPost('golongan'));
        $gajiBersih = $this->calculateGajiBersih($gajiPokok, $idTunjangan, $idPotongan);

        $data = [
            'username' => $this->request->getPost('username'),
            'id_tunjangan' => implode(',', $idTunjangan),
            'id_potongan' => implode(',', $idPotongan),
            'golongan' => $this->request->getPost('golongan'),
            'gaji_pokok' => $gajiPokok,
            'gaji_bersih' => $gajiBersih,
        ];

        $this->penggajianModel->update($id, $data);
        return redirect()->to('/penggajian');
    }

    // public function show($id)
    // {
    //     $data['penggajian'] = $this->penggajianModel->find($id);
    //     return view('penggajian/show', $data);
    // }

    public function laporan()
    {
        $penggajian = $this->penggajianModel->findAll();

        $data = [];
        foreach ($penggajian as $item) {
            if (is_array($item)) {
                $item = (object) $item;
            }

            $tunjangan = $this->tunjanganModel->find($item->id_tunjangan);
            $potongan = $this->potonganModel->find($item->id_potongan);

            if (is_array($tunjangan)) {
                $tunjangan = (object) $tunjangan;
            }

            if (is_array($potongan)) {
                $potongan = (object) $potongan;
            }

            $jumlahTunjangan = 0;
            if ($tunjangan) {
                $jumlahTunjangan += isset($tunjangan->jumlah_tunjangan) ? $tunjangan->jumlah_tunjangan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_suami_istri) ? $tunjangan->tunjangan_suami_istri : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_anak) ? $tunjangan->tunjangan_anak : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_jabatan) ? $tunjangan->tunjangan_jabatan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_beras) ? $tunjangan->tunjangan_beras : 0;
                $jumlahTunjangan += isset($tunjangan->tukin) ? $tunjangan->tukin : 0;
                $jumlahTunjangan += isset($tunjangan->uang_makan) ? $tunjangan->uang_makan : 0;
            }

            $jumlahPotongan = 0;
            if ($potongan) {
                $jumlahPotongan += isset($potongan->jumlah_potongan) ? $potongan->jumlah_potongan : 0;
                $jumlahPotongan += isset($potongan->pot_iwp) ? $potongan->pot_iwp : 0;
                $jumlahPotongan += isset($potongan->pot_pph) ? $potongan->pot_pph : 0;
                $jumlahPotongan += isset($potongan->bappetarum) ? $potongan->bappetarum : 0;
                $jumlahPotongan += isset($potongan->sewa_rumah) ? $potongan->sewa_rumah : 0;
            }

            $gajiBersih = $item->gaji_pokok + $jumlahTunjangan - $jumlahPotongan;

            $data[] = [
                'id_penggajian' => $item->id_penggajian,
                'username' => $item->username,
                'golongan' => $item->golongan,
                'gaji_pokok' => $item->gaji_pokok,
                'jumlah_tunjangan' => $jumlahTunjangan,
                'jumlah_potongan' => $jumlahPotongan,
                'gaji_bersih' => $gajiBersih,
            ];
        }

        return view('penggajian/laporan', ['penggajian' => $data]);
    }

    public function pdf($id)
    {
        $data['penggajian'] = $this->penggajianModel->find($id);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Slip Gaji');
        $pdf->SetSubject('Slip Gaji');

        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 12);

        $html = view('penggajian/pdf', $data);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('slip_gaji.pdf', 'I');
    }


    public function excel()
    {
        $penggajian = $this->penggajianModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Penggajian');
        $sheet->setCellValue('C1', 'Nama Pegawai');
        $sheet->setCellValue('D1', 'Golongan');
        $sheet->setCellValue('E1', 'Gaji Pokok');
        $sheet->setCellValue('F1', 'Jumlah Tunjangan');
        $sheet->setCellValue('G1', 'Jumlah Potongan');
        $sheet->setCellValue('H1', 'Gaji Bersih');

        // Style for header
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
            ],
        ];

        // Apply header style
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Data
        $row = 2;
        $no = 1;
        $totalGajiBersih = 0;
        foreach ($penggajian as $item) {
            if (is_array($item)) {
                $item = (object) $item;
            }

            $tunjangan = $this->tunjanganModel->find($item->id_tunjangan);
            $potongan = $this->potonganModel->find($item->id_potongan);

            if (is_array($tunjangan)) {
                $tunjangan = (object) $tunjangan;
            }

            if (is_array($potongan)) {
                $potongan = (object) $potongan;
            }

            $jumlahTunjangan = 0;
            if ($tunjangan) {
                $jumlahTunjangan += isset($tunjangan->jumlah_tunjangan) ? $tunjangan->jumlah_tunjangan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_suami_istri) ? $tunjangan->tunjangan_suami_istri : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_anak) ? $tunjangan->tunjangan_anak : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_jabatan) ? $tunjangan->tunjangan_jabatan : 0;
                $jumlahTunjangan += isset($tunjangan->tunjangan_beras) ? $tunjangan->tunjangan_beras : 0;
                $jumlahTunjangan += isset($tunjangan->tukin) ? $tunjangan->tukin : 0;
                $jumlahTunjangan += isset($tunjangan->uang_makan) ? $tunjangan->uang_makan : 0;
            }

            $jumlahPotongan = 0;
            if ($potongan) {
                $jumlahPotongan += isset($potongan->jumlah_potongan) ? $potongan->jumlah_potongan : 0;
                $jumlahPotongan += isset($potongan->pot_iwp) ? $potongan->pot_iwp : 0;
                $jumlahPotongan += isset($potongan->pot_pph) ? $potongan->pot_pph : 0;
                $jumlahPotongan += isset($potongan->bappetarum) ? $potongan->bappetarum : 0;
                $jumlahPotongan += isset($potongan->sewa_rumah) ? $potongan->sewa_rumah : 0;
            }

            $gajiBersih = $item->gaji_pokok + $jumlahTunjangan - $jumlahPotongan;
            $totalGajiBersih += $gajiBersih;

            $sheet->setCellValue('A' . $row, $no++); 
            $sheet->setCellValue('B' . $row, $item->id_penggajian);
            $sheet->setCellValue('C' . $row, $item->username);
            $sheet->setCellValue('D' . $row, $item->golongan);
            $sheet->setCellValue('E' . $row, 'Rp. ' . number_format($item->gaji_pokok, 0, ',', '.'));
            $sheet->setCellValue('F' . $row, 'Rp. ' . number_format($jumlahTunjangan, 0, ',', '.'));
            $sheet->setCellValue('G' . $row, 'Rp. ' . number_format($jumlahPotongan, 0, ',', '.'));
            $sheet->setCellValue('H' . $row, 'Rp. ' . number_format($gajiBersih, 0, ',', '.'));

            // Apply border style for data cells
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);

            $row++;
        }

        // Total row
        $sheet->mergeCells('A' . $row . ':G' . $row);
        $sheet->setCellValue('A' . $row, 'Total Gaji Bersih');
        $sheet->setCellValue('H' . $row, 'Rp. ' . number_format($totalGajiBersih, 0, ',', '.'));

        // Style for total row
        $totalStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($totalStyle);

        // Auto size columns
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_penggajian.xlsx';
        $writer->save($filename);

        return $this->response->download($filename, null)->setFileName($filename);
    }

    private function calculateGajiPokok($golongan)
    {
        switch ($golongan) {
            case 'I':
                return 5000000;
            case 'II':
                return 4000000;
            case 'III':
                return 3000000;
            default:
                return 0;
        }
    }

    protected function calculateGajiBersih($gajiPokok, $idTunjangan, $idPotongan)
    {
        $tunjanganTotal = 0;
        $potonganTotal = 0;

        // Ensure $idTunjangan and $idPotongan are strings
        $idTunjangan = is_array($idTunjangan) ? implode(',', $idTunjangan) : $idTunjangan;
        $idPotongan = is_array($idPotongan) ? implode(',', $idPotongan) : $idPotongan;

        // Process tunjangan
        $tunjanganIds = explode(',', $idTunjangan);
        foreach ($tunjanganIds as $id) {
            if (!empty($id)) {
                $tunjangan = $this->tunjanganModel->find($id);
                if ($tunjangan) {
                    // Check if $tunjangan is an object
                    if (is_array($tunjangan)) {
                        $tunjangan = (object) $tunjangan;
                    }
                    // Debug output
                    log_message('debug', 'Tunjangan ID: ' . $id . ', Jumlah: ' . (isset($tunjangan->jumlah_tunjangan) ? $tunjangan->jumlah_tunjangan : 'Tidak ada jumlah'));
                    if (isset($tunjangan->jumlah_tunjangan)) {
                        $tunjanganTotal += $tunjangan->jumlah_tunjangan;
                    }
                }
            }
        }

        // Process potongan
        $potonganIds = explode(',', $idPotongan);
        foreach ($potonganIds as $id) {
            if (!empty($id)) {
                $potongan = $this->potonganModel->find($id);
                if ($potongan) {
                    // Check if $potongan is an object
                    if (is_array($potongan)) {
                        $potongan = (object) $potongan;
                    }
                    // Debug output
                    log_message('debug', 'Potongan ID: ' . $id . ', Jumlah: ' . (isset($potongan->jumlah_potongan) ? $potongan->jumlah_potongan : 'Tidak ada jumlah'));
                    if (isset($potongan->jumlah_potongan)) {
                        $potonganTotal += $potongan->jumlah_potongan;
                    }
                }
            }
        }

        return $gajiPokok + $tunjanganTotal - $potonganTotal;
    }

    public function delete($id)
    {
        // Check if the ID exists
        if ($this->penggajianModel->find($id)) {
            // Delete the record
            $this->penggajianModel->delete($id);

            // Set a success message
            session()->setFlashdata('message', 'Data penggajian berhasil dihapus');
        } else {
            // Set an error message if the ID is not found
            session()->setFlashdata('message', 'Data penggajian tidak ditemukan');
        }

        // Redirect back to the index page
        return redirect()->to('/penggajian');
    }
}

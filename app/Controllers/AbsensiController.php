<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Absensi_Model;

class AbsensiController extends Controller
{
    public function lihat($tanggal)
    {
        $kelasDariSession = session()->get('kelas');

        $absensiModel = new Absensi_Model();
        $dataAbsensi = $absensiModel->getDataAbsensi($tanggal, $kelasDariSession);

        return $this->response->setJSON($dataAbsensi);
    }

    public function lihat_piket($tanggal)
    {
        $absensiModel = new Absensi_Model();
        $dataAbsensi = $absensiModel->getData($tanggal);

        return $this->response->setJSON($dataAbsensi);
    }
}

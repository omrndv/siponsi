<?php

namespace App\Controllers;

use App\Models\Absensi_Model;
use App\Models\Data;
use App\Models\Data_Siswa;
use App\Models\Upload_Tugas;

class Guru extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'current_page' => 'Home',
            'page' => 'guru/dashboard',
        ];

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru') {
            return view('template-guru', $data);
        } elseif ($userRole === 'Guru Mapel') {
            return view('template-mapel', $data);
        } elseif ($userRole === 'Guru Piket') {
            return view('template-piket', $data);
        } else {
            return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    public function absen()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $kelasGuru = $session->get('kelas');
        $model = new Data();
        $siswa = $model->getStudentsByTeacherClass($kelasGuru);

        $userRole = $session->get('tipe');
        if ($userRole === 'Guru') {
            $data = [
                'current_page' => 'Absen',
                'page' => 'guru/inputpresensi',
                'siswa' => $siswa,
            ];
            return view('template-guru', $data);
        } else {
            return response()->json(['message' => 'Anda tidak diizinkan mengakses halaman ini.'], 403);
        }
    }

    public function poin()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new Data_Siswa;

        $data = [
            'current_page' => 'Poin',
            'page' => 'guru/inputpoin',
            'students' => $model->select('id, nama, kelas, tipe, poin')->findAll()
        ];

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru') {
            return view('template-guru', $data);
        } elseif ($userRole === 'Guru Mapel') {
            return view('template-mapel', $data);
        } elseif ($userRole === 'Guru Piket') {
            return view('template-piket', $data);
        } else {
            return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    public function detailsiswa()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $nama = $this->request->getGet('nama');
        $kelas = $this->request->getGet('kelas');

        $data = [
            'current_page' => 'Detail',
            'page' => 'guru/postpoin',
            'nama' => $nama,
            'kelas' => $kelas,
        ];

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru') {
            return view('template-guru', $data);
        } elseif ($userRole === 'Guru Mapel') {
            return view('template-mapel', $data);
        } elseif ($userRole === 'Guru Piket') {
            return view('template-piket', $data);
        } else {
            return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    public function updatepoin()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $nama = $this->request->getPost('nama');
        $kelas = $this->request->getPost('kelas');
        $poinArray = $this->request->getPost('poin');

        if (empty($nama) || empty($kelas) || empty($poinArray)) {
            $errorMessage = "Data tidak boleh kosong!";
            return redirect()->to('/detailsiswa?nama=' . $nama . '&kelas=' . $kelas)->with('alert', $errorMessage);
        }

        $totalPoin = 0;
        foreach ($poinArray as $poin) {
            $totalPoin += (int) $poin;
        }

        $dataSiswaModel = new Data_Siswa();
        $siswa = $dataSiswaModel->where(['nama' => $nama, 'kelas' => $kelas])->first();

        if ($siswa) {
            $currentPoin = (int) $siswa['poin'];
            $newPoin = $currentPoin + $totalPoin;

            $dataSiswaModel->update($siswa['id'], ['poin' => $newPoin]);

            $successMessage = "Data Siswa Berhasil Diperbarui!";
            return redirect()->to('/detailsiswa?nama=' . $nama . '&kelas=' . $kelas)->with('alert', $successMessage);
        } else {
            $errorMessage = "Data tidak ditemukan.";
            return redirect()->to('/detailsiswa?nama=' . $nama . '&kelas=' . $kelas)->with('alert', $errorMessage);
        }
    }

    public function bootcamp()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new Data();
        $students = $model->getStudentsWithPointsGreaterThan40();

        $data = [
            'current_page' => 'Dafboot',
            'page' => 'guru/bootcamp',
            'students' => $students,
        ];

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru') {
            return view('template-guru', $data);
        } elseif ($userRole === 'Guru Mapel') {
            return view('template-mapel', $data);
        } elseif ($userRole === 'Guru Piket') {
            return view('template-piket', $data);
        } else {
            return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    public function rekap()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $session = session();
        $kelas_guru = $session->get('kelas');

        $model = new Data();
        $students = $model->getStudentsByTeacherClass($kelas_guru);

        $userRole = $session->get('tipe');
        if ($userRole === 'Guru') {
            $data = [
                'current_page' => 'Rekap',
                'page' => 'guru/rekapitulasi',
                'students' => $students,
            ];
            return view('template-guru', $data);
        } else {
            return response()->json(['message' => 'Anda tidak diizinkan mengakses halaman ini.'], 403);
        }
    }

    public function simpanpresensi()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $nama = $this->request->getVar('nama');
        $kelas = $this->request->getVar('kelas');
        $status = $this->request->getVar('status');

        $absensiModel = new Absensi_Model();

        $successCount = 0;

        foreach ($status as $siswa_id => $status) {
            $data = [
                'nama' => $nama[$siswa_id],
                'kelas' => $kelas,
                'status' => $status,
                'tanggal' => date('Y-m-d'),
                'tipe' => 'Siswa'
            ];

            if ($absensiModel->insert($data)) {
                $successCount++;
            }
        }

        if ($successCount > 0) {
            return redirect()->to('/absensi')->with('alert', 'Data presensi berhasil disimpan');
        } else {
            return redirect()->to('/absensi')->with('error', 'Tidak ada data yang berhasil disimpan');
        }
    }

    public function daftarabsen()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $kelasGuru = $session->get('kelas');

        $userRole = $session->get('tipe');
        if ($userRole === 'Guru') {
            $data = [
                'current_page' => 'Dafsen',
                'page' => 'guru/absensi',
                'kelasGuru' => $kelasGuru,
            ];
            return view('template-guru', $data);
        } else {
            return response()->json(['message' => 'Anda tidak diizinkan mengakses halaman ini.'], 403);
        }
    }

    public function piket()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipe') !== 'Guru Piket') {
            return redirect()->to('/login-siswa');
        }

        $data = [
            'current_page' => 'Piket',
            'page' => 'admin/rekappiket',
        ];
        return view('template-piket', $data);
    }

    public function tugas()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'current_page' => 'Tugas',
            'page' => 'guru/tugas',
        ];

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru') {
            return view('template-guru', $data);
        } elseif ($userRole === 'Guru Mapel') {
            return view('template-mapel', $data);
        } else {
            return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    public function sendtugas()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login-guru');
        }

        $isi = $this->request->getPost('isi');
        $model = new Upload_Tugas();

        $data = [
            'isi' => $isi,
            'tanggal' => date('Y-m-d'),
        ];

        $inserted = $model->insertdata($data);

        if ($inserted) {
            return redirect()->to('/upload-tugas')->with('alert', 'Upload Tugas Berhasil');
        } else {
            return redirect()->to('/upload-tugas')->with('alert', 'Upload Tugas Gagal');
        }
    }

    public function rekaptugas()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userRole = $session->get('tipe');

        if ($userRole === 'Guru Piket') {
            $dataModel = new Upload_Tugas();
            $data['tugas'] = $dataModel->findAll();

            $viewData = [
                'current_page' => 'Tugas',
                'page' => 'guru/rekaptugas',
                'tugas' => $data['tugas'],
            ];

            return view('template-piket', $viewData);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function filterData()
    {
        $selectedDate = $this->request->getPost('selectedDate');

        $tugasModel = new Upload_Tugas();
        $filteredTugas = $tugasModel->where('tanggal', $selectedDate)->findAll();

        if (!empty($filteredTugas)) {
            $data = [
                'status' => 'success',
                'tugas' => $filteredTugas,
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Tidak ada data yang cocok dengan tanggal yang dipilih.',
            ];
        }

        return $this->response->setJSON($data);
    }

    public function hapus_multiple_tugas()
    {
        $aduanToDelete = $this->request->getPost('admins_to_delete');

        if ($aduanToDelete) {
            $adminModel = new Upload_Tugas();
            foreach ($aduanToDelete as $aduan) {
                $adminModel->deleteTugas($aduan);
            }

            $response = [
                'status' => 'success',
                'message' => 'Tugas berhasil dihapus.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
<?php

namespace App\Controllers;

use App\Models\Data;
use App\Models\Data_Siswa;

class Admin extends BaseController
{
    public function aduan()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userRole = $session->get('tipe');

        if ($userRole === 'Superuser') {
            $model = new \App\Models\Model_Siswa();
            $data['aduanData'] = $model->findAll();

            $data['current_page'] = 'Aduan';
            $data['page'] = 'admin/aduan';

            return view('template-admin', $data);
        } elseif ($userRole === 'Guru') {
            $model = new \App\Models\Model_Siswa();
            $data['aduanData'] = $model->findAll();

            $data['current_page'] = 'Aduan';
            $data['page'] = 'admin/aduan';
            return view('template-guru', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function datgursmp()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userRole = $session->get('tipe');

        if ($userRole === 'Superuser') {
            $dataModel = new Data();
            $data['datgurData'] = $dataModel->findAll();

            $data = [
                'current_page' => 'Guru',
                'page' => 'admin/datgur',
                'datgurData' => $data['datgurData'],
            ];

            return view('template-admin', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function datsis()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userRole = $session->get('tipe');

        if ($userRole === 'Superuser') {
            $dataModel = new Data_Siswa();
            $data['datsisData'] = $dataModel->findAll();

            $data = [
                'current_page' => 'Siswa',
                'page' => 'admin/siswa',
                'datsisData' => $data['datsisData'],
            ];

            return view('template-admin', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function hapus_multiple_admin()
    {
        $aduanToDelete = $this->request->getPost('admins_to_delete');

        if ($aduanToDelete) {
            $adminModel = new \App\Models\Model_Siswa();
            foreach ($aduanToDelete as $aduan) {
                $adminModel->deleteAduan($aduan);
            }

            $response = [
                'status' => 'success',
                'message' => 'Aduan berhasil dihapus.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function hapus_multiple_guru()
    {
        $aduanToDelete = $this->request->getPost('admins_to_delete');

        if ($aduanToDelete) {
            $adminModel = new Data();
            foreach ($aduanToDelete as $aduan) {
                $adminModel->deleteGuru($aduan);
            }

            $response = [
                'status' => 'success',
                'message' => 'Aduan berhasil dihapus.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function edit_admin()
    {
        $adminId = $this->request->getPost('guru_id');
        $editData = [
            'nama_guru' => $this->request->getPost('edit_nama'),
            'username' => $this->request->getPost('edit_username'),
            'password' => $this->request->getPost('edit_password')
        ];

        $adminModel = new Data();

        $adminModel->updateAdminWithLastUpdated($adminId, $editData);

        $response = [
            'status' => 'success',
            'message' => 'Data guru berhasil diperbarui!',
        ];
        return redirect()->to('/data-guru-smp')->with('response', $response);
    }

    public function hapus_multiple_siswa()
    {
        $aduanToDelete = $this->request->getPost('admins_to_delete');

        if ($aduanToDelete) {
            $adminModel = new Data_Siswa();
            foreach ($aduanToDelete as $aduan) {
                $adminModel->deleteSiswa($aduan);
            }

            $response = [
                'status' => 'success',
                'message' => 'Data siswa berhasil dihapus.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function edit_siswa()
    {
        $adminId = $this->request->getPost('guru_id');
        $editData = [
            'nama' => $this->request->getPost('edit_nama'),
            'username' => $this->request->getPost('edit_username'),
            'password' => $this->request->getPost('edit_password'),
            'kelas' => $this->request->getPost('edit_kelas'),
            'poin' => $this->request->getPost('edit_poin')
        ];

        $adminModel = new Data_Siswa();

        $adminModel->updateAdminWithLastUpdated($adminId, $editData);

        $response = [
            'status' => 'success',
            'message' => 'Data siswa berhasil diperbarui!',
        ];
        return redirect()->to('/siswa-smp')->with('response', $response);
    }

    public function tambah_siswa()
    {
        $nama = $this->request->getPost('add_nama');
        $username = $this->request->getPost('add_username');
        $password = $this->request->getPost('add_password');
        $kelas = $this->request->getPost('add_kelas');
        $poin = $this->request->getPost('add_poin');
        $tipe = $this->request->getPost('tipe');

        $model = new Data_Siswa();

        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'kelas' => $kelas,
            'poin' => $poin,
            'tipe' => $tipe
        ];

        $model->insert($data);

        $response = [
            'status' => 'success',
            'message' => 'Data siswa berhasil ditambah!',
        ];
        return redirect()->to('/siswa-smp')->with('response', $response);
    }

    public function tambah_guru()
    {
        $nama = $this->request->getPost('add_nama');
        $username = $this->request->getPost('add_username');
        $password = $this->request->getPost('add_password');
        $kelas = $this->request->getPost('add_kelas');
        $tipe = $this->request->getPost('add_tipe');

        $model = new Data();

        $data = [
            'nama_guru' => $nama,
            'username' => $username,
            'password' => $password,
            'kelas' => $kelas,
            'tipe' => $tipe
        ];

        $model->insert($data);

        $response = [
            'status' => 'success',
            'message' => 'Data guru berhasil ditambah!',
        ];
        return redirect()->to('/data-guru-smp')->with('response', $response);
    }
}
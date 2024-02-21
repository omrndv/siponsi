<?php

namespace App\Controllers;

use App\Models\Data;
use App\Models\Data_Siswa;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function siswa()
    {
        return view('logsis');
    }

    public function proseslogin()
    {
        $model = new Data();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            $alertMessage = "Data tidak boleh ada yang kosong!";
            return redirect()->to('login')->with('alert', $alertMessage);
        }

        $user = $model->getuserbyusername($username);

        if ($user) {
            if ($user['password'] === $password) {
                $session = session();
                $session->set('logged_in', true);
                $session->set('user_id', $user['id']);
                $session->set('tipe', $user['tipe']);
                $session->set('nama', $user['nama_guru']);
                $session->set('username', $user['username']);
                $session->set('kelas', $user['kelas']);

                $pesanSelamatDatang = "Selamat datang, " . $user['nama_guru'] . "!";
                $session->setFlashdata('pesan_selamat_datang', $pesanSelamatDatang);

                if ($user['tipe'] == 'Superuser') {
                    return redirect()->to('/kotak-aduan');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                $alertMessage = "Password salah!";
                return redirect()->to('/login')->with('alert', $alertMessage);
            }
        } else {
            $alertMessage = "Username atau Email tidak ditemukan!";
            return redirect()->to('/login')->with('alert', $alertMessage);
        }
    }

    public function prosesloginsiswa()
    {
        $model = new Data_Siswa();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            $alertMessage = "Data tidak boleh ada yang  kosong!";
            return redirect()->to('login-siswa')->with('alert', $alertMessage);
        }

        $user = $model->getuserbyusername($username);

        if ($user) {
            if ($user['password'] === $password) {
                $session = session();
                $session->set('logged_in', true);
                $session->set('user_id', $user['id']);
                $session->set('tipe', $user['tipe']);
                $session->set('nama', $user['nama']);
                $session->set('kelas', $user['kelas']);
                $session->set('poin', $user['poin']);

                $pesanSelamatDatang = "Selamat datang, " . $user['nama'] . "!";
                $session->setFlashdata('pesan_selamat_datang', $pesanSelamatDatang);

                return redirect()->to('/');

            } else {
                $alertMessage = "Password salah!";
                return redirect()->to('/login-siswa')->with('alert', $alertMessage);
            }
        } else {
            $alertMessage = "Username atau Email tidak ditemukan!";
            return redirect()->to('/login-siswa')->with('alert', $alertMessage);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
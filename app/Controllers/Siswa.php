<?php

namespace App\Controllers;

use App\Models\Data;

class Siswa extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipe') !== 'Siswa') {
            return redirect()->to('/login-siswa');
        }

        $data = [
            'current_page' => 'Home',
            'page' => 'siswa/beranda',
        ];
        return view('template-siswa', $data);
    }

    public function postaduan()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login-siswa');
        }

        $postData = $this->request->getPost();
        $model = new \App\Models\Model_Siswa();

        $inserted = $model->insertdata($postData);

        if ($inserted) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dikirim!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal dikirim!'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function poin()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipe') !== 'Siswa') {
            return redirect()->to('/login-siswa');
        }

        $data = [
            'current_page' => 'Poin',
            'page' => 'siswa/poin',
        ];
        return view('template-siswa', $data);
    }

    public function bootcamp()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipe') !== 'Siswa') {
            return redirect()->to('/login-siswa');
        }

        $model = new Data();
        $students = $model->getStudentsWithPointsGreaterThan40();

        $data = [
            'current_page' => 'Bootcamp',
            'page' => 'siswa/bootcamp',
            'students' => $students,
        ];

        return view('template-siswa', $data);
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi_Model extends Model
{
    protected $table = 'daftar_absen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kelas', 'tanggal', 'status', 'tipe'];

    public function insertdata($data)
    {
        return $this->insert($data);
    }

    public function getDataAbsensi($tanggal, $kelas)
    {
        return $this->where('tanggal', $tanggal)
                    ->where('kelas', $kelas)
                    ->findAll();
    }
    
    public function getData($tanggal)
    {
        return $this->where('tanggal', $tanggal)->findAll();
    }
}

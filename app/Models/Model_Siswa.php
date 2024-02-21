<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Siswa extends Model
{
    protected $table = 'aduan';
    protected $allowedFields = ['nama', 'kelas/jabatan', 'isi'];

    public function insertdata($data)
    {
        return $this->insert($data);
    }
    
    public function deleteAduan($id)
    {
        return $this->delete($id);
    }
}

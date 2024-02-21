<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload_Tugas extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['isi', 'tanggal'];
    
    public function insertdata($data)
    {
        return $this->insert($data);
    }
    
    public function deleteTugas($id)
    {
        return $this->delete($id);
    }
}

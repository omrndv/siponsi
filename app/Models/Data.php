<?php
namespace App\Models;

use CodeIgniter\Model;

class Data extends Model
{
    protected $table = 'datgur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_guru', 'username', 'kelas', 'password', 'tipe'];

    public function getuserbyusername($username)
    {
        return $this->where('username', $username)
            ->orWhere('nama_guru', $username)
            ->first();
    }

    public function getStudentsByTeacherClass($kelas_guru)
    {
        $builder = $this->db->table('datsis');
        $builder->where('kelas', $kelas_guru);
        return $builder->get()->getResultArray();
    }

    public function getStudentsWithPointsGreaterThan40()
    {
        $builder = $this->db->table('datsis');
        $builder->where('poin >', 74);
        return $builder->get()->getResultArray();
    }

    public function deleteGuru($id)
    {
        return $this->delete($id);
    }

    public function updateAdminWithLastUpdated($id, $editData)
    {
        return $this->where('id', $id)
            ->set($editData) 
            ->update();
    }
}
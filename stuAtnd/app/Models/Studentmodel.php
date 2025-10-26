<?php
namespace App\Models;

use CodeIgniter\Model;

class Studentmodel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'student_name', 'course'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}

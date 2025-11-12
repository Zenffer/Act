<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['s_lastname', 's_firstname', 's_middlename', 'course'];

    public function getAllStudents()
    {
        return $this->orderBy('s_lastname', 'ASC')->findAll();
    }

    public function addStudent(array $data)
    {
        return $this->insert($data);
    }
}

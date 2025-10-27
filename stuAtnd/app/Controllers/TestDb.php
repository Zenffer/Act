<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;

class TestDb extends Controller
{
   public function index()
{
    $studentModel = new \App\Models\StudentModel();

    // (Optional) Insert a test record only if table is empty
    if ($studentModel->countAll() == 0) {
        $studentModel->insert([
            'student_number' => '2025-001',
            'first_name'     => 'John',
            'last_name'      => 'Doe',
            'course'         => 'BSIT',
            'year_level'     => 3,
        ]);
    }

    $data['students'] = $studentModel->findAll();

    return view('students/index', $data);
}
}

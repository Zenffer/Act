<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'date',
        'status'
    ];

    // Custom method to fetch attendance with student name
    public function getAttendanceByDate($date)
    {
        return $this->select('attendance.*, students.student_name')
                    ->join('students', 'students.id = attendance.student_id')
                    ->where('attendance.date', $date)
                    ->findAll();
    }
}

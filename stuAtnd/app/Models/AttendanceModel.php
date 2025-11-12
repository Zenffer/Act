<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'record_attendance';
    protected $allowedFields = ['student_id', 'status', 'attendance_data'];
    public $timestamps = false;

    public function recordForDate(string $date)
    {
        return $this->select('record_attendance.*, students.s_lastname, students.s_firstname, students.course')
            ->join('students', 'students.student_id = record_attendance.student_id', 'left')
            ->where('attendance_data', $date)
            ->orderBy('students.s_lastname', 'ASC')
            ->findAll();
    }

    public function recordExists(int $student_id, string $date): bool
    {
        return (bool) $this->where(['student_id' => $student_id, 'attendance_data' => $date])->countAllResults();
    }

    public function saveRecords(array $records)
    {
        // $records: array of ['student_id'=>int, 'status'=>string, 'attendance_data'=>date]
        foreach ($records as $r) {
            // upsert: delete existing then insert (simple approach)
            $this->where(['student_id' => $r['student_id'], 'attendance_data' => $r['attendance_data']])->delete();
            $this->insert($r);
        }
        return true;
    }
}

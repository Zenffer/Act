<?php
namespace App\Models;

use CodeIgniter\Model;

class Attendancemodel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'date', 'status'];
    protected $useTimestamps = false;

    public function upsertRecord(string $studentId, string $date, string $status): bool
    {
        // Try to find existing
        $existing = $this->where('student_id', $studentId)
            ->where('date', $date)
            ->first();
        if ($existing) {
            return (bool)$this->update($existing['id'], [
                'status' => $status,
            ]);
        }
        return (bool)$this->insert([
            'student_id' => $studentId,
            'date' => $date,
            'status' => $status,
        ]);
    }

    public function getByDate(string $date): array
    {
        // Join with students for names/courses
        return $this->select('attendance.*, students.student_name, students.course')
            ->join('students', 'students.student_id = attendance.student_id', 'left')
            ->where('attendance.date', $date)
            ->orderBy('students.student_name', 'ASC')
            ->findAll();
    }
}

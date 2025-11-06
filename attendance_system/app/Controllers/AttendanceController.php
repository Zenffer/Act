<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AttendanceModel;
use CodeIgniter\Controller;

class AttendanceController extends Controller
{
    // Display homepage with list of students
    public function index()
    {
        $studentModel = new StudentModel();
        $data['students'] = $studentModel->findAll();

        return view('attendance/index', $data);
    }

    // Show form to add a new student
    public function addStudent()
    {
        return view('attendance/add_student');
    }

    // Handle post request to save a new student
    public function saveStudent()
    {
        $studentModel = new StudentModel();

        $studentModel->save([
            'student_name' => $this->request->getPost('student_name'),
            'student_id'   => $this->request->getPost('student_id'),
            'course'       => $this->request->getPost('course'),
        ]);

        return redirect()->to('/')->with('message', 'Student added successfully!');
    }

    // Show attendance marking form
    public function attendanceForm()
    {
        $studentModel = new StudentModel();
        $data['students'] = $studentModel->findAll();
        $data['date'] = date('Y-m-d'); // default date is today

        return view('attendance/mark_attendance', $data);
    }

    // Handle post request to save attendance
    public function saveAttendance()
    {
        $attendanceModel = new AttendanceModel();
        $date = $this->request->getPost('date');
        $statuses = $this->request->getPost('status');

        // Iterate through each student status and save
        foreach ($statuses as $student_id => $status) {
            $attendanceModel->save([
                'student_id' => $student_id,
                'date'       => $date,
                'status'     => $status,
            ]);
        }

        return redirect()->to('/')->with('message', 'Attendance saved successfully!');
    }

    // Show attendance report for a specific date
    public function report()
    {
        $attendanceModel = new AttendanceModel();
        $date = $this->request->getGet('date') ?? date('Y-m-d'); // default date is today
        $data['attendance'] = $attendanceModel->getAttendanceByDate($date);
        $data['date'] = $date;

        return view('attendance/report', $data);
    }
}

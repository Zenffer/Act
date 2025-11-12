<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AttendanceModel;

class Home extends BaseController
{
    public function index()
    {
        // show a small dashboard linking to features
        return view('index');
    }

    public function students()
    {
        $model = new StudentModel();
        $data['students'] = $model->getAllStudents();
        return view('add_student', $data);
    }

    public function addStudent()
    {
        $model = new StudentModel();
        $post = $this->request->getPost();

        $data = [
            's_lastname' => $post['s_lastname'] ?? '',
            's_firstname' => $post['s_firstname'] ?? '',
            's_middlename' => $post['s_middlename'] ?? null,
            'course' => $post['course'] ?? '',
        ];

        $model->addStudent($data);

        return redirect()->to('/students')->with('message', 'Student added');
    }

    public function attendanceForm()
    {
        $studentModel = new StudentModel();
        $data['students'] = $studentModel->getAllStudents();
        // default date is today
        $data['date'] = $this->request->getGet('date') ?? date('Y-m-d');

        $attendanceModel = new AttendanceModel();
        $data['records'] = $attendanceModel->recordForDate($data['date']);

        return view('attendance_form', $data);
    }

    public function submitAttendance()
    {
        $attendanceModel = new AttendanceModel();
        $post = $this->request->getPost();
        $date = $post['attendance_date'] ?? date('Y-m-d');

        $records = [];
        if (isset($post['status']) && is_array($post['status'])) {
            foreach ($post['status'] as $student_id => $status) {
                $records[] = [
                    'student_id' => (int)$student_id,
                    'status' => $status,
                    'attendance_data' => $date,
                ];
            }
        }

        $attendanceModel->saveRecords($records);

        return redirect()->to('/attendance-form?date=' . $date)->with('message', 'Attendance saved');
    }

    public function attendanceReport()
    {
        $attendanceModel = new AttendanceModel();
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $data['date'] = $date;
        $data['records'] = $attendanceModel->recordForDate($date);

        return view('attendance_report', $data);
    }
}

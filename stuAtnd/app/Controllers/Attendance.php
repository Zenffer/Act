<?php
namespace App\Controllers;

use App\Models\Studentmodel;
use App\Models\Attendancemodel;
use CodeIgniter\Controller;

class Attendance extends Controller
{
    protected $helpers = ['url', 'form'];

    public function index()
    {
        $studentModel = new Studentmodel();
        $students = $studentModel->orderBy('id', 'DESC')->findAll();

        return view('attendance/attendance', [
            'students' => $students,
        ]);
    }

    public function addStudent()
    {
        return view('attendance/addstudent');
    }

    public function saveStudent()
    {
        $rules = [
            'student_id' => 'required|min_length[1]|max_length[50]',
            'student_name' => 'required|min_length[2]|max_length[100]',
            'course' => 'required|min_length[2]|max_length[100]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $studentModel = new Studentmodel();
        $studentModel->save([
            'student_id' => $this->request->getPost('student_id'),
            'student_name' => $this->request->getPost('student_name'),
            'course' => $this->request->getPost('course')
        ]);

        return redirect()->to(site_url('attendance'));
    }

    public function mark()
    {
        $studentModel = new Studentmodel();
        $students = $studentModel->orderBy('student_name', 'ASC')->findAll();
        $date = $this->request->getGet('date') ?? date('Y-m-d');

        return view('attendance/attendance', [
            'students' => $students,
            'marking' => true,
            'date' => $date,
        ]);
    }

    public function saveAttendance()
    {
        $date = $this->request->getPost('date');
        $statuses = $this->request->getPost('status'); // array: key=student_id, value=Present/Absent

        if (!$date || !is_array($statuses)) {
            return redirect()->back()->with('errors', ['Invalid input provided.']);
        }

        $attendanceModel = new Attendancemodel();

        foreach ($statuses as $studentId => $status) {
            $attendanceModel->upsertRecord($studentId, $date, $status);
        }

        return redirect()->to(site_url('attendance/report?date=' . urlencode($date)));
    }

    public function report()
    {
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $attendanceModel = new Attendancemodel();

        $report = $attendanceModel->getByDate($date);

        return view('attendance/report', [
            'date' => $date,
            'report' => $report,
        ]);
    }
}

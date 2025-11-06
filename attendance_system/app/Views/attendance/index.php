<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Management</title>
</head>
<body>

    <h1>Welcome to the Student Attendance Management System</h1>

    <!-- Navigation -->
    <nav>
        <a href="/add-student">Add New Student</a> |
        <a href="/attendance">Take Attendance</a> |
        <a href="/report">View Attendance Report</a>
    </nav>

    <hr>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('message')): ?>
        <p style="color: green;"><?= session()->getFlashdata('message'); ?></p>
    <?php endif; ?>

    <!-- Students List -->
    <h2>Student List</h2>

    <?php if (!empty($students)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Course</th>
            </tr>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id']; ?></td>
                <td><?= $student['student_name']; ?></td>
                <td><?= $student['student_id']; ?></td>
                <td><?= $student['course']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No students found. <a href="/add-student">Add a student</a></p>
    <?php endif; ?>

</body>
</html>

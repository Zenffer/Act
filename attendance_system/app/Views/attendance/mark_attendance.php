<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>  
    <h2>Mark Attendance</h2>
<form method="post" action="/save-attendance">
    <input type="date" name="date" value="<?= $date ?>" required><br><br>
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>Present</th>
            <th>Absent</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['student_name'] ?></td>
            <td><input type="radio" name="status[<?= $student['id'] ?>]" value="Present" required></td>
            <td><input type="radio" name="status[<?= $student['id'] ?>]" value="Absent"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit">Submit</button>
</form>
</body>
</html> 
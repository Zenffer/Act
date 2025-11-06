<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>  
    <h2>Attendance Report</h2>
<form method="get" action="/report">
    <input type="date" name="date" value="<?= $date ?>">
    <button type="submit">Filter</button>
</form>

<table border="1">
    <tr>
        <th>Student Name</th>
        <th>Status</th>
    </tr>
    <?php foreach ($attendance as $record): ?>
    <tr>
        <td><?= $record['student_name'] ?></td>
        <td><?= $record['status'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>


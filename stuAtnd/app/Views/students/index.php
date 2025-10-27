<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4 text-center">Student Records</h1>

    <?php if (!empty($students)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Student Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= esc($s['id']) ?></td>
                    <td><?= esc($s['student_number']) ?></td>
                    <td><?= esc($s['first_name']) ?></td>
                    <td><?= esc($s['last_name']) ?></td>
                    <td><?= esc($s['course']) ?></td>
                    <td><?= esc($s['year_level']) ?></td>
                    <td><?= esc($s['created_at']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No student records found.</div>
    <?php endif; ?>

</div>
</body>
</html>


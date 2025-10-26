<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Student Attendance</h3>
    <div>
      <a href="<?= site_url('attendance/addStudent') ?>" class="btn btn-success">Add Student</a>
      <a href="<?= site_url('attendance/report') ?>" class="btn btn-info">View Report</a>
    </div>
  </div>

  <?php if(!isset($marking) || !$marking): ?>
    <div class="card mb-3">
      <div class="card-header">Students</div>
      <div class="card-body p-0">
        <table class="table mb-0 table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Student ID</th>
              <th>Name</th>
              <th>Course</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($students)): $i=1; foreach($students as $s): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= esc($s['student_id']) ?></td>
              <td><?= esc($s['student_name']) ?></td>
              <td><?= esc($s['course']) ?></td>
            </tr>
          <?php endforeach; else: ?>
            <tr><td colspan="4" class="text-center">No students found.</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="text-end">
      <a href="<?= site_url('attendance/mark') ?>" class="btn btn-primary">Mark Today's Attendance</a>
    </div>

  <?php else: ?>
    <form method="post" action="<?= site_url('attendance/saveAttendance') ?>">
      <?= csrf_field() ?>
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <div class="me-3">Mark Attendance</div>
          <input type="date" name="date" class="form-control w-auto" value="<?= esc($date ?? date('Y-m-d')) ?>">
        </div>
        <div class="card-body p-0">
          <table class="table mb-0 table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php if(!empty($students)): $i=1; foreach($students as $s): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($s['student_id']) ?></td>
                <td><?= esc($s['student_name']) ?></td>
                <td><?= esc($s['course']) ?></td>
                <td>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status[<?= esc($s['student_id']) ?>]" id="p<?= esc($s['student_id']) ?>" value="Present" required>
                    <label class="form-check-label" for="p<?= esc($s['student_id']) ?>">Present</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status[<?= esc($s['student_id']) ?>]" id="a<?= esc($s['student_id']) ?>" value="Absent" required>
                    <label class="form-check-label" for="a<?= esc($s['student_id']) ?>">Absent</label>
                  </div>
                </td>
              </tr>
            <?php endforeach; else: ?>
              <tr><td colspan="5" class="text-center">No students found.</td></tr>
            <?php endif; ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Save Attendance</button>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>
</body>
</html>

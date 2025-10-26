<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Attendance Report</h3>
    <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">Back</a>
  </div>

  <form method="get" action="<?= site_url('attendance/report') ?>" class="mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <label class="col-form-label">Select Date</label>
      </div>
      <div class="col-auto">
        <input type="date" name="date" class="form-control" value="<?= esc($date ?? date('Y-m-d')) ?>">
      </div>
      <div class="col-auto">
        <button class="btn btn-primary" type="submit">View</button>
      </div>
    </div>
  </form>

  <div class="card">
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
        <?php if(!empty($report)): $i=1; foreach($report as $r): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= esc($r['student_id']) ?></td>
            <td><?= esc($r['student_name']) ?></td>
            <td><?= esc($r['course']) ?></td>
            <td>
              <?php if(strtolower($r['status']) === 'present'): ?>
                <span class="badge bg-success">Present</span>
              <?php elseif(strtolower($r['status']) === 'absent'): ?>
                <span class="badge bg-danger">Absent</span>
              <?php else: ?>
                <span class="badge bg-secondary">-</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="5" class="text-center">No records found for this date.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

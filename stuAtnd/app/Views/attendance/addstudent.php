<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Add Student</h3>
    <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">Back</a>
  </div>

  <?php if(session()->getFlashdata('errors')): $errors = session()->getFlashdata('errors'); ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach($errors as $e): ?>
          <li><?= esc($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <form method="post" action="<?= site_url('attendance/saveStudent') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label class="form-label">Student ID</label>
          <input type="text" name="student_id" class="form-control" value="<?= old('student_id') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Student Name</label>
          <input type="text" name="student_name" class="form-control" value="<?= old('student_name') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Course</label>
          <input type="text" name="course" class="form-control" value="<?= old('course') ?>" required>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>

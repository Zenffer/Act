<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body> 

<h2>Add Student</h2>
<form method="post" action="/save-student">
    <input type="text" name="student_name" placeholder="Student Name" required>
    <input type="text" name="student_id" placeholder="Student ID" required>
    <input type="text" name="course" placeholder="Course" required>
    <button type="submit">Save</button>
</form>
</body>
</html>
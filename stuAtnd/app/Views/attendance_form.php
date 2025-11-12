<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            height: 100vh;
            color: #333;
        }

        /* ===== SIDEBAR ===== */
        aside {
            width: 280px;
            background: #2e7d32;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            gap: 20px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        aside h1 {
            font-size: 1.6em;
            font-weight: 600;
        }

        aside form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-size: 0.9em;
            display: flex;
            flex-direction: column;
        }

        input[type="date"] {
            padding: 8px 10px;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 0.95em;
        }

        button {
            background-color: #43a047;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #388e3c;
        }

        a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            background-color: #1e88e5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.2s ease-in-out;
        }

        a:hover {
            background-color: #1565c0;
        }

        /* ===== MAIN SECTION ===== */
        section {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        section h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #1e88e5;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td:first-child, th:first-child {
            text-align: left;
        }

        /* ===== FLASH MESSAGE ===== */
        .flash {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            aside {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                gap: 10px;
            }

            section {
                padding: 20px;
            }

            table th, table td {
                padding: 10px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <aside>
        <h1>Attendance Form</h1>

        <?php if (session()->getFlashdata('message')): ?>
            <p class="flash"><?= session()->getFlashdata('message') ?></p>
        <?php endif; ?>

        <form method="get" action="/attendance-form">
            <label>
                Select date:
                <input type="date" name="date" value="<?= esc($date) ?>">
            </label>
            <button type="submit">Load</button>
        </form>

        <a href="students">Add Students</a>
        <a href="attendance-report">View Reports</a>
    </aside>

    <section>
        <form method="post" action="/submit-attendance">
            <?= csrf_field() ?>
            <input type="hidden" name="attendance_date" value="<?= esc($date) ?>">

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // map existing records by student_id for this date
                    $map = [];
                    if (!empty($records)) {
                        foreach ($records as $r) {
                            $map[$r['student_id']] = $r['status'];
                        }
                    }
                    if (!empty($students)):
                        foreach ($students as $i => $s):
                            $sid = $s['student_id'];
                            $status = $map[$sid] ?? '';
                    ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($s['s_lastname']) ?>, <?= esc($s['s_firstname']) ?></td>
                            <td><?= esc($s['course']) ?></td>
                            <td><input type="radio" name="status[<?= $sid ?>]" value="PRESENT" <?= $status === 'PRESENT' ? 'checked' : '' ?>></td>
                            <td><input type="radio" name="status[<?= $sid ?>]" value="ABSENT" <?= $status === 'ABSENT' ? 'checked' : '' ?>></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5">No students available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <button type="submit">Save Attendance for <?= esc($date) ?></button>
        </form>
    </section>
</body>
</html>

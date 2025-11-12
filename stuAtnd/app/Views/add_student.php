<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        /* ==== RESET & BASE ==== */
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

        /* ==== SIDEBAR ==== */
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
            margin-bottom: 10px;
        }

        aside hr {
            border: 0;
            border-top: 1px solid rgba(255,255,255,0.3);
            margin: 10px 0;
        }

        /* ==== FORM ==== */
        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            display: flex;
            flex-direction: column;
            font-size: 0.9em;
        }

        input {
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
            margin-top: 10px;
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

        /* ==== MAIN SECTION ==== */
        section {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        section h2 {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
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

        /* ==== FLASH MESSAGE ==== */
        p[style*="color:green"] {
            background: #d4edda;
            color: #155724 !important;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        /* ==== RESPONSIVE ==== */
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
        }
    </style>
</head>
<body>
    <aside>
        <h1>Add Student</h1>
        <?php if(session()->getFlashdata('message')): ?>
            <p style="color:green"><?= session()->getFlashdata('message') ?></p>
        <?php endif ?>
        <hr>    
        <form method="post" action="/add-student">
            <?= csrf_field() ?>
            <label>Last name <input type="text" name="s_lastname" required></label>
            <label>First name <input type="text" name="s_firstname" required></label>
            <label>Middle name <input type="text" name="s_middlename"></label>
            <label>Course <input type="text" name="course" required></label>
            <button type="submit">Add Student</button>
        </form>
        <a href="attendance-form">Manage Attendance</a>
        <a href="attendance-report">View Reports</a>
    </aside>

    <section>
        <h2>Students</h2>
        <?php if (!empty($students)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $s): ?>
                        <tr>
                            <td><?= esc($s['student_id']) ?></td>
                            <td><?= esc($s['s_lastname']) ?>, <?= esc($s['s_firstname']) ?> <?= esc($s['s_middlename']) ?></td>
                            <td><?= esc($s['course']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No students yet.</p>
        <?php endif ?>
    </section>
</body>
</html>

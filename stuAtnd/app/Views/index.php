<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory</title>
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
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* ===== HEADER ===== */
        header {
            background-color: #2e7d32;
            color: white;
            font-size: 1.8em;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 8px;
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* ===== LINK CARDS ===== */
        .links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 800px;
        }

        .link-card {
            background-color: white;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 1.2em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
        }

        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        /* Different accent colors for each section */
        .link-student { border-top: 5px solid #43a047; }
        .link-attendance { border-top: 5px solid #1e88e5; }
        .link-report { border-top: 5px solid #f57c00; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            header {
                font-size: 1.4em;
                text-align: center;
            }

            .link-card {
                padding: 30px 10px;
                font-size: 1.1em;
            }
        }
    </style>
</head>
<body>
    <header>Choose Directory</header>

    <div class="links">
        <a href="students" class="link-card link-student">Add Student</a>
        <a href="attendance-form" class="link-card link-attendance">Attendance Form</a>
        <a href="attendance-report" class="link-card link-report">Attendance Report</a>
    </div>
</body>
</html>

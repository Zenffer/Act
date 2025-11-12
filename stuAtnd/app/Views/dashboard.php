<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
            padding: 20px;
        }

        /* ===== CONTAINER ===== */
        .dashboard-container {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #2e7d32;
            margin-bottom: 15px;
        }

        p {
            font-size: 1em;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        a.logout-btn,
        a.index-btn {
            display: inline-block;
            text-decoration: none;
            color: white;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
            width: 100%;
            max-width: 200px;
        }

        a.index-btn {
            background-color: #2e7d32;
        }

        a.index-btn:hover {
            background-color: #1b5e20;
        }

        a.logout-btn {
            background-color: #c62828;
        }

        a.logout-btn:hover {
            background-color: #b71c1c;
        }

        @media (max-width: 500px) {
            .dashboard-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?= session()->get('username') ?>!</h2>
        <p>Your email: <?= session()->get('email') ?></p>
        <div class="button-group">
            <a class="index-btn" href="<?= base_url('home') ?>">Go to Directory</a>
            <a class="logout-btn" href="<?= base_url('logout') ?>">Logout</a>
        </div>
    </div>
</body>
</html>

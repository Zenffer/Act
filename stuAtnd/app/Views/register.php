<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        /* ===== REGISTER CARD ===== */
        .register-container {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        /* ===== FLASH MESSAGE ===== */
        .flash-error {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* ===== FORM ===== */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #43a047;
            color: white;
            font-weight: 600;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #388e3c;
        }

        /* ===== LOGIN LINK ===== */
        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #1e88e5;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 500px) {
            .register-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="flash-error"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

        <form method="post" action="<?= base_url('register/save') ?>">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="<?= base_url('/') ?>">Login here</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: #ffffff;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        button[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: #ffffff;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            margin-top: 10px;
            /* Add top padding */
        }

        button[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="post" action="adminLogin.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="button" onclick="submitForm()">Login</button>

            <?php if (isset($loginError)) : ?>
                <div class="error"><?php echo $loginError; ?></div>
            <?php endif; ?>
        </form>
    </div>

    <script>
        function submitForm() {
            // Add your logic here to handle form submission
            document.forms[0].submit();
        }
    </script>
</body>

</html>
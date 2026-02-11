<?php
session_start();
include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == "admin") {
            header("Location: admin/dashboard.php");
        } elseif ($row['role'] == "vendor") {
            header("Location: vendor/dashboard.php");
        } else {
            header("Location: user/dashboard.php");
        }

        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Management System - Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6e6e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 600px;
            background: #f2f2f2;
            padding: 40px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }

        .title {
            background: linear-gradient(to right, #a3c4f3, #cfe0f9);
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group label {
            width: 120px;
            background-color: #4a76b8;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 0 0 5px;
        }

        .form-group input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 5px 5px 0;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .button-group button {
            padding: 10px 30px;
            margin: 0 20px;
            border: none;
            background: linear-gradient(to bottom, #bfbfbf, #8c8c8c);
            color: black;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-group button:hover {
            background: linear-gradient(to bottom, #999, #666);
            color: white;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="title">
        Event Management System
    </div>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">

        <div class="form-group">
            <label>User Id</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="button-group">
            <button type="reset">Cancel</button>
            <button type="submit">Login</button>
        </div>

    </form>

</div>

</body>
</html>

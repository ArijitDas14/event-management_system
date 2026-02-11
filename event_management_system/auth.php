<?php
session_start();
include("config/db.php");

/* ---------------- LOGIN ---------------- */

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

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
        $login_error = "Invalid Credentials!";
    }
}


/* ---------------- SIGNUP ---------------- */

if (isset($_POST['signup'])) {

    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $role = $_POST['role'];

    $check = $conn->query("SELECT * FROM users WHERE username='$new_username'");

    if ($check->num_rows > 0) {
        $signup_error = "Username already exists!";
    } else {

        $conn->query("INSERT INTO users (username, password, role) 
                      VALUES ('$new_username', '$new_password', '$role')");

        $signup_success = "Account Created Successfully! Now Login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Management System</title>

<style>
body {
    font-family: Arial;
    background: #e6e6e6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 800px;
    background: #f2f2f2;
    padding: 40px;
    display: flex;
    gap: 40px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

.section {
    width: 50%;
}

h2 {
    background: #4a76b8;
    color: white;
    padding: 10px;
    text-align: center;
}

input, select {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
}

button {
    padding: 8px 20px;
    background: gray;
    border: none;
    cursor: pointer;
}

.error { color: red; }
.success { color: green; }

</style>
</head>

<body>

<div class="container">

    <!-- LOGIN SECTION -->
    <div class="section">
        <h2>Login</h2>

        <?php if(isset($login_error)) echo "<p class='error'>$login_error</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>


    <!-- SIGNUP SECTION -->
    <div class="section">
        <h2>Sign Up</h2>

        <?php if(isset($signup_error)) echo "<p class='error'>$signup_error</p>"; ?>
        <?php if(isset($signup_success)) echo "<p class='success'>$signup_success</p>"; ?>

        <form method="POST">
            <input type="text" name="new_username" placeholder="Username" required>
            <input type="password" name="new_password" placeholder="Password" required>

            <select name="role" required>
                <option value="">Select Role</option>
                <option value="vendor">Vendor</option>
                <option value="user">User</option>
            </select>

            <button type="submit" name="signup">Sign Up</button>
        </form>
    </div>

</div>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "vendor") {
    header("Location: ../auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Vendor Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #e6e6e6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Main Blue Box */
.dashboard-container {
    width: 800px;
    background-color: #4f76b5;
    padding: 60px 40px;
    text-align: center;
}

/* Welcome Box */
.welcome-box {
    background-color: #d9d9d9;
    padding: 15px;
    margin-bottom: 40px;
    font-size: 18px;
    font-weight: bold;
}

/* Button Styling */
.menu-buttons {
    display: flex;
    justify-content: center;
    gap: 30px;
}

.menu-buttons a {
    text-decoration: none;
}

.menu-buttons button {
    padding: 12px 25px;
    border: none;
    background: #d9d9d9;
    cursor: pointer;
    font-weight: bold;
    border-radius: 6px;
    transition: 0.3s;
}

.menu-buttons button:hover {
    background: #bfbfbf;
}
</style>

</head>
<body>

<div class="dashboard-container">

    <div class="welcome-box">
        Welcome Vendor
    </div>

    <div class="menu-buttons">
        <a href="view_products.php">
            <button>Your Item</button>
        </a>

        <a href="add_product.php">
            <button>Add New Item</button>
        </a>
        
        <a href="../logout.php">
            <button>LogOut</button>
        </a>
    </div>

</div>

</body>
</html>



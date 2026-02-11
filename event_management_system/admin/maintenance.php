<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Maintenance</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #e6e6e6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Main Container */
.main-box {
    width: 900px;
    background: #d9d9d9;
    padding: 50px;
    position: relative;
}

/* Top Buttons */
.top-btn {
    position: absolute;
    top: 20px;
    padding: 8px 25px;
    background: white;
    border: 2px solid #4CAF50;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    color: black;
    font-weight: bold;
}

.home-btn {
    left: 20px;
}

.logout-btn {
    right: 20px;
}

/* Section Layout */
.section {
    margin-top: 80px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-title {
    background: white;
    padding: 10px 30px;
    border: 2px solid #4CAF50;
    border-radius: 6px;
    font-weight: bold;
}

/* Button Column */
.btn-column {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.action-btn {
    padding: 8px 30px;
    background: white;
    border: 2px solid #4CAF50;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    color: black;
    text-align: center;
}
</style>

</head>
<body>

<div class="main-box">

    <!-- Top Buttons -->
    <a href="dashboard.php" class="top-btn home-btn">Home</a>
    <a href="../logout.php" class="top-btn logout-btn">LogOut</a>

    <!-- Membership Section -->
    <div class="section">
        <div class="section-title">Membership</div>

        <div class="btn-column">
            <a href="add_membership.php" class="action-btn">Add</a>
            <a href="update_membership.php" class="action-btn">Update</a>
        </div>
    </div>

    <!-- User Management Section -->
    <div class="section">
        <div class="section-title">User Management</div>

        <div class="btn-column">
            <a href="#" class="action-btn">Add</a>
            <a href="#" class="action-btn">Update</a>
        </div>
    </div>

</div>

</body>
</html>

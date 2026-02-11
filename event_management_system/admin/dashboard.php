<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}
?>

<h2>Admin Dashboard</h2>
<p>Welcome Admin</p>
<a href="add_membership.php">Add Membership</a><br><br>
<a href="update_membership.php">Update Membership</a><br><br>

<a href="../logout.php">Logout</a>

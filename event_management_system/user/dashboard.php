<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}
?>

<h2>User Dashboard</h2>

<a href="view_products.php">View Products</a><br><br>
<a href="cart.php">View Cart</a><br><br>
<a href="../logout.php">Logout</a>
<a href="order_status.php">Order Status</a><br><br>
<a href="guest_list.php">Guest List</a><br><br>



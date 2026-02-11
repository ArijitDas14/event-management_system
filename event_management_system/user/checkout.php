<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT products.price 
                        FROM cart 
                        JOIN products ON cart.product_id = products.product_id
                        WHERE cart.user_id='$user_id'");

$total = 0;
while($row = $result->fetch_assoc()) {
    $total += $row['price'];
}

$conn->query("INSERT INTO orders (user_id, total_amount, status)
              VALUES ('$user_id', '$total', 'Pending')");

$conn->query("DELETE FROM cart WHERE user_id='$user_id'");
?>

<h2>Order Placed Successfully!</h2>

<p>Total Paid: <?php echo $total; ?></p>

<a href="dashboard.php">Back to Dashboard</a>

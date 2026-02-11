<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM orders WHERE user_id='$user_id'");
?>

<h2>Your Orders</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Order ID</th>
    <th>Total Amount</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['order_id']; ?></td>
    <td><?php echo $row['total_amount']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back</a>

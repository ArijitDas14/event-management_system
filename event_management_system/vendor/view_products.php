<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "vendor") {
    header("Location: ../login.php");
    exit();
}

$vendor_id = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE product_id='$id'");
}

$result = $conn->query("SELECT * FROM products WHERE vendor_id='$vendor_id'");
?>

<h2>Your Products</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <a href="?delete=<?php echo $row['product_id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>

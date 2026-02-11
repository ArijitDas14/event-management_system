<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    $conn->query("INSERT INTO cart (user_id, product_id, quantity) 
                  VALUES ('$user_id', '$product_id', 1)");
}

$result = $conn->query("SELECT * FROM products WHERE status='Available'");
?>

<h2>Available Products</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td>
        <a href="?add=<?php echo $row['product_id']; ?>">Add to Cart</a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="cart.php">Go to Cart</a><br><br>
<a href="dashboard.php">Back to Dashboard</a>

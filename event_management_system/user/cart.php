<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE cart_id='$id'");
}

$result = $conn->query("SELECT cart.cart_id, products.product_name, products.price 
                        FROM cart 
                        JOIN products ON cart.product_id = products.product_id
                        WHERE cart.user_id='$user_id'");

$total = 0;
?>

<h2>Your Cart</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { 
    $total += $row['price'];
?>
<tr>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td>
        <a href="?remove=<?php echo $row['cart_id']; ?>">Remove</a>
    </td>
</tr>
<?php } ?>
</table>

<h3>Total Amount: <?php echo $total; ?></h3>

<a href="checkout.php">Proceed to Checkout</a><br><br>
<a href="view_products.php">Back</a>


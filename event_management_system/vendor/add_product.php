<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "vendor") {
    header("Location: ../login.php");
    exit();
}

$vendor_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO products (vendor_id, product_name, price, status)
            VALUES ('$vendor_id', '$product_name', '$price', '$status')";

    if ($conn->query($sql) === TRUE) {
        $success = "Product Added Successfully!";
    } else {
        $error = "Error!";
    }
}
?>

<h2>Add Product</h2>

<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Product Name:
    <input type="text" name="product_name" required><br><br>

    Price:
    <input type="number" step="0.01" name="price" required><br><br>

    Status:<br>
    <input type="radio" name="status" value="Available" checked> Available<br>
    <input type="radio" name="status" value="Out of Stock"> Out of Stock<br><br>

    <button type="submit">Add Product</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

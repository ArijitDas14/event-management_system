<form method="POST">
    Product Name: <input type="text" name="product_name" required><br>
    Price: <input type="number" name="price" required><br>

    Status:
    <input type="radio" name="status" value="Available" checked> Available
    <input type="radio" name="status" value="Out of Stock"> Out of Stock

    <button type="submit">Add Item</button>
</form>
if ($_SESSION['role'] != "vendor") {
    header("Location: ../login.php");
    exit();
}

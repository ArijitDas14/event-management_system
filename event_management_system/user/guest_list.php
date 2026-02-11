<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "user") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_name = $_POST['guest_name'];
    $contact = $_POST['contact'];

    $conn->query("INSERT INTO guest_list (user_id, guest_name, contact)
                  VALUES ('$user_id', '$guest_name', '$contact')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM guest_list WHERE guest_id='$id'");
}

$result = $conn->query("SELECT * FROM guest_list WHERE user_id='$user_id'");
?>

<h2>Guest List</h2>

<form method="POST">
    Guest Name:
    <input type="text" name="guest_name" required>
    Contact:
    <input type="text" name="contact" required>
    <button type="submit">Add Guest</button>
</form>

<br>

<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Contact</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['guest_name']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    <td>
        <a href="?delete=<?php echo $row['guest_id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back</a>

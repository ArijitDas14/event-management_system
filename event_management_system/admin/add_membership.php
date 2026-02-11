<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vendor_id = $_POST['vendor_id'];
    $duration = $_POST['duration'];
    $start_date = date("Y-m-d");

    if ($duration == "6 months") {
        $expiry_date = date("Y-m-d", strtotime("+6 months"));
    } elseif ($duration == "1 year") {
        $expiry_date = date("Y-m-d", strtotime("+1 year"));
    } else {
        $expiry_date = date("Y-m-d", strtotime("+2 years"));
    }

    $sql = "INSERT INTO membership (vendor_id, duration, start_date, expiry_date)
            VALUES ('$vendor_id', '$duration', '$start_date', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        $success = "Membership Added Successfully!";
    } else {
        $error = "Error!";
    }
}
?>

<h2>Add Membership</h2>

<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Vendor ID:
    <input type="number" name="vendor_id" required><br><br>

    Duration:<br>
    <input type="radio" name="duration" value="6 months" checked> 6 Months<br>
    <input type="radio" name="duration" value="1 year"> 1 Year<br>
    <input type="radio" name="duration" value="2 years"> 2 Years<br><br>

    <button type="submit">Add Membership</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

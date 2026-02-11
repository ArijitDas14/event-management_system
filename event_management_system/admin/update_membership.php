<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $membership_no = $_POST['membership_no'];
    $duration = $_POST['duration'];

    if ($duration == "6 months") {
        $expiry_date = date("Y-m-d", strtotime("+6 months"));
    } elseif ($duration == "1 year") {
        $expiry_date = date("Y-m-d", strtotime("+1 year"));
    } else {
        $expiry_date = date("Y-m-d", strtotime("+2 years"));
    }

    $sql = "UPDATE membership 
            SET duration='$duration', expiry_date='$expiry_date' 
            WHERE membership_no='$membership_no'";

    if ($conn->query($sql) === TRUE) {
        $success = "Membership Updated Successfully!";
    } else {
        $error = "Update Failed!";
    }
}
?>

<h2>Update Membership</h2>

<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Membership Number:
    <input type="number" name="membership_no" required><br><br>

    New Duration:<br>
    <input type="radio" name="duration" value="6 months" checked> 6 Months<br>
    <input type="radio" name="duration" value="1 year"> 1 Year<br>
    <input type="radio" name="duration" value="2 years"> 2 Years<br><br>

    <button type="submit">Update Membership</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

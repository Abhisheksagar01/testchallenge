<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$host = 'localhost:3306';
$user = 'root';
$pass1 = '';
$db = 'testchallenge';

// Create a database connection
$conn = mysqli_connect($host, $user, $pass1, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];
$newUserId = $_POST['new_user_id'];
$newPassword = $_POST['new_password'];

// Use prepared statements to update user ID and password
$sql = "UPDATE register SET user_id = ?, password = ? WHERE uname = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "sss", $newUserId, $newPassword, $username);
mysqli_stmt_execute($stmt);

// Check if the update was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Profile updated successfully!";
} else {
    echo "Profile update failed.";
}

// Close the database connection
mysqli_close($conn);
?>

<?php
session_start(); // Start the session (if not already started)

$loginid = $_POST['uname'];
$pass = $_POST['psw'];
$host = 'localhost:3306';
$user = 'root';
$pass1 = '';
$db = 'testchallenge';

// Create a database connection
$conn = mysqli_connect($host, $user, $pass1, $db);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM register WHERE uname = ? AND psw = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters and execute the query
mysqli_stmt_bind_param($stmt, "ss", $loginid, $pass);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Check if there's a row with matching credentials
if ($result && mysqli_num_rows($result) > 0) {
    // Login successful; set a session variable
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $loginid;

    // Redirect to a protected page or display a success message
    header("Location: login.php"); // Replace "welcome.php" with the desired page
} else {
    // Invalid login; display an error message
    echo "Invalid login";
}

// Close the database connection
mysqli_close($conn);
?>


<?php
session_start();

$loginid = $_POST['uname'];
$pass = $_POST['psw'];
$host = 'localhost:3306';
$user = 'root';
$pass1 = '';
$db = 'testchallenge';

// Create a database connection
$conn = mysqli_connect($host, $user, $pass1, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM register WHERE uname = ? AND psw = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ss", $loginid, $pass); // Corrected binding

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    // Login successful; set a session variable
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $loginid; // Corrected variable
    
    // Redirect to the student details page
    header("Location: student_details.php");
} else {
    // Invalid login; display an error message
    echo "Invalid login";
}

// Close the database connection
mysqli_close($conn);
?>

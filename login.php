<!--
<?php
$loginid=$_POST['uname'];
$pass=$_POST['psw'];
$host='localhost:3306';
$user='root';
$pass1='';
$db='testchallenge';
$conn=mysqli_connect($host,$user,$pass1,$db);
$sql="SELECT * FROM register where uname='$loginid' and psw='$pass'";
$stmt = mysqli_prepare($conn, $sql);

echo $sql;

$result = mysqli_stmt_get_result($stmt);

echo $result;
if ($result && $row = mysqli_fetch_assoc($result)) {
    if ($pass== $row['psw']) {
        echo "Login successful";
    } else {
        echo "Invalid login";
    }
}  

?>
-->



<?php
session_start();

// Check if the form was submitted and 'uname' and 'psw' keys are set in $_POST
if (isset($_POST['uname']) && isset($_POST['psw'])) {
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

    mysqli_stmt_bind_param($stmt, "ss", $loginid, $pass);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful; set a session variable
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $loginid;

        // Redirect to the student details page
        header("Location: student_details.php");
    } else {
        // Invalid login; display an error message
        echo "Invalid login";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the main page if 'uname' or 'psw' is not set in $_POST
    header("Location: main_page.php");
}
?>

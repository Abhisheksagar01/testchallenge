<!DOCTYPE html>
<html>

<head>
    <title>Student Admin</title>
    <style>
        /* Your CSS styles here */

    </style>
</head>

<body>
    <header>
        <h1>Student Admin</h1>
    </header>

    <div class="container">
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

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM register WHERE uname = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            // Display student details
            echo "<h1>Welcome, {$row['uname']}</h1>";
            echo "<p>Username: {$row['uname']}</p>";
            // Display user ID and password
            echo "<p>User ID: {$row['user_id']}</p>";
            echo "<p>Password: {$row['password']}</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        <a class="logout" href="logout.php">Logout</a>
        <!-- Add more content here -->

        <h2>Update Profile</h2>
        <form action="update_profile.php" method="POST">
            <label for="new_user_id">New User ID:</label>
            <input type="text" name="new_user_id" required><br><br>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br><br>
            <!-- Add more fields for additional details here -->
            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5f0099;
            color: #fff;
            text-align: center;
            padding: 1px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }

        h1 {
            color: white;
        }

        p {
            font-size: 18px;
        }

        .logout {
            float: right;
            margin-left: 20px;
            margin-top: -40px;
            color: #0073e6;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <header>
        <h1>Student Details</h1>
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
            echo "<h2>Welcome, {$row['uname']}</h2>";
            echo "<p>Username: {$row['uname']}</p>";
            // Add more details here
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        <a class="logout" href="index.html">Logout</a>
        <!-- Add more content here -->
    </div>
</body>

</html>

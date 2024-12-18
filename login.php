<?php
// Establish database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "signup";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from login form
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // SQL injection prevention (optional)
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    // Query to check if username and password match
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    // Check if query returned any rows
    if ($result->num_rows > 0) {
        // Login successful
        echo "Login successful! Redirecting to index.html...";
        header("refresh:2;url=index.html"); // Redirect to index.html after 2 seconds
        exit();
    } else {
        // Login failed
        echo "Invalid username or password!";
    }
}

// Close database connection
$conn->close();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Enter your database password here
$dbname = "Hospitals";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get hospital email from database based on hospital name
$hospitalName = $_POST['hospitalName'];
$sql = "SELECT email FROM Hospital WHERE name='$hospitalName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hospital email found, send email
    $row = $result->fetch_assoc();
    $hospitalEmail = $row['email'];

    $subject = "Medical Emergency";
    $message = "Trying sending mail";

    // Send email
    $headers = "From: satkargarje2004@gmail.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($hospitalEmail, $subject, $message, $headers)) {
        echo "Email sent successfully";
    } else {
        echo "Failed to send email";
    }
} else {
    echo "Hospital email not found";
}

$conn->close();
?>

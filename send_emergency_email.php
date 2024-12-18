<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit;
}

// Database connection parameters for users
$user_servername = "localhost";
$user_username = "root";
$user_password = "";
$user_dbname = "signup";

// Create connection for users
$user_conn = new mysqli($user_servername, $user_username, $user_password, $user_dbname);

// Check connection for users
if ($user_conn->connect_error) {
    http_response_code(500);
    echo json_encode(['message' => 'User database connection failed: ' . $user_conn->connect_error]);
    exit;
}

// Fetch email address of logged-in user from the user database
$user_id = $_SESSION['id'];
$sql_user = "SELECT email FROM users WHERE id = ?";
$stmt_user = $user_conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$row_user = $result_user->fetch_assoc();

if (!$row_user) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch user email']);
    exit;
}

$user_email = $row_user['email'];

// Close user database connections
$stmt_user->close();
$user_conn->close();

// Database connection parameters for hospitals
$hospital_servername = "localhost";
$hospital_username = "root";
$hospital_password = "";
$hospital_dbname = "hospital";

// Create connection for hospitals
$hospital_conn = new mysqli($hospital_servername, $hospital_username, $hospital_password, $hospital_dbname);

// Check connection for hospitals
if ($hospital_conn->connect_error) {
    http_response_code(500);
    echo json_encode(['message' => 'Hospital database connection failed: ' . $hospital_conn->connect_error]);
    exit;
}

// Fetch hospital email based on user input
$hospital_id = $_POST['hid']; // Assuming you have a variable containing the hospital ID passed via POST
$sql_hospital = "SELECT email FROM hospitals WHERE id = ?";
$stmt_hospital = $hospital_conn->prepare($sql_hospital);
$stmt_hospital->bind_param("i", $hospital_id);
$stmt_hospital->execute();
$result_hospital = $stmt_hospital->get_result();
$row_hospital = $result_hospital->fetch_assoc();

if (!$row_hospital) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch hospital email']);
    exit;
}

$hospital_email = $row_hospital['email'];

// Close hospital database connections
$stmt_hospital->close();
$hospital_conn->close();

// Send emergency email
$to = $hospital_email;
$subject = 'Emergency Alert';
$message = 'Emergency! Please respond immediately.';
$headers = 'From: ' . $user_email; // Using the logged-in user's email address as the sender

if (mail($to, $subject, $message, $headers)) {
    http_response_code(200);
    echo json_encode(['message' => 'Emergency email sent successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to send emergency email.']);
}
?>

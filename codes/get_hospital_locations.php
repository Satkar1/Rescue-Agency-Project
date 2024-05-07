<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitals";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, latitude, longitude FROM hospital";
$result = $conn->query($sql);

$hospitalLocations = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $hospitalLocations[] = array(
            'name' => $row['name'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude']
        );
    }
}

echo json_encode($hospitalLocations);

$conn->close();
?>

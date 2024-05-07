<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Fire</title>
</head>
<body>
    <?php
    // Database connection parameters
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $database = "fire"; // Change this to your database name

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Get data from form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO firestations (name, address, latitude, longitude) VALUES (?, ?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->bind_param("ssdd", $name, $address, $latitude, $longitude);

    if ($statement->execute()) {
        echo "<p>Hospital added successfully.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $connection->error . "</p>";
    }

    // Close connection
    $statement->close();
    $connection->close();
    ?>
</body>
</html>

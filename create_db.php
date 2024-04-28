<?php
$servername = "localhost";
$username = "ktarafder1";
$password = "ktarafder1";
$dbname = "ktarafder1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    size INT NOT NULL,
    bedrooms INT NOT NULL,
    bathrooms INT NOT NULL,
    garden ENUM('yes', 'no') NOT NULL,
    parking INT NOT NULL,
    stories INT NOT NULL,
    basement ENUM('yes', 'no') NOT NULL,
    tax DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL
    );
    ";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<?php
$servername = "localhost";
$username = "ktarafder1";
$password = "ktarafder1";
$dbname = "ktarafder1";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response = array("success" => false, "message" => "Database connection failed.");
    echo json_encode($response);
    exit();
}

$sql = "CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  role varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  firstname varchar(255) DEFAULT NULL,
  lastname varchar(255) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
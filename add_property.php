<?php
$servername = "localhost";
$username = "ktarafder1";
$password = "ktarafder1";
$dbname = "ktarafder1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$price = $_POST['price'];
$size = $_POST['size'];
$bedrooms = $_POST['bedrooms'];
$bathrooms = $_POST['bathrooms'];
$garden = $_POST['garden'];
$parking = $_POST['parking'];
$stories = $_POST['stories'];
$basement = $_POST['basement'];
$tax = $_POST['tax'];

//Image upload to directory image
$uploadDir = 'images/';
$moveImage = $uploadDir . basename($_FILES['image']);
move_uploaded_file($file['temp_name'], $moveImage);

$sql = "INSERT INTO properties (address, city, state, zip, price, size, bedrooms, bathrooms, garden, parking, stories, basement, tax, image)
        VALUES ('$address', '$city', '$state', '$zip', '$price', '$size', '$bedrooms', '$bathrooms', '$garden', '$parking', '$stories', '$basement', '$tax', '$moveImage')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
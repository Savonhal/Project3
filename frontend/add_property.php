<?php


include '../backend/db_conn.php';

print_r($_COOKIE);
$id = $_COOKIE['user_id'];

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
$uploadDir = '../images/';
$moveImage = $uploadDir . basename($_FILES['image']['name']);
print_r($uploadDir . basename($_FILES['image']['name']));
move_uploaded_file($_FILES['image']['tmp_name'], $moveImage);


$sql = "INSERT INTO properties (userID, address, city, state, zip, price, size, bedrooms, bathrooms, garden, parking, stories, basement, tax, image)
        VALUES ('$id','$address', '$city', '$state', '$zip', '$price', '$size', '$bedrooms', '$bathrooms', '$garden', '$parking', '$stories', '$basement', '$tax', '$moveImage')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
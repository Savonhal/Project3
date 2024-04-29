<?php
include '../backend/db_conn.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $property_id = $_POST['property_id'];
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


    // Perform database update
    $sql = "UPDATE properties SET ";
    $params = array();
    if (!empty($address)) {
        $sql .= "address=?, ";
        $params[] = $address;
    }
    if (!empty($city)) {
        $sql .= "city=?, ";
        $params[] = $city;
    }
    if (!empty($state)) {
        $sql .= "state=?, ";
        $params[] = $state;
    }
    if (!empty($zip)) {
        $sql .= "zip=?, ";
        $params[] = $zip;
    }
    if (!empty($price)) {
        $sql .= "price=?, ";
        $params[] = $price;
    }
    if (!empty($size)) {
        $sql .= "size=?, ";
        $params[] = $size;
    }
    if (!empty($bedrooms)) {
        $sql .= "bedrooms=?, ";
        $params[] = $bedrooms;
    }
    if (!empty($bathrooms)) {
        $sql .= "bathrooms=?, ";
        $params[] = $bathrooms;
    }
    if (!empty($garden)) {
        $sql .= "garden=?, ";
        $params[] = $garden;
    }
    if (!empty($parking)) {
        $sql .= "parking=?, ";
        $params[] = $parking;
    }
    if (!empty($stories)) {
        $sql .= "stories=?, ";
        $params[] = $stories;
    }
    if (!empty($basement)) {
        $sql .= "basement=?, ";
        $params[] = $basement;
    }
    if (!empty($tax)) {
        $sql .= "tax=?, ";
        $params[] = $tax;
    }
    

    // Remove the last comma and space from SQL query
    $sql = rtrim($sql, ", ");

    // Add the WHERE clause
    $sql .= " WHERE id=?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $params[] = $property_id; // Add property_id to the params array
    $types = str_repeat('s', count($params)); // Determine types for params
    //$types .= "i"; // Add type for property_id (integer)
    $stmt->bind_param($types, ...$params); // Use array for params and remove unpacking

    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        header("Location: property_details.php?id=" . $property_id);
        exit();
    } else {
        // Update failed
        echo "Error updating property: " . $stmt->error;
    }
}
?>

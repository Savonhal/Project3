<?php
include '../backend/db_conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get property ID from form
    $id = $_POST['property_id'];
    
    // Prepare and execute SQL statement to delete property
    $sql = "DELETE FROM properties WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Deletion successful
        header("Location: seller.html"); // Redirect to properties list page
        exit();
    } else {
        // Deletion failed
        echo "Error deleting property: " . $stmt->error;
    }
}
?>

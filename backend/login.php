<?php
// Database connection parameters
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$servername = "localhost";
$username = "ktarafder1";
$password = "ktarafder1";
$dbname = "ktarafder1";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve email and password from POST request
$email = $_POST["email"];
$password = $_POST["password"];

// Prepare SQL statement to select user based on email
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // User exists, fetch the hashed password from the database
    $row = $result->fetch_assoc();
    $hashed_password = $row["password"];

    // Verify the password using password_verify()
    if (password_verify($password, $hashed_password)) {
        // Password is correct, authentication successful
        $user_id = $row["id"];
        $username = $row["username"];

        // Prepare response data
        $response = [
            "success" => true,
            "user_id" => $user_id,
            "username" => $username
        ];
    } else {
        // Password is incorrect, authentication failed
        $response = [
            "success" => false,
            "message" => "Invalid email or password"
        ];
    }
} else {
    // No rows returned, user does not exist
    $response = [
        "success" => false,
        "message" => "User does not exist"
    ];
}

// Close connection
$conn->close();

// Send response as JSON
header("Content-Type: application/json");
echo json_encode($response);
?>

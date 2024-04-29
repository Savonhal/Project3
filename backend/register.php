
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include 'db_conn.php';

// Check connection
if ($conn->connect_error) {
    $response = array("success" => false, "message" => "Database connection failed.");
    echo json_encode($response);
    exit();
}




header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST["email"];
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE email = ? OR username = ?');
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
   
        $response = array("success" => false, "message" => "Username or email already exists. Please choose a different one.");
    } else {
        $stmt = $conn->prepare('INSERT INTO users (email, username, firstname, lastname, role, password) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $email, $username, $first_name, $last_name, $role, $hashed_password);

        if ($stmt->execute()) {
   
            $response = array("success" => true, "message" => "User registered successfully!");
        } else {
        
            $response = array("success" => false, "message" => "Error registering user.");
        }
    }
    header('Content-Type: application/json');
    
    echo json_encode($response);
}
?>

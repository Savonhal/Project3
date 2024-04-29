<?php
    $servername = "localhost";
    $username = "ktarafder1";
    $password = "ktarafder1";
    $dbname = "ktarafder1";

        /*
    $servername = "127.0.0.1";
    $username = "root";
    $password = "1234";
    $dbname = "project3";
    */
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>
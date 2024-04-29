<?php
   

    include '../backend/db_conn.php';

    $userID = $_COOKIE['user_id'];
    
    // Fetch existing cards from database
    $sql = "SELECT * FROM properties WHERE userID in ($userID)";
    $result = $conn->query($sql);
   
    $html = '';
    // Display existing cards
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html .= 
            "
            <a href='property_details.php?id=" . $row['id'] . "'>
            <div class='property-card' 
                style='width: 350px; 
                height: 300px; 
                border: 1px solid black; 
                border-radius: 5px; 
                padding: 10px; 
                margin-bottom: 30px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)'
            >
                <img src=\"" . $row['image'] . "\" alt=\"Image\" style=\"max-width: 50%; object-fit: contain\">
                <div>
                    <h3> $" . $row['price'] . "</h3>
                    <div>" . $row['bedrooms'] . " bd | ". $row['bathrooms']. "ba | " . $row['size'] . " sqft </div>
                    <div>".$row['address']. ", " . $row['city'] . ", " . $row['state'] . ", " . $row['zip'] . "</div>
                </div>
            </div>
            </a>
            ";
        }
    } else {
        $html = "0 results";
    }
    echo $html;
    $conn->close();

?>
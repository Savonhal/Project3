<?php
  
    include '../backend/db_conn.php';

    $id = $_GET['id'];
            
    // Query to fetch the property details based on the id
    $sql = "SELECT * FROM properties WHERE id = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    $property = $result->fetch_assoc();
                
            
    function displayPropertyDetails() {
        global $conn;
        if(isset($_GET['id'])) {
            // Sanitize the input to prevent SQL injection
            $id = $_GET['id'];
            
            // Query to fetch the property details based on the id
            $sql = "SELECT * FROM properties WHERE id = ?";
            
            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);
            
            // Bind the parameter
            $stmt->bind_param("i", $id);
            
            // Execute the statement
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            // Check if the property exists
            if($result->num_rows > 0) {
                // Fetch the property details
                $property = $result->fetch_assoc();
                
                // Display the property details
                echo "
                    <div class='property-details' style='margin-left:220px;'>
                        <div>
                            <h1><div>".$property['address']. ", " . $property['city'] . ", " . $property['state'] . ", " . $property['zip'] . "</div></h1>
                            <h2>Property ID: " . $property['id'] . "</h2>
                            <h2>Price: $".$property['price']."</h2>
                            <br>
                            <h3><div>" . $property['bedrooms'] . " bedrooms | ". $property['bathrooms']. " bathrooms | " . $property['size'] . " sqft </div></h3>
                            <br>
                            <p>Garden: ".$property['garden']."</p>
                            <br>
                            <p>Parking (sqft): ".$property['parking']."</p>
                            <br>
                            <p>Stories: ".$property['stories']."</p>
                            <br>
                            <p>Basement: ".$property['basement']."</p>
                            <br>
                            <p>Property Tax: $".$property['tax']."</p>
                        </div>
                        <div style='margin-left: 50px'>
                            <img style='height: 300px; width: 300px' src='" . $property['image'] . "' alt='Property Image'>
                        </div>
                        
                    </div>
                    <!-- Edit and Delete buttons -->
                    <div class='property-details property-buttons' style='margin-left:220px;'>
                        <button id='edit-button' onclick='openPopup()'>Edit</button>
                        <button id='delete-button' onclick='openDeletePopup()'>Delete</button>
                    </div>
                ";
    
            } else {
                echo "Property not found.";
            }
        } else {
            echo "Property ID not provided.";
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="seller.css">
    <!-- google icon fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Property Details</title>
    <script src="seller.js"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <!-- potentially give user option to change and/or remove image -->
            <div class="profile-image">
                <img src="default.png" alt="default pfp image">

            </div>
            <ul>
                <li><a href="index.html" class="home">
                    <span class="icon"><img style="width: 25px;" src="icons/home.png" alt="Home Icon"></span>
                    <span class="item">Home</span>
                </a></li>
                <li><a href="seller.html">
                    <span class="icon"><img style="width: 25px;" src="icons/dashboard.png" alt="Dashboard Icon"></span>
                    <span class="item">Seller Dashboard</span>
                </a></li>
                <li><a href="contact.html">
                    <span class="icon"><img style="width: 25px;" src="icons/support.png" alt="Support Icon"></span>
                    <span class="item">Contact Support</span>
                </a></li>
            </ul>
        </div>
        <div class="topbar">
        <div class="nav">
                <div class="menu">
                    <a href="#" onclick="toggleMenu()"><img style="width: 30px;" src="icons/hamburger.png" alt="Menu Icon"></a>
                </div>
            </div>

        <div id="content">
            <?php displayPropertyDetails(); ?>
        </div>


    </div>

    <!-- Edit Property Popup -->
    <div id="addPropertyPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Edit Property</h2><br>
            <form id="addPropertyForm" method="post"  enctype="multipart/form-data" action="edit_property.php">
                <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                
                <label for="address">Street Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $property['address'] ?>"><br><br>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $property['city'] ?>">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" value="<?php echo $property['state'] ?>">
                <label for="zip">Zip Code:</label>
                <input type="text" id="zip" name="zip" value="<?php echo $property['zip'] ?>"><br><br>

                <label for="price">Property Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $property['price'] ?>"><br><br>

                <label for="size">Property Size in Square Feet:</label>
                <input type="text" id="size" name="size" value="<?php echo $property['size'] ?>"> sq ft.<br><br>

                <label for="bedrooms">Number of Bedrooms:</label>
                <input type="text" id="bedrooms" name="bedrooms" value="<?php echo $property['bedrooms'] ?>">
                <label for="bathrooms">Number of Bathrooms:</label>
                <input type="text" id="bathrooms" name="bathrooms" value="<?php echo $property['bathrooms'] ?>"><br><br>

                <label for="garden">Does the property have a garden?</label>
                <input type="radio" id="garden_yes" name="garden" value="yes" <?php if ($property['garden'] == 'yes') echo 'checked'; ?>>
                <label for="yes">Yes</label>
                <input type="radio" id="garden_no" name="garden" value="no" <?php if ($property['garden'] == 'no') echo 'checked'; ?>>
                <label for="no">No</label><br><br>

                <label for="parking">Property Parking Lot Size in Square Feet: (enter 0 if none)</label>
                <input type="text" id="parking" name="parking" value="<?php echo $property['parking'] ?>"> sq ft.<br><br>

                <label for="stories">How many stories does the property have?</label>
                <input type="text" id="stories" name="stories" value="<?php echo $property['stories'] ?>"><br><br>

                <label for="basement">Does the property have a basement?</label>
                <input type="radio" id="basement_yes" name="basement" value="yes" <?php if ($property['basement'] == 'yes') echo 'checked'; ?>>
                <label for="yes">Yes</label>
                <input type="radio" id="basement_no" name="basement" value="no" <?php if ($property['basement'] == 'no') echo 'checked'; ?>>
                <label for="no">No</label><br><br>

                <label for="tax">What is the property tax?</label>
                <input type="text" id="tax" name="tax" value="<?php echo $property['tax'] ?>"><br><br>

                <label for="image">Upload Image of Property:</label>
                <input type="file" id="image" name="image" value="<?php echo $property['image'] ?>"><br><br>

                <button style="background-color: #4CAF50;color:white" type="submit" id="submit" onclick="closePopup()">Update Property</button>
                
            </form>
        </div>
    </div>

    <!-- Delete property popup -->
    <div id="deletePropertyPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closeDeletePopup()">&times;</span>
            <h2>Delete Property</h2><br>
            <form id="delete-form" method="post"  enctype="multipart/form-data" action="delete_property.php">
                <p>Are you sure you want to delete this property?</p>
                <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                <br>
                <button id="delete-confirm" type="submit" id="submit" onclick="return confirm('Are you sure you want to delete this property?')">Delete Property</button>
            </form>
        </div>
    </div>

    <script>
        console.log("hello");
        function getCookie(name) {
            var cookieValue = null;
            if (document.cookie && document.cookie !== "") {
                var cookies = document.cookie.split(";");
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();
                    if (cookie.substring(0, name.length + 1) === (name + "=")) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }

        var userName = getCookie("username");
        console.log(userName);

        var profile_imageDiv = document.querySelector(".profile-image");
        profile_imageDiv.innerHTML += "<h3>" + userName + "</h3>";
    </script>
</body>
</html>
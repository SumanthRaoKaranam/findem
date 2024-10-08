<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Found Persons</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .logo {
    font-size: 80px;
    font-weight: bold;
    color: #007bff; /* Blue for the primary color */
}

/* Styling for individual letters */
.letter-orange {
    color: #ff6600; /* Orange for highlighting */
}

.letter-blue {
    color: #007bff; /* Blue color */
}
.content
{
  color: #ff6600;
  background-color: white;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  font-weight: bolder;
  font-style: italic;
}
    </style>
</head>
<body>
    
<div class="logo-container">
      <h1 class="logo" id="logo">Discover'Em</h1>
  </div>
    <h1>Discover Found Persons in Your City</h1>
    
    <form action="" method="GET">
        <label for="city">Select City:</label>
        <select name="city" id="city" required>
            <option value="">--Select a City--</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Bengaluru">Bengaluru</option>
            <option value="Chennai">Chennai</option>
            <option value="Kolkata">Kolkata</option>
        </select>
        <input type="submit" value="Search">
    </form>

    <div class="tablecontent"> 
        <?php
        // Only run this if the form has been submitted
        if (isset($_GET['city'])) {
            // Database connection
            $conn = new mysqli("localhost", "root", "", "findem");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $city = $conn->real_escape_string($_GET['city']); // Sanitize input to prevent SQL injection
            $sql = "SELECT name, location_found, datetime_found, description, photo FROM found WHERE location_found='$city'";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                echo "<table border='1' cellspacing='0' cellpadding='10'>";
                echo "<tr>
                        <th>Name</th>
                        <th>Location Found</th>
                        <th>Date & Time Found</th>
                        <th>Description</th>
                        <th>Photo</th>
                      </tr>";

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['location_found']}</td>
                            <td>{$row['datetime_found']}</td>
                            <td>{$row['description']}</td>
                            <td><img src='{$row['photo']}' alt='photo' width='100'></td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No found persons found in <strong>$city</strong>.</p>";
            }

            $conn->close(); // Close connection
        }
        ?>
    </div>
</body>
</html>

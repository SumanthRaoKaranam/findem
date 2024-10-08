<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "findem");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected city from the URL
$city = $_GET['city'];

// Query to fetch missing persons data for the selected city
$sql = "SELECT name, last_location, datetime, description, photo FROM missing WHERE last_location='$city'";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Start the table with headers
    echo "<table border='1' cellspacing='0' cellpadding='10'>";
    echo "<tr>
            <th>Name</th>
            <th>Last Known Location</th>
            <th>Date & Time</th>
            <th>Description</th>
            <th>Photo</th>
          </tr>";

    // Loop through the results and display each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['last_location'] . "</td>";
        echo "<td>" . $row['datetime'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><img src='" . $row['photo'] . "' alt='Missing Person Photo' width='100'></td>";
        echo "</tr>";
    }

    // Close the table
    echo "</table>";
} else {
    echo "No missing persons found in the selected city.";
}

// Close the connection
$conn->close();
?>

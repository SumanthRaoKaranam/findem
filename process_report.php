<?php
$conn = new mysqli("localhost", "root", "", "findem");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $datetime = $_POST['datetime'];
    $description = $_POST['description'];
    
    // Handle photo upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);
    
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO missing (name, last_location, datetime, description, photo) VALUES ('$name', '$location', '$datetime', '$description', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "Report submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>

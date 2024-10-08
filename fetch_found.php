<?php
$city = $_GET['city'];
$conn = new mysqli("localhost", "root", "", "findem");
$sql = "SELECT name, location_found, datetime_found, description, contact FROM found WHERE location_found='$city'";
$result = $conn->query($sql);
$found_persons = array();

while ($row = $result->fetch_assoc()) {
    array_push($found_persons, $row);
}

echo json_encode($found_persons);
?>

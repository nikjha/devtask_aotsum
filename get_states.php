<?php
require_once('db_connection.php'); 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch states for the United States
$sql = "SELECT * FROM state WHERE country_id = (SELECT country_id FROM country WHERE country_name = 'United States')";
$result = $conn->query($sql);

$states = array();
while ($row = $result->fetch_assoc()) {
    $states[] = $row;
}

// Return states as JSON
echo json_encode($states);

$conn->close();
?>

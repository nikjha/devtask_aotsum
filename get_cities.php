<?php
require_once('db_connection.php'); 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get state ID from the query parameter
$stateId = $_GET['state_id'];

// Fetch cities based on the selected state
$sql = "SELECT * FROM city WHERE state_id = $stateId";
$result = $conn->query($sql);

$cities = array();
while ($row = $result->fetch_assoc()) {
    $cities[] = $row;
}

// Return cities as JSON
echo json_encode($cities);

$conn->close();
?>

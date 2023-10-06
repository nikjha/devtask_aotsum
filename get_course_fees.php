<?php
require_once('db_connection.php'); 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get course ID from the query parameter
$courseId = $_GET['course_id'];

// Fetch course fees based on the selected course ID
$sql = "SELECT * FROM course_fee WHERE course_id = $courseId";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

$fees = array();
while ($row = $result->fetch_assoc()) {
    $fees[] = $row;
}

// Return course fees as JSON
echo json_encode($fees);

$conn->close();
?>

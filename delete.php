<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Delete the student record from the database
    $query = "DELETE FROM student WHERE uniq_id='$studentId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Deletion successful, redirect back to display.php
        header('Location: display.php');
    } else {
        // Deletion failed, handle the error as needed
        echo "Deletion failed: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // Invalid request, redirect to display.php or handle the error as needed
    header('Location: display.php');
}
?>

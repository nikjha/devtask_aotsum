<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['student_id'];
    $name = $_POST['editName'];
    $mobile = $_POST['editMobile'];
    $email = $_POST['editEmail'];

    // Update the student record in the database
    $query = "UPDATE student SET stu_name='$name', stu_mobile='$mobile', stu_email='$email' WHERE uniq_id='$studentId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful, redirect back to display.php
        header('Location: display.php');
    } else {
        // Update failed, handle the error as needed
        echo "Update failed: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

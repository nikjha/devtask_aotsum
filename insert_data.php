<?php
require_once('db_connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $fatherName = mysqli_real_escape_string($connection, $_POST['father_name']);
    $motherName = mysqli_real_escape_string($connection, $_POST['mother_name']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $stateId = mysqli_real_escape_string($connection, $_POST['state']);
    $cityId = mysqli_real_escape_string($connection, $_POST['city']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $courseId = mysqli_real_escape_string($connection, $_POST['course']);
    $tenthPercentage = mysqli_real_escape_string($connection, $_POST['tenth_per']);
    $twelfthPercentage = mysqli_real_escape_string($connection, $_POST['twelveth_per']);

    // Calculate age based on date of birth
    $dobDate = new DateTime($dob);
    $today = new DateTime('now');
    $age = $dobDate->diff($today)->y;

    // Insert data into the student table
    $query = "INSERT INTO student (stu_name, stu_mobile, stu_email, stu_father_name, stu_mother_name, stu_address, 
                stu_gender, state_id, city_id, date_of_birth, stu_age, course_id, stu_tenth_per, stu_twelfth_per) 
              VALUES ('$name', '$mobile', '$email', '$fatherName', '$motherName', '$address', '$gender', 
                '$stateId', '$cityId', '$dob', '$age', '$courseId', '$tenthPercentage', '$twelfthPercentage')";

    // Execute the query (you should use prepared statements to prevent SQL injection)
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Data inserted successfully!";
        header("Location: display.php");
        exit();
        // You can redirect the user to a thank you page or display a success message as needed
    } else {
        echo "Error: " . mysqli_error($connection);
        // Handle the error, display an error message, or redirect the user to an error page
    }
}

mysqli_close($connection); // Close the database connection
?>

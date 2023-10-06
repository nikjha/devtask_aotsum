<?php
require_once('db_connection.php'); // Include your database connection code here

// Fetch student data from the student table
$query = "SELECT * FROM student";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Student Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['stu_name'] . "</td>";
                        echo "<td>" . $row['stu_mobile'] . "</td>";
                        echo "<td>" . $row['stu_email'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$row['uniq_id']}'>Delete</button> ";
                        echo "<button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal{$row['uniq_id']}'>Edit</button>";
                        echo "</td>";
                        echo "</tr>";

                        // Delete Modal
                        echo "<div class='modal fade' id='deleteModal{$row['uniq_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='deleteModalLabel'>Delete Student</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            Are you sure you want to delete this student?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            <a href='delete.php?id={$row['uniq_id']}' class='btn btn-danger'>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        // Edit Modal
                        echo "<div class='modal fade' id='editModal{$row['uniq_id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='editModalLabel'>Edit Student</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form action='edit.php' method='POST'>
                    <input type='hidden' name='student_id' value='{$row['uniq_id']}'>
                    <div class='form-group'>
                        <label for='editName'>Name:</label>
                        <input type='text' class='form-control' value='{$row['stu_name']}' id='editName' name='editName' required>
                    </div>
                    <div class='form-group'>
                        <label for='editMobile'>Mobile:</label>
                        <input type='tel' class='form-control' value='{$row['stu_mobile']}' id='editMobile' name='editMobile' required>
                    </div>
                    <div class='form-group'>
                        <label for='editEmail'>Email:</label>
                        <input type='email' class='form-control' value='{$row['stu_email']}' id='editEmail' name='editEmail' required>
                    </div>
                    <!-- Add more fields from the student table as needed -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
mysqli_close($conn); // Close the database connection
?>

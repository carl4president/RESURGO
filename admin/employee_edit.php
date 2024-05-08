<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    
   $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $schedule = $_POST['schedule'];

    echo "Received ID: $id<br>";

    $sql = "UPDATE employees SET
            firstname = ?,
            middlename = ?,
            lastname = ?,
            address = ?,
            birthdate = ?,
            contact_info = ?,
            email = ?,
            gender = ?,
            position_id = ?,
            schedule_id = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssiii", $firstname, $middlename, $lastname, $address, $birthdate, $contact, $email, $gender, $position, $schedule, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Employee information updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating employee information: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header('location: employee.php');
} else {
    $_SESSION['error'] = 'Invalid request';
    header('location: employee.php'); 

}
?>

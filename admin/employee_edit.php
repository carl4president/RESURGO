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
            firstname = '$firstname',
            middlename = '$middlename',
            lastname = '$lastname',
            address = '$address',
            birthdate = '$birthdate',
            contact_info = '$contact',
            email = '$email',
            gender = '$gender',
            position_id = '$position',
            schedule_id = '$schedule'
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = 'Employee information updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating employee information: ' . $conn->error;
    }

    header('location: employee.php'); 
} else {
    $_SESSION['error'] = 'Invalid request';
    header('location: employee.php'); 

}
?>

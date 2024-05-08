<?php
include 'includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state_province = $_POST['state_province'];
    $postal_zip_code = $_POST['postal_zip_code'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];

    
    $sql = "UPDATE application SET
    firstname = ?,
    middlename = ?,
    lastname = ?,
    street_address = ?,
    city = ?,
    state_province = ?,
    postal_zip_code = ?,
    birthdate = ?,
    email = ?,
    contact_info = ?,
    gender = ?,
    position_id = ?
    WHERE id = ?";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssii", $firstname, $middlename, $lastname, $street_address, $city, $state_province, $postal_zip_code, $birthdate, $email, $contact, $gender, $position, $id);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Application updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating application: ' . $stmt->error;
    }

    
    $stmt->close();
} else {
    $_SESSION['error'] = 'Fill up the edit form first';
}


header('Location: recruitment.php');
exit();
?>

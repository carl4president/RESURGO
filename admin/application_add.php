<?php

include 'includes/conn.php';

session_start();

if (isset($_POST['add'])) {
    
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['contact']) ? $_POST['contact'] : ''; 
    $resume = $_FILES['resume']['name'];

    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit(); 
    }


    $checkQuery = "SELECT * FROM application WHERE firstname = ? and middlename = ? and lastname = ? and email = ? and contact_info = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("sssss", $firstname, $middlename, $lastname, $email, $phone); 
    $checkStmt->execute();
    $existingApplicant = $checkStmt->fetch();
    $checkStmt->close();

    if ($existingApplicant) {
        $_SESSION['error'] = 'Application already submitted.';
        header('Location: recruitment.php');
        exit(); 
    } else {
        $resume = $_FILES['resume']['name'];
        $position_id = isset($_POST['position']) ? $_POST['position'] : null;

        if (!empty($resume)) {
            move_uploaded_file($_FILES['resume']['tmp_name'], '../resume/' . $resume);
        }

        $first_name = isset($_POST['firstname']) ? $_POST['firstname'] : null;
        $middle_name = isset($_POST['middlename']) ? $_POST['middlename'] : null;
        $last_name = isset($_POST['lastname']) ? $_POST['lastname'] : null;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $street_address = isset($_POST['street_address']) ? $_POST['street_address'] : null;
        $city = isset($_POST['city']) ? $_POST['city'] : null;
        $state_province = isset($_POST['state_province']) ? $_POST['state_province'] : null;
        $postal_zip_code = isset($_POST['postal_zip_code']) ? $_POST['postal_zip_code'] : null;
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $phone = isset($_POST['contact']) ? $_POST['contact'] : null;

        $applicant_id = generateRandomApplicantID();

        $query = "INSERT INTO application (applicant_id, firstname, middlename, lastname, gender, street_address, city, state_province, postal_zip_code, birthdate, email, contact_info, position_id, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssssss", $applicant_id, $first_name, $middle_name, $last_name, $gender, $street_address, $city, $state_province, $postal_zip_code, $birthdate, $email, $phone, $position_id, $resume);
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['success'] = 'Application submitted successfully';
            header('Location: recruitment.php');
            exit(); 
        } else {
            echo 'Error executing the statement: ' . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo 'Could not prepare statement!';
}

$conn->close();

function generateRandomApplicantID($length = 7)
{
    $prefix = rand(10, 99); 
    $suffixLength = $length - 3; 
    $characters = '0123456789';
    $suffix = '';

    for ($i = 0; $i < $suffixLength; $i++) {
        $suffix .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $prefix . '-' . $suffix;
}
?>

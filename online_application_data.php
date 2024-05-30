<?php
session_start();

include 'attendance/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : null;

    if (!empty($resume)) {
        move_uploaded_file($_FILES['resume']['tmp_name'], 'resume/' . $resume);
    }

    $firstname = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $middlename = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $lastname = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $resume = $_FILES['resume']['name'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output['error'] = true;
        $output['message'] = 'Invalid email format';
    }

    $applicant_id = generateRandomApplicantID();

    $checkQuery = "SELECT * FROM application WHERE firstname = ? and middlename = ? and lastname = ? and email = ? and contact_info = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("sssss", $firstname, $middlename, $lastname, $email, $phone); 
    $checkStmt->execute();
    $existingApplicant = $checkStmt->fetch();
    $checkStmt->close();

    if ($existingApplicant) {
        
        $output['error'] = true;
        $output['message'] = 'Application already submitted.';
        
    } else {
        $resume = $_FILES['resume']['name'];
        $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : null;
    
        if (!empty($resume)) {
            move_uploaded_file($_FILES['resume']['tmp_name'], 'resume/' . $resume);
        }
    
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
        $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $street_address = isset($_POST['street']) ? $_POST['street'] : null;
        $city = isset($_POST['city']) ? $_POST['city'] : null;
        $state_province = isset($_POST['state_province']) ? $_POST['state_province'] : null;
        $postal_zip_code = isset($_POST['postal_zip_code']) ? $_POST['postal_zip_code'] : null;
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    
        $applicant_id = generateRandomApplicantID();

        $query = "INSERT INTO application (applicant_id, firstname, middlename, lastname, gender, street_address, city, state_province, postal_zip_code, birthdate, email, contact_info, position_id, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssssss", $applicant_id, $first_name, $middle_name, $last_name, $gender, $street_address, $city, $state_province, $postal_zip_code, $birthdate, $email, $phone, $position_id, $resume);
        $result = $stmt->execute();

        if ($result) {
            $output['error'] = false;
            $output['message'] = 'Application submitted successfully.';
        } else {
            echo 'Error executing the statement: ' . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo 'Could not prepare statement!';
}

$conn->close();

echo json_encode($output);

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

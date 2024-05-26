<?php
include 'includes/session.php';
include 'phpqrcode/qrlib.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['add'])) {
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : null;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    
    if (!empty($_POST['position_id'])) {
    $parts = explode('|', $_POST['position_id']);
    if (count($parts) === 2) {
        list($position_id, $position_name) = $parts;
        }
    }

    $schedule = isset($_POST['schedule']) ? $_POST['schedule'] : null;
    $hireDate = date('Y-m-d');
    
    $status = 0;
    
     $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header('Location: employee.php');
        exit(); 
    }

    
    $username = generateRandomUsername(); 
    $password = generateRandomPassword(); 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $employee_id = generateRandomEmployeeID();
    
    $qrContent = "$employee_id";
    $qrFileName = "temp/$employee_id.png"; 
    QRcode::png($qrContent, $qrFileName);

        
    $mail = new PHPMailer(true);

    $recipientEmail = $email;

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'olshco77@gmail.com'; 
        $mail->Password = 'tlva ooir whuf sftc'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('olshco77@gmail.com'); 
        $mail->addAddress($recipientEmail); 

        $mail->isHTML(true);

        $mail->Subject = 'Login Credentials';

       $message = "<p>Dear $firstname $middlename $lastname,</p>";
        $message .= "<p>Congratulations! You have successfully applied for the position of $position_name at our school. We are pleased to inform you that your application has been accepted.</p>";
        $message .= "<p>Here are your login credentials:</p><ul>";
        $message .= "<li><strong>Username:</strong> $username</li>";
        $message .= "<li><strong>Password:</strong> $password</li></ul>";
        $message .= "<p>Click <a href='https://resurgo.xyz/employee_portal/index.php'>here</a> to log in.</p>";
        $message .= "<p>Your QR Code for attendance:</p><img src='cid:qrCodeImg' alt='QR Code'>";
        $message .= "<p>Thank you for choosing our school. We look forward to a successful collaboration.</p>";
        $message .= "<p>Best regards,<br>OLSHCO</p>";

        $mail->Body = $message;
        
        $mail->AddEmbeddedImage($qrFileName, 'qrCodeImg', 'qr_code.png');

        $mail->send();
        
        $updateVacancyQuery = "UPDATE vacancy SET availability = availability - 1 WHERE id = ?";
        $stmt = $conn->prepare($updateVacancyQuery);
        $stmt->bind_param("s", $position_id);

        if ($stmt->execute()) {
            $_SESSION['success'] .= ' Vacancy availability updated successfully';
            $stmt->close();
        } else {
            echo 'Error updating vacancy: ' . $stmt->error;
        }


        $query = "INSERT INTO employees (employee_id, firstname, middlename, lastname, address, birthdate, contact_info, email, gender, position_id, schedule_id, hire_date, username, password, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssssssssssssss", $employee_id, $firstname, $middlename, $lastname, $address, $birthdate, $contact, $email, $gender, $position_id, $schedule, $hireDate, $username, $hashedPassword, $status);


        if ($stmt->execute()) {
            $_SESSION['success'] = 'Employee information added successfully'; 
            $stmt->close();
        } else {
            echo 'Error executing statement: ' . $stmt->error;
        }

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $conn->close();
}

function generateRandomUsername($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $username = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $username .= $characters[rand(0, $max)];
    }

    return $username;
}


function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
    $password = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $max)];
    }

    return $password;
}

function generateRandomEmployeeID($length = 8) {
    $prefix = rand(10, 99); 
    $suffixLength = $length - 3; 
    $characters = '0123456789';
    $suffix = '';

    for ($i = 0; $i < $suffixLength; $i++) {
        $suffix .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $prefix . '-' . $suffix;
}

header('location: employee.php');
?>

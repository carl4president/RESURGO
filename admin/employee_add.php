<?php
include 'includes/session.php';

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
    $position = isset($_POST['position']) ? $_POST['position'] : null;
    $schedule = isset($_POST['schedule']) ? $_POST['schedule'] : null;
    $filename = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : null;
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
    }
    $hireDate = date('Y-m-d');

    
    $username = generateRandomUsername(); 
    $password = generateRandomPassword(); 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
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

        $message .= '';
        $message .= '<p>Dear ' . $firstname . ' ' . $middlename . ' ' . $lastname . ',</p>';
        
        $message .= '<p>Here are your login credentials:</p>';
        $message .= '<ul>';
        $message .= '<li><strong>Username:</strong> ' . $username . '</li>';
        $message .= '<li><strong>Password:</strong> ' . $password . '</li>';
        $message .= '</ul>';
        
        $message .= '<p>You can now log in to our employee portal and access your profile and relevant information.</p>';
        
        $message .= '<p>Click <a href="http://192.168.16.179:8080/OLSHCOHRMS/EmployeePortal/index.php">here</a> to log in.</p>';
        
        $message .= '<p>Thank you for choosing our school. We extend a warm welcome to you, and we look forward to a successful and fulfilling collaboration.</p>';
        $message .= '<p>Best regards,</p>';
        $message .= '<p>OLSHCO</p>';

        $mail->Body = $message;

        $mail->send();

        $employee_id = generateRandomEmployeeID();

        $query = "INSERT INTO employees (employee_id, firstname, middlename, lastname, address, birthdate, contact_info, email, gender, position_id, schedule_id, photo, hire_date, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssssssssssssss", $employee_id, $firstname, $middlename, $lastname, $address, $birthdate, $contact, $email, $gender, $position, $schedule, $filename, $hireDate, $username, $hashedPassword);


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

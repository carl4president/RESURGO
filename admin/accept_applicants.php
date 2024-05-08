<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['accept'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $applicant_id = isset($_POST['applicant_id']) ? $_POST['applicant_id'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : null;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $position = isset($_POST['position']) ? $_POST['position'] : null;
    $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : null;
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

        $mail->Subject = 'Application Accepted';

        $message .= '';
        $message .= '<p>Dear ' . $firstname . ' ' . $middlename . ' ' . $lastname . ',</p>';
        $message .= '<p>Congratulations! You have successfully applied for the position of ' . $position . ' at our school. We are pleased to inform you that your application has been accepted, and we are excited to welcome you to OLSHCO.</p>';
        
        $message .= '<p>Here are your login credentials:</p>';
        $message .= '<ul>';
        $message .= '<li><strong>Username:</strong> ' . $username . '</li>';
        $message .= '<li><strong>Password:</strong> ' . $password . '</li>';
        $message .= '</ul>';
        
        $message .= '<p>You can now log in to our employee portal and access your profile and relevant information. Your dedication to ' . $position . ' will undoubtedly contribute to the success of our school, and we look forward to the valuable contributions you will bring to our team.</p>';
        
        $message .= '<p>Click <a href="https://resurgo.xyz/employee_portal/index.php">here</a> to log in.</p>';
        
        $message .= '<p>Thank you for choosing our school. We extend a warm welcome to you, and we look forward to a successful and fulfilling collaboration.</p>';
        $message .= '<p>Best regards,</p>';
        $message .= '<p>OLSHCO</p>';

        $mail->Body = $message;

        $mail->send();
        echo 'Acceptance Email has been sent successfully!';

        $employee_id = generateRandomEmployeeID();

        $updateVacancySql = "UPDATE vacancy SET availability = availability - 1 WHERE id = ?";
        $stmtUpdateVacancy = $conn->prepare($updateVacancySql);
        $stmtUpdateVacancy->bind_param("i", $position_id);
        $stmtUpdateVacancy->execute();
        $stmtUpdateVacancy->close();
        
        $query = "INSERT INTO employees (employee_id, firstname, middlename, lastname, address, birthdate, email, contact_info, gender, position_id, hire_date, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssssss", $employee_id, $firstname, $middlename, $lastname, $address, $birthdate, $email, $contact, $gender, $position_id, $hireDate, $username, $hashedPassword);

        if ($stmt) {
            if ($stmt->execute()) {

                $deleteInterviewSql = "DELETE FROM interview_details WHERE applicant_id = ?";
                $stmtDeleteInterview = $conn->prepare($deleteInterviewSql);
                $stmtDeleteInterview->bind_param("s", $applicant_id);
                $stmtDeleteInterview->execute();
        
                
                if ($stmtDeleteInterview) {
                    $deleteQuery = "DELETE FROM application WHERE id = ?";
                    $deleteStmt = $conn->prepare($deleteQuery);
                    $deleteStmt->bind_param("i", $id);
                    $deleteResult = $deleteStmt->execute();
    
                    $_SESSION['success'] = 'Application Accepted Email Send Successfully';
                } else {
                    echo 'Error deleting applicant record: ' . $deleteStmt->error;
                }
            } else {
                echo 'Error executing the statement: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Error preparing statement: ' . $conn->error;
        }


    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }

    $conn->close();
    header('location:recruitment.php');
}

if (isset($_POST['receive'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $applicantName = $firstname . ' ' . $middlename . ' ' . $lastname;
    $position = isset($_POST['position']) ? $_POST['position'] : null;

    $process_id = 1;

    
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

        $mail->Subject = 'Application Received';
        $mail->Body = '<p>Dear ' . $applicantName . ',</p>';
        $mail->Body .= '<p>Thank you for submitting your application for the position of ' . $position . '.</p>';
        $mail->Body .= '<p>We have received your application, and our team will review it shortly.</p>';
        $mail->Body .= '<p>Best regards,<br>OLSHCO</p>';

        $mail->send();

        $updateQuery = "UPDATE application SET process_id = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("is", $process_id, $id);
        $stmt->execute();
        $stmt->close();
        
        $_SESSION['success'] = 'Application Received Email Send Successfully';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
    header('location:recruitment.php');
}

if (isset($_POST['process'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $applicantName = $firstname . ' ' . $middlename . ' ' . $lastname;
    $position = isset($_POST['position']) ? $_POST['position'] : null;

    $process_id = 2;

    
    echo 'Recipient Email: ' . $email;
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

        if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid recipient email address: ' . $recipientEmail);
        }


        $mail->addAddress($recipientEmail); 

        $mail->isHTML(true);

        $mail->Subject = 'Application Processing';
        $mail->Body = '<p>Dear ' . $applicantName . ',</p>';
        $mail->Body .= '<p>Your application for the position of ' . $position . ' is currently being processed.</p>';
        $mail->Body .= '<p>We appreciate your patience, and our team will reach out to you with further updates.</p>';
        $mail->Body .= '<p>Best regards,<br>OLSHCO</p>';

        $mail->send();

        $updateQuery = "UPDATE application SET process_id = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("is", $process_id, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = 'Application Processing Email Sent Successfully';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $e->getMessage();
    }
    header('location:recruitment.php');
}

if (isset($_POST['interview'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $applicantid = isset($_POST['applicantid']) ? $_POST['applicantid'] : null;
    $applicantname = isset($_POST['applicantname']) ? $_POST['applicantname'] : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $position = isset($_POST['position']) ? $_POST['position'] : null;

    $interviewDate = isset($_POST['interview_date']) ? $_POST['interview_date'] : '';
    $interviewTime = isset($_POST['interview_time']) ? $_POST['interview_time'] : '';
    $interviewLocation = isset($_POST['interview_location']) ? $_POST['interview_location'] : '';


    $process_id = 3;
     
    
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

        $mail->Subject = 'Interview Invitation';
        $mail->Body = '<p>Dear ' . $applicantname . ',</p>';
        $mail->Body .= '<p>Congratulations! Your application for the position of ' . $position . ' has been shortlisted for an interview.</p>';
        $mail->Body .= '<p>Interview details:</p>';
        $mail->Body .= '<p>Date: ' . $interviewDate . '</p>';
        $mail->Body .= '<p>Time: ' . $interviewTime . '</p>';
        $mail->Body .= '<p>Location: ' . $interviewLocation . '</p>';
        $mail->Body .= '<p>Please be prepared, and feel free to contact Carl John Yasay through Facebook for any further details.</p>';
        $mail->Body .= '<p>Best regards,<br>OLSHCO</p>';

        $mail->send();

        $query = "INSERT INTO interview_details (application_id, applicant_id, email, position, date, time, location) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInterview = $conn->prepare($query);  
        $stmtInterview->bind_param("sssssss", $id, $applicantid, $email, $position, $interviewDate, $interviewTime, $interviewLocation);
        $stmtInterview->execute();
        $stmtInterview->close();
        

        $updateQuery = "UPDATE application SET process_id = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($updateQuery);  
        $stmtUpdate->bind_param("is", $process_id, $id);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    

        $_SESSION['success'] = 'Interview Invitation Email Sent Successfully';

    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $e->getMessage();
    }
    header('location:recruitment.php');
}

if (isset($_POST['reject'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $applicantName = $firstname . ' ' . $middlename . ' ' . $lastname;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $position = isset($_POST['position']) ? $_POST['position'] : null;

    
    $mail = new PHPMailer(true);

    $recipientEmail = $email;

    
    
    $deleteQuery = "DELETE FROM application WHERE id = ?";
    $deleteStatement = $conn->prepare($deleteQuery);

    
    if ($deleteStatement) {
        $deleteStatement->bind_param('i', $id);
        $deleteStatement->execute();

        
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

            $mail->Subject = 'Application Rejected';
            $mail->Body = '<p>Dear ' . $applicantName . ',</p>';
            $mail->Body .= '<p>We regret to inform you that your application for the position of ' . $position . ' has been differed.</p>';
            $mail->Body .= '<p>Best regards,<br>OLSHCO</p>';

            $mail->send();
            $_SESSION['success'] = 'Rejection Email Sent Successfully';
            echo 'Rejection Email Sent Successfully';
        } catch (Exception $e) {
            echo 'Rejection email could not be sent. Mailer Error: ' . $e->getMessage();
        }
    } else {
        echo 'Error preparing delete statement: ' . $conn->error;
    }
    header('location:recruitment.php');
}

if (isset($_POST['send_email'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : null;
    $message = isset($_POST['message']) ? trim($_POST['message']) : null;

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

            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            $_SESSION['success'] = 'Email Sent Successfully';

        } catch (Exception $e) {
            echo 'Rejection email could not be sent. Mailer Error: ' . $e->getMessage();
        }
    header('location:recruitment.php');
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

?>

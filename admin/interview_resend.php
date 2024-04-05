<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST['interview'])) {
    $application_id = isset($_POST['id']) ? $_POST['id'] : null;
    $applicantname = isset($_POST['applicantname']) ? $_POST['applicantname'] : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $position = isset($_POST['position']) ? $_POST['position'] : null;

    $interviewDate = isset($_POST['interview_date']) ? $_POST['interview_date'] : '';
    $interviewTime = isset($_POST['interview_time']) ? $_POST['interview_time'] : '';
    $interviewLocation = isset($_POST['interview_location']) ? $_POST['interview_location'] : '';
     
    
    $mail = new PHPMailer(true);

    $recipientEmail = $email;
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'carl09450059036@gmail.com'; 
        $mail->Password = 'umrq zbry grsz iyfg'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('carl09450059036@gmail.com'); 
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

        $query = "UPDATE interview_details SET date = ?, time = ?, location = ? WHERE application_id = ?";
        $stmtInterview = $conn->prepare($query);  
        $stmtInterview->bind_param("ssss", $interviewDate, $interviewTime, $interviewLocation, $application_id);
        $stmtInterview->execute();
        $stmtInterview->close();
    

        $_SESSION['success'] = 'Interview Invitation Email Sent Successfully';

    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $e->getMessage();
    }
    header('location:interview.php');
}
?>
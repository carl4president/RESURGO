<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $position_id = $_POST['position_id'];
    $position = $_POST['position'];
    $status = 1;

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

        $mail->Subject = 'Application Archived';

        $message = '<p>Dear ' . $firstname . ' ' . $middlename . ' ' . $lastname . ',</p>';
        $message .= '<p>We regret to inform you that your application for the position of ' . $position . ' at our school has been archived. After careful consideration, we have determined that there is currently no need to recruit for this position.</p>';
        
        $message .= '<p>We appreciate the time and effort you invested in your application, and we encourage you to explore other opportunities that may align with your skills and qualifications.</p>';
        
        $message .= '<p>If you have any questions or would like further clarification, feel free to reach out to our HR department at 09979236679.</p>';
        
        $message .= '<p>Thank you for your understanding, and we wish you the best in your future endeavors.</p>';
        $message .= '<p>Best regards,</p>';
        $message .= '<p>OLSHCO</p>';

        $mail->Body = $message;

        $mail->send();

        $updateQuery = "UPDATE application SET status = ? WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $updateQuery);
        
        mysqli_stmt_bind_param($stmt, "is", $status, $id);
        
        $updateResult = mysqli_stmt_execute($stmt);
        $_SESSION['success'] = 'Applicant application record archived successfully!';

} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

    
    mysqli_close($conn);
    header('location: recruitment.php');
}else if (isset($_POST['retrieve'])) {
    
    $id = $_POST['id'];
    $status = 0;

        $updateQuery = "UPDATE application SET status = ? WHERE id = ?";

        $stmt = mysqli_prepare($conn, $updateQuery);
        
        mysqli_stmt_bind_param($stmt, "is", $status, $id);
        
        $updateResult = mysqli_stmt_execute($stmt);
        
        $_SESSION['success'] = 'Applicant application record retrieved successfully!';
    
    mysqli_close($conn);
    header('location: recruitment_archive.php');
}
?>
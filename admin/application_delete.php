<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['delete'])) {
    $record_id = $_POST['id'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];


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

        $mail->Subject = 'Application Deleted';

        $message = '<p>Dear ' . $firstname . ' ' . $middlename . ' ' . $lastname . ',</p>';
        $message .= '<p>We regret to inform you that your application for the position of ' . $position . ' at our school has been deleted. After careful consideration, we have determined that there is currently no need to recruit for this position.</p>';
        
        $message .= '<p>We appreciate the time and effort you invested in your application, and we encourage you to explore other opportunities that may align with your skills and qualifications.</p>';
        
        $message .= '<p>If you have any questions or would like further clarification, feel free to reach out to our HR department at 09979236679.</p>';
        
        $message .= '<p>Thank you for your understanding, and we wish you the best in your future endeavors.</p>';
        $message .= '<p>Best regards,</p>';
        $message .= '<p>OLSHCO</p>';

        $mail->Body = $message;

        $mail->send();
        $_SESSION['success'] = 'Application Deleted email has been sent successfully!';


        $delete_sql = "DELETE FROM application WHERE id = '$record_id'";

        if ($conn->query($delete_sql)) {
            
            echo "Record deleted successfully.";
        } else {
            
            echo "Error deleting record: " . $conn->error;
        }

} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} 
    $conn->close();
} else {
    
    echo "Invalid request.";
}
header("location: recruitment.php")
?>

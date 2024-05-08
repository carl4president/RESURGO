<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    $applicant_id = $_POST['applicant_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $position_id = $_POST['position_id'];
    $position = $_POST['position'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state_province = $_POST['state_province'];
    $postal_zip_code = $_POST['postal_zip_code'];
    $birthdate = $_POST['birthdate'];
    $resume = $_POST['resume'];

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
        $_SESSION['success'] = 'Application Deleted email has been sent successfully!';

        $insertQuery = "INSERT INTO application_archive 
                        (id, applicant_id, firstname, middlename, lastname, email, gender, contact_info, position_id, street_address, city, state_province, postal_zip_code, birthdate, resume)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $insertQuery);
        
        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $id, $applicant_id, $firstname, $middlename, $lastname, $email, $gender, $phone, $position_id, $street_address, $city, $state_province, $postal_zip_code, $birthdate, $resume);
        
        $insertResult = mysqli_stmt_execute($stmt);
        
        if ($insertResult) {
         $_SESSION['success'] = 'Applicant Application Record archived successfully!';
        
        $stmt = $conn->prepare("DELETE FROM application WHERE id = ?");
        $stmt->bind_param("i", $id);
        $deleteResult = $stmt->execute();
        
        if ($deleteResult) {
            echo " Record deleted from applications table.";
        } else {
            echo "Error deleting record from applications table: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving record: " . mysqli_error($conn);
    }

} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

    
    mysqli_close($conn);
    header('location: recruitment.php');
}else if (isset($_POST['retrieve'])) {
    
    $id = $_POST['id'];
    $applicant_id = $_POST['applicant_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $position_id = $_POST['position_id'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state_province = $_POST['state_province'];
    $postal_zip_code = $_POST['postal_zip_code'];
    $birthdate = $_POST['birthdate'];
    $resume = $_POST['resume'];

        $insertQuery = "INSERT INTO application 
                (id, applicant_id, firstname, middlename, lastname, email, gender, contact_info, position_id, street_address, city, state_province, postal_zip_code, birthdate, resume)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $id, $applicant_id, $firstname, $middlename, $lastname, $email, $gender, $phone, $position_id, $street_address, $city, $state_province, $postal_zip_code, $birthdate, $resume);
        
        $insertResult = mysqli_stmt_execute($stmt);
        
        if ($insertResult) {

        $_SESSION['success'] = 'Applicant Application Record retrieved successfully!';
        
        
        $deleteQuery = "DELETE FROM application_archive WHERE id = ?";
        $statement = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($statement, "s", $id);
        mysqli_stmt_execute($statement);
        $deleteResult = mysqli_stmt_affected_rows($statement);
        if ($deleteResult) {

            echo " Record deleted from applications table.";
        } else {
            echo "Error deleting record from applications table: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving record: " . mysqli_error($conn);
    }

    
    mysqli_close($conn);
    header('location: recruitment_archive.php');
}
?>
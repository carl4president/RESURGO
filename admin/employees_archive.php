<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $position_id = $_POST['position_id'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $schedule_id = $_POST['schedule_id'];
    $hire_date = $_POST['hire_date'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $photo = $_POST['photo'];

    

    
        $sql = "INSERT INTO employees_archive (id, employee_id, firstname, middlename, lastname, email, gender, contact_info, position_id, address, birthdate, schedule_id, hire_date, username, password, photo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssississss", $id, $employee_id, $firstname, $middlename, $lastname, $email, $gender, $phone, $position_id, $address, $birthdate, $schedule_id, $hire_date, $username, $password, $photo);
        $stmt->execute();
    
        $sqlDelete = "DELETE FROM employees WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id);
        $stmtDelete->execute();
    
        if ($stmt->affected_rows > 0 && $stmtDelete->affected_rows > 0) {
                  
                $_SESSION['success'] = 'Employee Record archived successfully!';
                header("Location: employee.php");
                exit();
            } else {
                echo "Error archiving or deleting employee: " . $conn->error;
            }
            header("Location: employee.php");
            exit();

            } 
elseif (isset($_POST['retrieve'])) {
    
    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $position_id = $_POST['position_id'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $schedule_id = $_POST['schedule_id'];
    $hire_date = $_POST['hire_date'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $photo = $_POST['photo'];

    

    
    $sql = "INSERT INTO employees (id, employee_id, firstname, middlename, lastname, email, gender, contact_info, position_id, address, birthdate, schedule_id, hire_date, username, password, photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssississss", $id, $employee_id, $firstname, $middlename, $lastname, $email, $gender, $phone, $position_id, $address, $birthdate, $schedule_id, $hire_date, $username, $password, $photo);
    $stmt->execute();

    $sqlDelete = "DELETE FROM employees_archive WHERE id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();

    if ($stmt->affected_rows > 0 && $stmtDelete->affected_rows > 0) {
                  
                $_SESSION['success'] = 'Employee Record retrieved successfully!';
                header("Location: employee_archive.php");
                exit();
            } else {
                echo "Error archiving or deleting employee: " . $conn->error;
            }
            
                header("Location: employee_archive.php");
                exit();
            }
?>
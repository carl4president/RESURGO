<?php
if(isset($_POST['employee'])){
    $output = array('error' => false);
    
    include 'includes/conn.php';
    include 'includes/timezone.php';
    
    $employee = $_POST['employee'];
    $status = $_POST['status'];
    
    $sql = "SELECT * FROM employees WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employee);
    $stmt->execute();
    $result = $stmt->get_result();
    


    if($result->num_rows > 0){
        $row = $result->fetch_assoc(); 
        $id = $row['id'];
        $employee_id = $row['employee_id'];

        $date_now = date('Y-m-d');

        if($status == 'in_am'){
            $sql = "SELECT * FROM attendance WHERE employee_id = ? AND date = ? AND time_in_AM IS NOT NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $employee_id, $date_now);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows > 0){
                $output['error'] = true;
                $output['message'] = 'You have timed in for today morning';
            }

            else{
                
                $sched = $row['schedule_id'];
                $lognow = date('H:i:s');
                $sql = "SELECT * FROM schedules WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $sched);
                $stmt->execute();
                $sresult = $stmt->get_result();
                $srow = $sresult->fetch_assoc();
                $logstatus = ($lognow > $srow['time_in_AM']) ? 0 : 1;

                

                $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, time_in_AM, time_in_AM_status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $employee_id, $date_now, $lognow, $logstatus);
                $stmt->execute();
                
                if($stmt->affected_rows > 0){
                    $output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
                } else {
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
                
            }
        } else if($status == 'in_pm'){
            $sql = "SELECT * FROM attendance WHERE employee_id = ? AND date = ? AND time_in_PM IS NOT NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $employee_id, $date_now);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $arow = $result->fetch_assoc(); 
                if ($arow['time_in_PM'] != '00:00:00') {
                $output['error'] = true;
                $output['message'] = 'You have already timed in for today afternoon';
            }

            else{
                
                $sched = $row['schedule_id'];
                $lognow = date('H:i:s');
                $sql = "SELECT * FROM schedules WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $sched);
                $stmt->execute();
                $sresult = $stmt->get_result();
                $srow = $sresult->fetch_assoc();
                $logstatus = ($lognow > $srow['time_in_PM']) ? 0 : 1;

                $sql = "SELECT * FROM attendance WHERE employee_id = ? AND date = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $employee_id, $date_now);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    
                    $sql = "UPDATE attendance SET time_in_PM = ?, time_in_PM_status = ? WHERE employee_id = ? AND date = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $lognow, $logstatus, $employee_id, $date_now);
                    $stmt->execute();
                    if($stmt->affected_rows > 0){
                        $output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
                    } else {
                        $output['error'] = true;
                        $output['message'] = $conn->error;
                    }
                }else {    
                    $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, time_in_PM, time_in_PM_status) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $employee_id, $date_now, $lognow, $logstatus);
                    $stmt->execute();
                    
                    if($stmt->affected_rows > 0){
                        $output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
                    } else {
                        $output['error'] = true;
                        $output['message'] = $conn->error;
                    }
               }
                
            }
        }
        else if($status == 'out_am'){
            $sql = "SELECT *, attendance.id AS uid FROM attendance 
                    LEFT JOIN employees ON employees.employee_id = attendance.employee_id 
                    WHERE attendance.employee_id = ? AND date = ? AND time_in_AM IS NOT NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $employee_id, $date_now);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows < 1) {
                $output['error'] = true;
                $output['message'] = 'Cannot Timeout. No time in for morning.';
            } else {
                $row = $result->fetch_assoc(); 
                if ($row['time_out_AM'] != '00:00:00') {
                    $output['error'] = true;
                    $output['message'] = 'You have timed out for today morning';
                }
                else{
                    $logoutnow = date('H:i:s');
                    $sql = "UPDATE attendance SET time_out_AM = '$logoutnow' WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['uid']);
                    if($stmt->execute()){
                        $output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];
                    
                        $sql = "SELECT * FROM attendance WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $row['uid']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $urow = $result->fetch_assoc();

                    
                        $time_in_am = $urow['time_in_AM'];
                        $time_out_am = $urow['time_out_AM'];
                        $time_in_pm = $urow['time_in_PM'];
                        $time_out_pm = $urow['time_out_PM'];
                    
                        $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $employee_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $srow = $result->fetch_assoc();

                    
                        if($srow['time_in_AM'] > $urow['time_in_AM']){
                            $time_in_am = $srow['time_in_AM'];
                        }
                    
                        if($srow['time_out_AM'] < $urow['time_in_AM']){
                            $time_out_am = $srow['time_out_AM'];
                        }
                        if($srow['time_in_PM'] > $urow['time_in_PM']){
                            $time_in_pm = $srow['time_in_PM'];
                        }
                    
                        if($srow['time_out_PM'] < $urow['time_in_PM']){
                            $time_out_pm = $srow['time_out_PM'];
                        }
                    
                        $time_in_am = new DateTime($time_in_am);
                        $time_out_am = new DateTime($time_out_am);
                        $time_in_pm = new DateTime($time_in_pm);
                        $time_out_pm = new DateTime($time_out_pm);
                        $interval_am = $time_in_am->diff($time_out_am);
                        $interval_pm = $time_in_pm->diff($time_out_pm);
                        $total_hours_am = $interval_am->h + $interval_am->i / 60;
                        $total_hours_pm = $interval_pm->h + $interval_pm->i / 60;
                        $int = $total_hours_am + $total_hours_pm;
                        if($int > 4){
                            $int = $int - 1;
                        }
                    
                        
                        $scheduled_end_time_am = new DateTime($srow['time_out_AM']);
                        $scheduled_end_time_pm = new DateTime($srow['time_out_PM']);
                        
                        if ($time_out > $scheduled_end_time_am && $time_out > $scheduled_end_time_pm) {
                            
                            $overtime_am = $time_out->diff($scheduled_end_time_am);
                            $overtime_pm = $time_out->diff($scheduled_end_time_pm);
                        
                            
                            $overtime_hrs_am = $overtime_am->format('%h');
                            $overtime_mins_am = $overtime_am->format('%i') / 60;
                            $overtime_hrs_pm = $overtime_pm->format('%h');
                            $overtime_mins_pm = $overtime_pm->format('%i') / 60;
                        
                            
                            $overtime_total = $overtime_hrs_am + $overtime_mins_am + $overtime_hrs_pm + $overtime_mins_pm;

                                
                               $sql = "SELECT vacancy.rate 
                                        FROM vacancy 
                                        INNER JOIN employees ON employees.position_id = vacancy.id 
                                        WHERE employees.employee_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $employee_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc(); 
                                    $regular_rate = $row['rate'];

                                    
                                    $overtime_rate = 1.5 * $regular_rate;

                                    
                                    $total_overtime_pay = $overtime_rate * $overtime_total;

                                    
                                    $sql = "INSERT INTO overtime (employee_id, hours, rate, total_overtime_pay, date) 
                                            VALUES (?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("iddds", $employee_id, $overtime_total, $overtime_rate, $total_overtime_pay, $date_now);
                                    
                                    if (!$stmt->execute()) {
                                        $output['error'] = true;
                                        $output['message'] = 'Error updating overtime hours: ' . $stmt->error;
                                    }

                                } else {
                                    $output['error'] = true;
                                    $output['message'] = 'Regular rate not found for employee';
                                }
                            }

                    
                        
                        $sql = "UPDATE attendance SET num_hr = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("si", $int, $row['uid']);
                        if (!$stmt->execute()) {
                            $output['error'] = true;
                            $output['message'] = 'Error updating num_hr: ' . $stmt->error;
                        }
                        
                        
                        $overtime_status_am = ($time_out_am > $scheduled_end_time_am) ? 1 : 0;
                        $overtime_status_pm = ($time_out_pm > $scheduled_end_time_pm) ? 1 : 0;
                        $sql = "UPDATE attendance SET time_out_AM_status = ?, time_out_PM_status = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iii", $overtime_status_am, $overtime_status_pm, $row['uid']);
                        if (!$stmt->execute()) {
                            $output['error'] = true;
                            $output['message'] = 'Error updating overtime status: ' . $stmt->error;
                        }
                    }
                    
                    else{
                        $output['error'] = true;
                        $output['message'] = 'Error updating time out: ' . $conn->error;
                    }
                }
            }
        }         else if($status == 'out_pm'){
            $sql = "SELECT *, attendance.id AS uid FROM attendance 
                    LEFT JOIN employees ON employees.employee_id = attendance.employee_id 
                    WHERE attendance.employee_id = ? AND date = ? AND time_in_PM IS NOT NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $employee_id, $date_now);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows < 1) {
                $output['error'] = true;
                $output['message'] = 'Cannot Timeout. No time in for afternoon.';
            } else {
                $row = $result->fetch_assoc(); 
                if ($row['time_out_PM'] != '00:00:00') {
                    $output['error'] = true;
                    $output['message'] = 'You have timed out for today morning';
                }
                else{
                    $logoutnow = date('H:i:s');
                  $sql = "UPDATE attendance SET time_out_PM = '$logoutnow' WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $row['uid']);
                    if($stmt->execute()){
                        $output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];
                    
                        $sql = "SELECT * FROM attendance WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $row['uid']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $urow = $result->fetch_assoc();

                    
                        $time_in_am = $urow['time_in_AM'];
                        $time_out_am = $urow['time_out_AM'];
                        $time_in_pm = $urow['time_in_PM'];
                        $time_out_pm = $urow['time_out_PM'];
                    
                        $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $employee_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $srow = $result->fetch_assoc();

                    
                        if($srow['time_in_AM'] > $urow['time_in_AM']){
                            $time_in_am = $srow['time_in_AM'];
                        }
                    
                        if($srow['time_out_AM'] < $urow['time_in_AM']){
                            $time_out_am = $srow['time_out_AM'];
                        }
                        if($srow['time_in_PM'] > $urow['time_in_PM']){
                            $time_in_pm = $srow['time_in_PM'];
                        }
                    
                        if($srow['time_out_PM'] < $urow['time_in_PM']){
                            $time_out_pm = $srow['time_out_PM'];
                        }
                    
                        $time_in_am = new DateTime($time_in_am);
                        $time_out_am = new DateTime($time_out_am);
                        $time_in_pm = new DateTime($time_in_pm);
                        $time_out_pm = new DateTime($time_out_pm);
                        $interval_am = $time_in_am->diff($time_out_am);
                        $interval_pm = $time_in_pm->diff($time_out_pm);
                        $total_hours_am = $interval_am->h + $interval_am->i / 60;
                        $total_hours_pm = $interval_pm->h + $interval_pm->i / 60;
                        $int = $total_hours_am + $total_hours_pm;
                        if($int > 4){
                            $int = $int - 1;
                        }
                    
                        
                        $scheduled_end_time_am = new DateTime($srow['time_out_AM']);
                        $scheduled_end_time_pm = new DateTime($srow['time_out_PM']);
                        
                        if ($time_out > $scheduled_end_time_am && $time_out > $scheduled_end_time_pm) {
                            
                            $overtime_am = $time_out->diff($scheduled_end_time_am);
                            $overtime_pm = $time_out->diff($scheduled_end_time_pm);
                        
                            
                            $overtime_hrs_am = $overtime_am->format('%h');
                            $overtime_mins_am = $overtime_am->format('%i') / 60;
                            $overtime_hrs_pm = $overtime_pm->format('%h');
                            $overtime_mins_pm = $overtime_pm->format('%i') / 60;
                        
                            
                            $overtime_total = $overtime_hrs_am + $overtime_mins_am + $overtime_hrs_pm + $overtime_mins_pm;

                                
                               $sql = "SELECT vacancy.rate 
                                        FROM vacancy 
                                        INNER JOIN employees ON employees.position_id = vacancy.id 
                                        WHERE employees.employee_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $employee_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc(); 
                                    $regular_rate = $row['rate'];

                                    
                                    $overtime_rate = 1.5 * $regular_rate;

                                    
                                    $total_overtime_pay = $overtime_rate * $overtime_total;

                                    
                                    $sql = "INSERT INTO overtime (employee_id, hours, rate, total_overtime_pay, date) 
                                            VALUES (?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("iddds", $employee_id, $overtime_total, $overtime_rate, $total_overtime_pay, $date_now);
                                    
                                    if (!$stmt->execute()) {
                                        $output['error'] = true;
                                        $output['message'] = 'Error updating overtime hours: ' . $stmt->error;
                                    }

                                } else {
                                    $output['error'] = true;
                                    $output['message'] = 'Regular rate not found for employee';
                                }
                            }

                    
                        
                        $sql = "UPDATE attendance SET num_hr = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("si", $int, $row['uid']);
                        if (!$stmt->execute()) {
                            $output['error'] = true;
                            $output['message'] = 'Error updating num_hr: ' . $stmt->error;
                        }
                        
                        
                        $overtime_status_am = ($time_out_am > $scheduled_end_time_am) ? 1 : 0;
                        $overtime_status_pm = ($time_out_pm > $scheduled_end_time_pm) ? 1 : 0;
                        $sql = "UPDATE attendance SET time_out_AM_status = ?, time_out_PM_status = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iii", $overtime_status_am, $overtime_status_pm, $row['uid']);
                        if (!$stmt->execute()) {
                            $output['error'] = true;
                            $output['message'] = 'Error updating overtime status: ' . $stmt->error;
                        }
                    }
                    
                    else{
                        $output['error'] = true;
                        $output['message'] = 'Error updating time out: ' . $conn->error;
                    }
                }
            }
        }
    }
    else{
        $output['error'] = true;
        $output['message'] = 'Employee ID not found';
    }
    $stmt->close();
    $conn->close();
}

    echo json_encode($output);


function calculateTotalHoursWorked($start, $end) {
    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);

    
    $difference = $endTimestamp - $startTimestamp;

    
    $totalHours = $difference / 3600;

    return $totalHours;
}
?>

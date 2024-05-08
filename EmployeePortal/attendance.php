<?php
if(isset($_POST['employee'])){
    $output = array('error'=>false);

    include 'includes/conn.php';
    include 'includes/timezone.php';

    $employee = $_POST['employee'];
    $status = $_POST['status'];

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        $id = $row['id'];
        $employee_id = $row['employee_id'];

        $date_now = date('Y-m-d');

        if($status == 'in'){
            $sql = "SELECT * FROM attendance WHERE employee_id = '$employee_id' AND date = '$date_now' AND time_in IS NOT NULL";
            $query = $conn->query($sql);
            if($query->num_rows > 0){
                $output['error'] = true;
                $output['message'] = 'You have timed in for today';
            }
            else{
                
                $sched = $row['schedule_id'];
                $lognow = date('H:i:s');
                $sql = "SELECT * FROM schedules WHERE id = '$sched'";
                $squery = $conn->query($sql);
                $srow = $squery->fetch_assoc();
                $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
                

                $sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$employee_id', '$date_now', NOW(), '$logstatus')";
                if($conn->query($sql)){
                    $output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
                }
                else{
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
            }
        }
        else{
            $sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.employee_id=attendance.employee_id WHERE attendance.employee_id = '$employee_id' AND date = '$date_now'";
            $query = $conn->query($sql);
            if($query->num_rows < 1){
                $output['error'] = true;
                $output['message'] = 'Cannot Timeout. No time in.';
            }
            else{
                $row = $query->fetch_assoc();
                if($row['time_out'] != '00:00:00'){
                    $output['error'] = true;
                    $output['message'] = 'You have timed out for today';
                }
                else{
                    $sql = "UPDATE attendance SET time_out = NOW() WHERE id = '".$row['uid']."'";
                    if($conn->query($sql)){
                        $output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];
                    
                        $sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
                        $query = $conn->query($sql);
                        $urow = $query->fetch_assoc();
                    
                        $time_in = $urow['time_in'];
                        $time_out = $urow['time_out'];
                    
                        $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = '$employee_id'";
                        $query = $conn->query($sql);
                        $srow = $query->fetch_assoc();
                    
                        if($srow['time_in'] > $urow['time_in']){
                            $time_in = $srow['time_in'];
                        }
                    
                        if($srow['time_out'] < $urow['time_in']){
                            $time_out = $srow['time_out'];
                        }
                    
                        $time_in = new DateTime($time_in);
                        $time_out = new DateTime($time_out);
                        $interval = $time_in->diff($time_out);
                        $hrs = $interval->format('%h');
                        $mins = $interval->format('%i');
                        $mins = $mins/60;
                        $int = $hrs + $mins;
                        if($int > 4){
                            $int = $int - 1;
                        }
                    
                        
                        $scheduled_end_time = new DateTime($srow['time_out']);
                            if ($time_out > $scheduled_end_time) {
                                
                                $overtime = $time_out->diff($scheduled_end_time);
                                $overtime_hrs = $overtime->format('%h');
                                $overtime_mins = $overtime->format('%i');
                                $overtime_mins = $overtime_mins / 60;
                                $overtime_total = $overtime_hrs + $overtime_mins;

                                
                                $sql = "SELECT vacancy.rate 
                                FROM vacancy 
                                INNER JOIN employees ON employees.position_id = vacancy.id 
                                WHERE employees.employee_id = '$employee_id'";
;
                                $query = $conn->query($sql);
                                if ($query->num_rows > 0) {
                                    $row = $query->fetch_assoc();
                                    $regular_rate = $row['rate'];

                                    
                                    $overtime_rate = 1.5 * $regular_rate;

                                    
                                    $total_overtime_pay = $overtime_rate * $overtime_total;

                                    
                                    $sql = "INSERT INTO overtime (employee_id, hours, rate, total_overtime_pay, date) 
                                            VALUES ('$employee_id', '$overtime_total', '$overtime_rate', '$total_overtime_pay', '$date_now')";
                                    if (!$conn->query($sql)) {
                                        $output['error'] = true;
                                        $output['message'] = 'Error updating overtime hours: ' . $conn->error;
                                    }
                                } else {
                                    $output['error'] = true;
                                    $output['message'] = 'Regular rate not found for employee';
                                }
                            }

                    
                        
                        $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
                        if(!$conn->query($sql)){
                            $output['error'] = true;
                            $output['message'] = 'Error updating num_hr: ' . $conn->error;
                        }
                    
                        // Update overtime_status in attendance table
                        $overtime_status = ($time_out > $scheduled_end_time) ? 1 : 0;
                        $sql = "UPDATE attendance SET overtime_status = '$overtime_status' WHERE id = '".$row['uid']."'";
                        if(!$conn->query($sql)){
                            $output['error'] = true;
                            $output['message'] = 'Error updating overtime status: ' . $conn->error;
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

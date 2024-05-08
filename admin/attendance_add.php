<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $employee = $_POST['employee'];
    $date = $_POST['date'];
    $time_in = $_POST['time_in'];
    $time_in = date('H:i:s', strtotime($time_in));
    $time_out = $_POST['time_out'];
    $time_out = date('H:i:s', strtotime($time_out));

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Employee not found';
    } else {
        $row = $query->fetch_assoc();
        $emp = $row['id'];
        $emp_id = $row['employee_id'];

        $sql = "SELECT * FROM attendance WHERE employee_id = '$emp_id' AND date = '$date'";
        $query = $conn->query($sql);

        if ($query->num_rows > 0) {
            $_SESSION['error'] = 'Employee attendance for the day exists';
        } else {
            
            $sched = $row['schedule_id'];
            $sql = "SELECT * FROM schedules WHERE id = '$sched'";
            $squery = $conn->query($sql);
            $scherow = $squery->fetch_assoc();
            $logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
            $overtime_status = ($time_out < $scherow['time_out']) ? 0 : 1;
            

            $sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, status, overtime_status) VALUES ('$emp_id', '$date', '$time_in', '$time_out', '$logstatus', '$overtime_status')";
            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Attendance added successfully';
				$id = $conn->insert_id;

			$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = '$emp_id'";
			$query = $conn->query($sql);
			$srow = $query->fetch_assoc();


			if($srow['time_in'] > $time_out){
				$time_in = $srow['time_in'];
			}

			if($srow['time_out'] < $time_in){
				$time_out = $srow['time_out'];
			}
            
			$time_in = date('H:i:s', strtotime($time_in));
			$time_out = date('H:i:s', strtotime($time_out));

			$time_in_obj = DateTime::createFromFormat('H:i:s', $time_in);
			$time_out_obj = DateTime::createFromFormat('H:i:s', $time_out);
	
			$interval = $time_in_obj->diff($time_out_obj);
			$hours = $interval->format('%h');
			$minutes = $interval->format('%i');
			$int = $hours + ($minutes / 60);

		    $sql = "SELECT employees.schedule_id, schedules.time_out, vacancy.rate
				FROM employees
				LEFT JOIN schedules ON schedules.id = employees.schedule_id
				LEFT JOIN vacancy ON vacancy.id = employees.position_id
				WHERE employees.employee_id = '$emp_id'";
					$query = $conn->query($sql);

					if ($query) {
						$result = $query->fetch_assoc();

						if ($result) {
							$scheduleOut = $result['time_out'];
							$rate = $result['rate'];

							echo "Rate: $int<br>";
							echo "Time Out: $scheduleOut<br>";

							if (strtotime($time_out) > strtotime($scheduleOut)) {
								$overtimeHours = max(0, (strtotime($time_out) - strtotime($scheduleOut)) / 3600);
							

								$overTimeRate = max(0, $rate) * 1.5;

								$overtimeHours = max(0, $overtimeHours);

								$overtimePay = $overtimeHours * $overTimeRate;

								$existingOvertimeSql = "SELECT * FROM overtime WHERE employee_id = '$emp_id' AND date_overtime = '$date'";
									$existingOvertimeResult = $conn->query($existingOvertimeSql);

									if ($existingOvertimeResult->num_rows > 0) {
										
										$updateOvertimeSql = "UPDATE overtime SET hours = '$overtimeHours', rate = '$overTimeRate', total_overtime_pay = '$overtimePay'
															WHERE employee_id = '$emp_id' AND date_overtime = '$date'";
										$conn->query($updateOvertimeSql);

										echo "Overtime updated for employee ID: $emp. Hours: $overtimeHours, Overtime Pay: $overtimePay";
									} else {
										
										$insertOvertimeSql = "INSERT INTO overtime (employee_id, hours, rate, total_overtime_pay, date_overtime)
															VALUES ('$emp_id', '$overtimeHours', '$overTimeRate', '$overtimePay', '$date')";
										$conn->query($insertOvertimeSql);

											}

										echo "Overtime recorded for employee ID: $emp. Hours: $overtimeHours, Overtime Pay: $overtimePay";

									} else {
										echo "No overtime recorded for employee ID: $emp_id.";
									}
								} else {
									echo "No matching schedule found for the employee.";
								}
							} else {
								echo "Error in the query: " . $conn->error;
							}

							$sql = "UPDATE attendance SET num_hr = '$int', status = '$logstatus', overtime_status = '$overtime_status' WHERE id = '$id'";
							$conn->query($sql);
							}
							else{
								$_SESSION['error'] = $conn->error;
							}
						}
					}
				}

						header('location:attendance.php');

					?>
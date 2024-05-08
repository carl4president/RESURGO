<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
        $time_in_am = $_POST['time_in_am'];
        $time_in_am = date('H:i:s', strtotime($time_in_am));
        $time_out_am = $_POST['time_out_am'];
        $time_out_am = date('H:i:s', strtotime($time_out_am));
        $time_in_pm = $_POST['time_in_pm'];
        $time_in_pm = date('H:i:s', strtotime($time_in_pm));
        $time_out_pm = $_POST['time_out_pm'];
        $time_out_pm = date('H:i:s', strtotime($time_out_pm));

		$sql = "UPDATE attendance SET date = ?, time_in_AM = ?, time_out_AM = ?, time_in_PM = ?, time_out_PM = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $date, $time_in_am, $time_out_am, $time_in_pm, $time_out_pm, $id);
        if($stmt->execute()){
			$_SESSION['success'] = 'Attendance updated successfully';

			$sql = "SELECT * FROM attendance WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
			$emp = $row['employee_id'];

			$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $emp);
            $stmt->execute();
            $result = $stmt->get_result();
            $srow = $result->fetch_assoc();

			
            $log_am_status = ($time_in_am > $srow['time_in_AM']) ? 0 : 1;
            $overtime_am_status = ($time_out_am < $srow['time_out_AM']) ? 0 : 1;
            $log_pm_status = ($time_in_pm > $srow['time_in_PM']) ? 0 : 1;
            $overtime_pm_status = ($time_out_pm < $srow['time_out_PM']) ? 0 : 1;
			

			if ($srow['time_in_AM'] > $time_out_am) {
                $time_in_am = $srow['time_in_AM'];
            }
            
            if ($srow['time_out_AM'] < $time_in_am) {
                $time_out_am = $srow['time_out_AM'];
            }
            
            if ($srow['time_in_PM'] > $time_out_pm) {
                $time_in_pm = $srow['time_in_PM'];
            }
            
            if ($srow['time_out_PM'] < $time_in_pm) {
                $time_out_pm = $srow['time_out_PM'];
            }
            
    	     $time_in_am = date('H:i:s', strtotime($time_in_am));
            $time_out_am = date('H:i:s', strtotime($time_out_am));
            $time_in_pm = date('H:i:s', strtotime($time_in_pm));
            $time_out_pm = date('H:i:s', strtotime($time_out_pm));
            
            $time_in_am_obj = DateTime::createFromFormat('H:i:s', $time_in_am);
            $time_out_am_obj = DateTime::createFromFormat('H:i:s', $time_out_am);
            $time_in_pm_obj = DateTime::createFromFormat('H:i:s', $time_in_pm);
            $time_out_pm_obj = DateTime::createFromFormat('H:i:s', $time_out_pm);
            
            $interval_am = $time_in_am_obj->diff($time_out_am_obj);
            $interval_pm = $time_in_pm_obj->diff($time_out_pm_obj);
            $hours_am = $interval_am->h + ($interval_am->i / 60);
            $hours_pm = $interval_pm->h + ($interval_pm->i / 60);
            $int = $hours_am + $hours_pm;

		    $sql = "SELECT employees.schedule_id, schedules.time_out_AM, schedules.time_out_PM, vacancy.rate
				FROM employees
				LEFT JOIN schedules ON schedules.id = employees.schedule_id
				LEFT JOIN vacancy ON vacancy.id = employees.position_id
				WHERE employees.employee_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $emp);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
						$result = $query->fetch_assoc();

						if ($result) {
                            $schedule_AM_Out = $result['time_out_AM'];
                            $schedule_PM_Out = $result['time_out_PM'];
                            $rate = $result['rate'];

							echo "Rate: $int<br>";
							echo "Time Out: $scheduleOut<br>";

							if (strtotime($time_out_pm) > strtotime($schedule_PM_Out) || strtotime($time_out_am) > strtotime($schedule_AM_Out)) {
								$overtimeHours = max(0, (strtotime($time_out_am) - strtotime($schedule_AM_Out) + strtotime($time_out_pm) - strtotime($schedule_PM_Out)) / 3600);
							

								$overTimeRate = max(0, $rate) * 1.5;

								$overtimeHours = max(0, $overtimeHours);

								$overtimePay = $overtimeHours * $overTimeRate;

								$existingOvertimeSql = "SELECT * FROM overtime WHERE employee_id = ? AND date_overtime = ?";
                                $existingOvertimeStmt = $conn->prepare($existingOvertimeSql);
                                $existingOvertimeStmt->bind_param("ss", $emp, $date);
                                $existingOvertimeStmt->execute();
                                $existingOvertimeResult = $existingOvertimeStmt->get_result();
                            
                                if ($existingOvertimeResult->num_rows > 0) {
                                    
                                    $updateOvertimeSql = "UPDATE overtime SET hours = ?, rate = ?, total_overtime_pay = ? WHERE employee_id = ? AND date_overtime = ?";
                                    $stmt = $conn->prepare($updateOvertimeSql);
                                    $stmt->bind_param("ddsss", $overtimeHours, $overTimeRate, $overtimePay, $emp, $date);
                                    $stmt->execute();
                                    echo "Overtime updated for employee ID: $emp. Hours: $overtimeHours, Overtime Pay: $overtimePay";
                                } else {
                                    
                                    $insertOvertimeSql = "INSERT INTO overtime (employee_id, hours, rate, total_overtime_pay, date_overtime)
                                                        VALUES (?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($insertOvertimeSql);
                                    $stmt->bind_param("sddss", $emp, $overtimeHours, $overTimeRate, $overtimePay, $date);
                                    $stmt->execute();
                                    echo "Overtime recorded for employee ID: $emp. Hours: $overtimeHours, Overtime Pay: $overtimePay";
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

								

								$sql = "UPDATE attendance SET num_hr = ?, time_in_AM_status = ?, time_out_AM_status = ?, time_in_PM_status = ?, time_out_PM_status = ? WHERE id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("sssssi", $int, $log_am_status, $overtime_am_status, $log_pm_status, $overtime_pm_status, $id);
                                    $stmt->execute();
                                } else {
                                    $_SESSION['error'] = $conn->error;
                                }
						}
						else{
							$_SESSION['error'] = 'Fill up edit form first';
						}

						header('location:attendance.php');

					?>
<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	$employee_id = isset($_SESSION['employee']) ? $_SESSION['employee'] : '';


	$sql = "SELECT *, SUM(DISTINCT num_hr) AS total_hr, attendance.employee_id AS empid, (SELECT SUM(amount) FROM bonus WHERE bonus.id = employee_bonus.bonus_id AND date_bonus BETWEEN '$from' AND '$to') AS total_bonus, (SELECT SUM(total_overtime_pay) FROM overtime WHERE overtime.employee_id = attendance.employee_id AND date_overtime BETWEEN '$from' AND '$to') AS total_overtimepay FROM attendance LEFT JOIN employees ON employees.employee_id = attendance.employee_id LEFT JOIN employee_bonus ON employee_bonus.employee_id = employees.employee_id LEFT JOIN overtime ON overtime.employee_id = attendance.employee_id LEFT JOIN vacancy ON vacancy.id = employees.position_id
	WHERE attendance.employee_id = '$employee_id' 
		AND date BETWEEN '$from' AND '$to' 
	GROUP BY attendance.employee_id 
	ORDER BY employees.lastname ASC, employees.firstname ASC";

	$query = $conn->query($sql);
	$total = 0;

	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];

		$casql = "SELECT *, SUM(amount) AS cashamount, type, effective_date 
					FROM employee_deductions 
					LEFT JOIN deductions ON deductions.id = employee_deductions.deduction_id 
					WHERE employee_id = '$empid'";

				if (isset($row['type'])) {
				$type = $row['type'];

				if ($type == 1) {
					
					$casql .= " AND date_created BETWEEN '$from' AND '9999-12-31'";
				} elseif ($type == 2) {
					
					$dayOfMonth = date('j', strtotime($ex[0]));

					if ($dayOfMonth <= 15) {
						
						$casql .= " AND DAY(date_created) <= 15";
					} else {
						
						$casql .= " AND DAY(date_created) > 15";
					}
				} elseif ($type == 3) {
					
					$casql .= " AND effective_date BETWEEN '$from' AND '$to'";
				}
				}


		$caquery = $conn->query($casql);
		$carow = $caquery->fetch_assoc();

		
		$osql = "SELECT *, SUM(total_overtime_pay) AS otamount 
					FROM overtime 
					WHERE employee_id = '$empid' AND date_overtime BETWEEN '$from' AND '$to'";

		$oquery = $conn->query($osql);
		$orow = $oquery->fetch_assoc();

		$deductions = $carow['cashamount'];
		$bonus_pay = $row['total_bonus'];
		$overtime_pay = $row['total_overtimepay'];
		$gross = $row['rate'] * $row['total_hr'];
		$gross_total = $gross + $overtime_pay + $bonus_pay;
		
	   if ($gross_total >= 20250 && $gross_total <= 20749.99) {
        $SSS_deduction = 500.00;  
        } elseif ($gross_total >= 20750 && $gross_total <= 21249.99) {
            $SSS_deduction = 1000.00;
        } elseif ($gross_total >= 21250 && $gross_total <= 21749.99) {
            $SSS_deduction = 1500.00;
        } elseif ($gross_total >= 21750 && $gross_total <= 22249.99) {
            $SSS_deduction = 2000.00;
        } elseif ($gross_total >= 22250 && $gross_total <= 22749.99) {
            $SSS_deduction = 2500.00;
        } elseif ($gross_total >= 22750 && $gross_total <= 23249.99) {
            $SSS_deduction = 3000.00;
        } elseif ($gross_total >= 23250 && $gross_total <= 23749.99) {
            $SSS_deduction = 3500.00;
        } elseif ($gross_total >= 23750 && $gross_total <= 24249.99) {
            $SSS_deduction = 4000.00;
        } elseif ($gross_total >= 24250 && $gross_total <= 24749.99) {
            $SSS_deduction = 4500.00;
        } elseif ($gross_total >= 24750 && $gross_total <= 25249.99) {
            $SSS_deduction = 5000.00;
        } elseif ($gross_total >= 25250 && $gross_total <= 25749.99) {
            $SSS_deduction = 5500.00;
        } elseif ($gross_total >= 25750 && $gross_total <= 26249.99) {
            $SSS_deduction = 6000.00;
        } elseif ($gross_total >= 26250 && $gross_total <= 26749.99) {
            $SSS_deduction = 6500.00;
        } elseif ($gross_total >= 26750 && $gross_total <= 27249.99) {
            $SSS_deduction = 7000.00;
        } elseif ($gross_total >= 27250 && $gross_total <= 27749.99) {
            $SSS_deduction = 7500.00;
        } elseif ($gross_total >= 27750 && $gross_total <= 28249.99) {
            $SSS_deduction = 8000.00;
        } elseif ($gross_total >= 28250 && $gross_total <= 28749.99) {
            $SSS_deduction = 8500.00;
        } elseif ($gross_total >= 28750 && $gross_total <= 29249.99) {
            $SSS_deduction = 9000.00;
        } elseif ($gross_total >= 29250 && $gross_total <= 29749.99) {
            $SSS_deduction = 9500.00;
        } elseif ($gross_total >= 29750) {
            $SSS_deduction = 10000.00;
        } else {
            $SSS_deduction = 0; 
        }
        
        
        $monthlyBasicIncome = $gross_total;
        $premiumRate = 0.05;  
        
        if ($monthlyBasicIncome <= 10000) {
            $PhilHealth_deduction = 500.00;  
        } elseif ($monthlyBasicIncome >= 10000.01 && $monthlyBasicIncome < 100000) {
            $calculatedPremium = $monthlyBasicIncome * $premiumRate;
            $PhilHealth_deduction = ($calculatedPremium > 5000) ? 5000 : $calculatedPremium;  
        } elseif ($monthlyBasicIncome >= 100000) {
            $PhilHealth_deduction = 5000.00; 
        }
        
        if ($gross_total <= 1500) {
            $PagIBIG_deduction = $gross_total * 0.01; 
            $max_contribution = 15;
        } else {
            $PagIBIG_deduction = $gross_total * 0.02; 
            $max_contribution = 200;
        }
        
        $PagIBIG_deduction = min($PagIBIG_deduction, $max_contribution);
		
		$total_deduction = $deductions + $SSS_deduction + $PhilHealth_deduction + $PagIBIG_deduction;
		$net = $gross_total - $total_deduction;

		$contents .= '
			<h2 align="center">Our Lady of the Sacred Heart College of Guimba, Inc.</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Employee Name: </td>
                 	<td width="25%"><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
				 	<td width="25%" align="right">Rate per Hour: </td>
                 	<td width="25%" align="right">'.number_format($row['rate'], 2).'</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">Employee ID: </td>
				 	<td width="25%">'.$row['employee_id'].'</td>   
				 	<td width="25%" align="right">Total Hours: </td>
				 	<td width="25%" align="right">'.number_format($row['total_hr'], 2).'</td> 
    	    	</tr>

				<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Earnings: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($gross), 2).'</b></td> 
    	    	</tr>
				<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Bonus Pay: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($bonus_pay), 2).'</b></td> 
    	    	</tr>
				<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Overtime Pay: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($overtime_pay), 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Gross Pay: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($row['rate']*$row['total_hr']), 2).'</b></td> 
    	    	</tr>
				<tr> 
				<td></td> 
				<td></td>
				 <td width="25%" align="right"><b>Deductions </b></td>
			</tr>
				';
				$deductionDetailsSql = "SELECT d.*, d.deduction
                        FROM employee_deductions ed
                        LEFT JOIN deductions d ON ed.deduction_id = d.id
                        WHERE ed.employee_id='$empid'";
							$deductionDetailsQuery = $conn->query($deductionDetailsSql);

							while ($deductionRow = $deductionDetailsQuery->fetch_assoc()) {
								
								$deductionDescription = isset($deductionRow['deduction']) ? $deductionRow['deduction'] : '';

								$contents .= '
									<tr>
										<td></td>
										<td></td>
										<td width="25%" align="right">' . $deductionDescription . ':</td>
										<td width="25%" align="right">' . number_format($deductionRow['amount'], 2) . '</td>
									</tr>
								';
							}




				$contents .= '
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>SSS:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($SSS_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Pag-IBIG:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($PagIBIG_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>PhilHealth:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($PhilHealth_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Deduction:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Net Pay:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
			';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>
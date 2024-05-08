<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn, $deduction){
		$contents = '';
	 	
		$sql = "SELECT *, SUM(DISTINCT num_hr) AS total_hr, attendance.employee_id AS empid, (SELECT SUM(amount) FROM bonus WHERE bonus.id = employee_bonus.bonus_id AND date_bonus BETWEEN '$from' AND '$to') AS total_bonus, (SELECT SUM(total_overtime_pay) FROM overtime WHERE overtime.employee_id = attendance.employee_id AND date_overtime BETWEEN '$from' AND '$to') AS total_overtimepay FROM attendance LEFT JOIN employees ON employees.employee_id = attendance.employee_id LEFT JOIN employee_bonus ON employee_bonus.employee_id = employees.employee_id LEFT JOIN overtime ON overtime.employee_id = attendance.employee_id LEFT JOIN vacancy ON vacancy.id = employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

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
			$total_deduction = $deductions;
			$net = $gross_total - $total_deduction;


			$total += $net;
			$contents .= '
			<tr>
				<td>'.$row['lastname'].', '.$row['firstname'].'</td>
				<td>'.$empid.'</td>
				<td align="right">'.number_format($net, 2).'</td>
			</tr>
			';
		}

		$contents .= '
			<tr>
				<td colspan="2" align="right"><b>Total</b></td>
				<td align="right"><b>'.number_format($total, 2).'</b></td>
			</tr>
		';
		return $contents;
	}
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payroll: '.$from_title.' - '.$to_title);  
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
    $content = '';  
    $content .= '
      	<h2 align="center">Our Lady of the Sacred Heart College of Guimba, Inc.</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="40%" align="center"><b>Employee Name</b></th>
                <th width="30%" align="center"><b>Employee ID</b></th>
				<th width="30%" align="center"><b>Net Pay</b></th> 
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn, $deduction);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');

?>
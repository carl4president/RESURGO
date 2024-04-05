<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Total Earnings</th>
                  <th>Bonus</th>
                  <th>Overtime Pay</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Net Pay</th>
                </thead>
                <tbody>
                  <?php
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

            
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
                        $total_deduction = $deductions;
                        $net = $gross_total - $total_deduction;

                      echo "
                        <tr>
                          <td>".$row['lastname'].", ".$row['firstname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".number_format($gross, 2)."</td>
                          <td>".number_format($bonus_pay, 2)."</td>
                          <td>".number_format($overtime_pay, 2)."</td>
                          <td>".number_format($gross_total, 2)."</td>
                          <td>".number_format($deductions, 2)."</td>
                          <td>".number_format($net, 2)."</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'position_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.position);
      $('#edit_rate').val(response.rate);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.position);
    }
  });
}


</script>
</body>
</html>

<?php include 'includes/session.php'; ?>
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
      Attendance History
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Time and Attendance</a></li>
        <li class="active">Attendance History</li>
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
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Date</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                </thead>
                <tbody>
                  <?php
                    $employee = $_SESSION['employee'];
                    $sql = "SELECT * FROM attendance WHERE employee_id = '$employee'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $time_in_AM_status = ($row['time_in_AM_status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      $time_out_AM_status = ($row['time_out_AM_status'])?'<span class="label label-danger pull-right">overtime</span>':'<span class="label label-warning pull-right">timed out ontime</span>';
                        $time_in_PM_status = ($row['time_in_PM_status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      $time_out_PM_status = ($row['time_out_PM_status'])?'<span class="label label-danger pull-right">overtime</span>':'<span class="label label-warning pull-right">timed out ontime</span>';
                      echo "
                        <tr>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".date('h:i A', strtotime($row['time_in_AM'])).$time_in_AM_status."</td>
                          <td>".date('h:i A', strtotime($row['time_out_AM'])).$time_out_AM_status."</td>
                          <td>".date('h:i A', strtotime($row['time_in_PM'])).$time_in_PM_status."</td>
                          <td>".date('h:i A', strtotime($row['time_out_PM'])).$time_out_PM_status."</td>
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

</body>
</html>

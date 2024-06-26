<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
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
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <?php
                    $sql = "SELECT * FROM application";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $stmt->store_result();
                    echo "<h3>".$stmt->num_rows."</h3>";
                ?>


              <p>Total Applications</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="recruitment.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM vacancy WHERE status = 1";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total Active Vacancy</p>
            </div>
            <div class="icon">
              <i class="fa fa-search"></i>
            </div>
            <a href="vacancy.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT * FROM vacancy");
                $stmt->execute();
                
                $stmt->store_result();
                echo "<h3>".$stmt->num_rows."</h3>";

              ?>

              <p>Total Job Positions</p>
            </div>
            <div class="icon">
              <i class="fa fa-street-view"></i>
            </div>
            <a href="position.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
           <?php
                $sql = "SELECT * FROM leave_requests";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
            
                echo "<h3>".$result->num_rows."</h3>";
            ?>


              <p>Total Leave Requests</p>
            </div>
            <div class="icon">
              <i class="fa fa-sign-in"></i>
            </div>
            <a href="leave.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM employees";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                    $sql = "SELECT COUNT(*) AS total FROM attendance";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $stmt->bind_result($total);
                    $stmt->fetch();
                    $stmt->close();
                
                    $sql = "SELECT COUNT(*) AS early FROM attendance WHERE time_in_AM_status = ?";
                    $stmt = $conn->prepare($sql);
                    $status = 1;
                    $stmt->bind_param("i", $status);
                    $stmt->execute();
                    $stmt->bind_result($early);
                    $stmt->fetch();
                    $stmt->close();
                
                    $percentage = ($early/$total)*100;
                
                    echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
                ?>

          
              <p>On Time Percentage</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                    $sql = "SELECT * FROM attendance WHERE date = ? AND time_in_AM_status = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $today);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    echo "<h3>" . $result->num_rows . "</h3>";

              ?>
             
              <p>On Time Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                <?php
                $stmt = $conn->prepare("SELECT * FROM attendance WHERE date = ? AND time_in_AM_status = ?");
                $stmt->bind_param("si", $today, $status);
                $today = date("Y-m-d");
                $status = 0;
                $stmt->execute();
                $result = $stmt->get_result();
                echo "<h3>".$result->num_rows."</h3>";
                ?>


              <p>Late Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Attendance Report</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(date) = '.$year;
  $months = array();
  $ontime = array();
  $late = array();
  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM attendance WHERE MONTH(date) = ? AND time_in_AM_status = 1 $and";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $m);
    $stmt->execute();
    $oquery = $stmt->get_result();
    array_push($ontime, $oquery->num_rows);
    
    $sql = "SELECT * FROM attendance WHERE MONTH(date) = ? AND time_in_AM_status = 0 $and";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $m);
    $stmt->execute();
    $lquery = $stmt->get_result();
    array_push($late, $lquery->num_rows);
    
    $num = str_pad($m, 2, 0, STR_PAD_LEFT);
    $month = date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);

  }

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);

?>
<!-- End Chart Data -->
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Late',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $late; ?>
      },
      {
        label               : 'Ontime',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    
    scaleBeginAtZero        : true,
    
    scaleShowGridLines      : true,
    
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    
    scaleGridLineWidth      : 1,
    
    scaleShowHorizontalLines: true,
    
    scaleShowVerticalLines  : true,
    
    barShowStroke           : true,
    
    barStrokeWidth          : 2,
    
    barValueSpacing         : 5,
    
    barDatasetSpacing       : 1,
    
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>
</body>
</html>

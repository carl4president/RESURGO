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
        Schedules
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Schedules</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Time In (AM)</th>
                  <th>Time Out (AM)</th>
                  <th>Time In (PM)</th>
                  <th>Time Out (PM)</th>
                  <th>Total Hours</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM schedules";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".date('h:i A', strtotime($row['time_in_AM']))."</td>
                          <td>".date('h:i A', strtotime($row['time_out_AM']))."</td>
                          <td>".date('h:i A', strtotime($row['time_in_PM']))."</td>
                          <td>".date('h:i A', strtotime($row['time_out_PM']))."</td>
                          <td>". $row['total_hours']."</td>
                          <td>
                          <div class='btn-group'>
                          <button type='button' class='btn btn-primary'>Action</button>
                          <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <span class='caret'></span>
                          </button>
                          <div class='dropdown-menu'>
                            <button class='btn btn-success btn-sm edit btn-flat drpd-btn' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat drpd-btn' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            </div>
                            </div>
                          </td>
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
  <?php include 'includes/schedule_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.box-body').on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.box-body').on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'schedule_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#timeid').val(response.id);
      $('#edit_time_in_am').val(response.time_in_AM);
      $('#edit_time_out_am').val(response.time_out_AM);
      $('#edit_time_in_pm').val(response.time_in_PM);
      $('#edit_time_out_pm').val(response.time_out_PM);
      $('#del_timeid').val(response.id);
      $('#del_schedule').html('AM: ' + response.time_in_AM + ' - ' + response.time_out_AM + '<br> PM: ' + response.time_in_PM + ' - ' + response.time_out_PM);
    }
  });
}
</script>
</body>
</html>

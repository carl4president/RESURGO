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
        Leave Request
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave Request</li>
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
                  <th>Leave Type</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Duration</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Date Requested</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $employee = $_SESSION['employee'];
                    $sql = "SELECT * FROM leave_requests WHERE employee_id = '$employee'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                              <tr>
                                  <td>" . $row['leave_type'] . "</td>
                                  <td>" . $row['start_date'] . "</td>
                                  <td>" . $row['end_date'] . "</td>
                                  <td>" . $row['duration'] . "</td>
                                  <td>" . $row['reason'] . "</td>
                                  <td>";

                          if ($row['status'] == 'Pending') {
                              echo "<span class='badge badge-success' style='color: #fff; background-color: #28a745;'>" . $row['status'] . "</span>";
                          } else if ($row['status'] == 'Accepted') {
                              echo "<span class='badge badge-danger' style='color: #fff; background-color: #3c8dbc;'>" . $row['status'] . "</span>";
                          }
                          else if ($row['status'] == 'Rejected') {
                            echo "<span class='badge badge-danger' style='color: #fff; background-color: #dc3545;'>" . $row['status'] . "</span>";
                        }

                          echo "</td>
                                  <td>" . $row['date_requested'] . "</td>
                                  <td>
                                  <div class='btn-group'>
                                  <button type='button' class='btn btn-primary'>Action</button>
                                  <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <span class='caret'></span>
                                  </button>
                                  <div class='dropdown-menu'>
                                      <button class='btn btn-success btn-sm edit btn-flat drpd-btn' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                                      <button class='btn btn-danger btn-sm delete btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
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
  <?php include 'includes/leave_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


});


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'leave_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log('Server Response:', response);
      $('.id').val(response.id );
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_leave_type').val(response.leave_type);
      $('#edit_other_leave_type').val(response.leave_type);
      $('#reservation_leave_edit').val(response.start_date + ' - ' + response.end_date);
      $('#edit_reason').val(response.reason);
      $('.accept_emp_name').html(response.firstname + ' ' + response.middlename + ' ' + response.lastname);
      $('.accept_duration').val(response.duration).html(response.duration);
      $('.accept_employee_id').val(response.employee_id).html(response.employee_id);
      $('.accept_leave_type').val(response.leave_type).html(response.leave_type);
      $('.accept_end_date').val(response.end_date).html(response.end_date);
      $('.accept_start_date').val(response.start_date).html(response.start_date);
      $('.accept_reason').val(response.reason).html(response.reason);
    }
  });
}


</script>
</body>
</html>

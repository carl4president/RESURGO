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
        Employee Archive List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Employee Archive List</li>
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
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Schedule</th>
                  <th>Member Since</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees_archive.id AS empid FROM employees_archive LEFT JOIN vacancy ON vacancy.id=employees_archive.position_id LEFT JOIN schedules ON schedules.id=employees_archive.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>
                          <td><img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
                          <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname']; ?></td>
                          <td><?php echo $row['position']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>
                          <td><?php echo date('M d, Y', strtotime($row['hire_date'])) ?></td>
                          <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-primary'>Action</button>
                            <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              <span class='caret'></span>
                            </button>
                            <div class='dropdown-menu'>      
                             <button class="btn btn-sm btn-info view drpd-btn" data-id="<?php echo $row['empid']?>" type="button"><i class="fa fa-eye"> View</i></button>
                            <button class="btn btn-primary btn-sm retrieve btn-flat drpd-btn" data-id="<?php echo $row['empid']; ?>">
                                <i class="fa fa-mail-reply"></i> Retrieve
                            </button>

                          </div>
                         </div>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/employee_archive_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $('.retrieve').click(function(e){
    e.preventDefault();
    $('#retrieve').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.view').click(function(e){
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_archive_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log('Photo URL:', response.photo)
      $('.empid').val(response.empid);
      $('.employee_id').val(response.employee_id).html(response.employee_id);
      $('.ret_employee_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_middlename').val(response.middlename);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_position').val(response.position_id);
      $('#edit_gender').val(response.gender);
      $('#edit_schedule').val(response.schedule_id);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#address_val').val(response.address).html(response.address);
      $('#birthdate_val').val(response.birthdate).html(response.birthdate);
      $('#contact_val').val(response.contact_info).html(response.contact_info);
      $('#email_val').val(response.email).html(response.email);
      $('#email_view').html(response.email);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_value').val(response.position).html(response.position);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#photo_val').attr('src', '../images/' + response.photo).attr('alt', 'Employee Photo');
      $('#ret_id').val(response.id);
      $('#ret_employee_id').val(response.employee_id);
      $('#ret_firstname').val(response.firstname);
      $('#ret_middlename').val(response.middlename);
      $('#ret_lastname').val(response.lastname);
      $('#ret_address').val(response.address);
      $('#ret_birthdate').val(response.birthdate);
      $('#ret_contact').val(response.contact_info);
      $('#ret_gender').val(response.gender);
      $('#ret_email').val(response.email);
      $('#ret_position_id').val(response.position_id);
      $('#ret_schedule_id').val(response.schedule_id);
      $('#ret_photo').val(response.photo);
      $('#ret_hire_date').val(response.hire_date);
      $('#ret_username').val(response.username);
      $('#ret_password').val(response.password);
      
    }
  });
}

</script>
</body>
</html>

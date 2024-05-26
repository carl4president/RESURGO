
<?php include 'includes/session.php';
include 'includes/conn.php';

$query_applications = "SELECT * FROM application";
$result_applications = mysqli_query($conn, $query_applications);
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
        Application Archive List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Recruitment</a></li>
        <li class="active">Application Archive List</li>
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
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                    <th>Applicants ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Position</th>
                    <th>Resume</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                <?php
                  
                $sql = "SELECT a.*, v.position, v.availability 
                        FROM application a
                        INNER JOIN vacancy v ON v.id = a.position_id
                        WHERE a.status = 1";

                    $query = $conn->query($sql);

                    while ($row = $query->fetch_assoc()) {
                        $fullName = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
                        echo "
                            <tr>
                                <td>" . $row['applicant_id'] . "</td>
                                <td>" . $fullName . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['contact_info'] . "</td>
                                <td>" . $row['position'] . "</td>
                                <td><button class='btn btn-success btn-sm view_resume btn-flat' data-id='" . $row['id'] . "'>View Resume</button></td>
                                <td>
                                
                                <div class='btn-group'>
                                <button type='button' class='btn btn-primary'>Action</button>
                                <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <span class='caret'></span>
                                </button>
                                <div class='dropdown-menu'>
                                      <form method='post' action='application_archive.php'>
                                      <input type='hidden' name='id' value='" . $row['id'] . "'>
                                      <input type='hidden' name='applicant_id' value='" . $row['applicant_id'] . "'>
                                      <input type='hidden' name='firstname' value='" . $row['firstname'] . "'>
                                      <input type='hidden' name='middlename' value='" . $row['middlename'] . "'>
                                      <input type='hidden' name='lastname' value='" . $row['lastname'] . "'>
                                      <input type='hidden' name='email' value='" . $row['email'] . "'>
                                      <input type='hidden' name='gender' value='" . $row['gender'] . "'>
                                      <input type='hidden' name='phone' value='" . $row['contact_info'] . "'>
                                      <input type='hidden' name='position' value='" . $row['position'] . "'>
                                      <input type='hidden' name='position_id' value='" . $row['position_id'] . "'>
                                      <input type='hidden' name='street_address' value='" . $row['street_address'] ."'>
                                      <input type='hidden' name='city' value='" . $row['city'] . "'>
                                      <input type='hidden' name='state_province' value='" . $row['state_province'] . "'>
                                      <input type='hidden' name='postal_zip_code' value='" . $row['postal_zip_code'] . "'>
                                      <input type='hidden' name='birthdate' value='" . $row['birthdate'] . "'>
                                      <input type='hidden' name='resume' value='" . $row['resume'] . "'>
                                          <button class='btn btn-info btn-sm btn-flat view drpd-btn' data-id='" . $row['id'] . "'>
                                          <i class='fa fa-eye'></i> View
                                          </button>
                                          <button class='btn btn-primary btn-sm btn-flat retrieve drpd-btn' data-id='" . $row['id'] . "'>
                                          <i class='fa fa-mail-reply'></i> Retrieve
                                          </button>
                                      </form>                                  
                                      
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
  <?php include 'includes/recruitment_modal.php';
   ?>
  
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('.box-body').on('click', '.view_resume', function(e){
    e.preventDefault();
    $('#view_resume').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.box-body').on('click', '.view', function(e) {
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    var position = $(this).data('position');
    getRow(id, position);
  });
  
    $('.box-body').on('click', '.retrieve', function(e) {
    e.preventDefault();
    $('#retrieve').modal('show');
    var id = $(this).data('id');
    var position = $(this).data('position');
    getRow(id, position);
  });

});

function getRow(id, position) {
  console.log('ID passed to getRow function:', id);
  $.ajax({
    type: 'POST',
    url: 'recruitment_archive_row.php',
    data: { id: id },
    dataType: 'json',
    success: function(response) {
      if ('error' in response) {
        console.error(response.error);
      } else {
        
        $('#aid').val(response.id);
        $('.appid').val(response.id);
        $('.aid').val(response.applicant_id);
        $('#aid_view').html(response.applicant_id);
        $('.del_app_name').html(response.firstname+' '+response.lastname);
        $('#app_birthdate').html(response.birthdate);
        $('#app_contact_info').html(response.contact_info);
        $('.app_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#app_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#edit_firstname').val(response.firstname);
        $('#edit_middlename').val(response.middlename);
        $('#edit_lastname').val(response.lastname);
        $('#edit_street_address').val(response.street_address);
        $('#edit_city').val(response.city);
        $('#edit_state_province').val(response.state_province);
        $('#edit_postal_zip_code').val(response.postal_zip_code);
        $('#datepicker_edit').val(response.birthdate);
        $('#edit_email').val(response.email);
        $('#edit_phone').val(response.contact_info);
        $('#edit_gender').val(response.gender);
        $('#edit_position').val(response.position_id);
        $('#edit_schedule').val(response.schedule_id);
        $('#add-ress').val(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code).html(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code);
        $('#email_send').val(response.email);
        $('#email_val').val(response.email).html(response.email);
        $('#gender_val').val(response.gender).html(response.gender);
        $('#pos_ition_val').val(response.position).html(response.position);
        $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);

        var resumePath = '../resume/' + response.resume;
        var resumeImageContainer = $('#resumeImageContainer');

        
        if (response.resume.toLowerCase().endsWith('.pdf')) {
          
          resumeImageContainer.html('<embed src="' + resumePath + '" style="width: 100%; height: 70vh;" type="application/pdf"></embed>');
        }  else {
          console.warn('Unsupported file type:', response.resume);
          return;
        }
      }
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText); 
    }
  });
}

   

</script>
</body>
</html>


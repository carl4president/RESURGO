
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
        Application List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Recruitment</a></li>
        <li class="active">Application List</li>
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
                    <th>Inform</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                <?php
                  
                  $sql = "SELECT a.*, v.position, v.availability FROM application a
                      INNER JOIN vacancy v ON v.id = a.position_id";
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
                                    <form action='accept_applicants.php' method='post'>
                                    <button class='btn btn-success btn-sm send_email btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-envelope-open'></i> Send Email</button>";
                                    if ($row['availability'] <= 0) {
                                        
                                    } else {
                                      echo "<input type='hidden' name='id' value='" . $row['id'] . "'>
                                      <input type='hidden' name='applicant_id' value='" . $row['applicant_id'] . "'>
                                      <input type='hidden' name='firstname' value='" . $row['firstname'] . "'>
                                      <input type='hidden' name='middlename' value='" . $row['middlename'] . "'>
                                      <input type='hidden' name='lastname' value='" . $row['lastname'] . "'>
                                      <input type='hidden' name='email' value='" . $row['email'] . "'>
                                      <input type='hidden' name='gender' value='" . $row['gender'] . "'>
                                      <input type='hidden' name='phone' value='" . $row['contact_info'] . "'>
                                      <input type='hidden' name='position' value='" . $row['position'] . "'>
                                      <input type='hidden' name='position_id' value='" . $row['position_id'] . "'>
                                      <input type='hidden' name='address' value='" . $row['street_address'] . ', ' . $row['city'] . ', ' . $row['state_province'] . ', ' . $row['postal_zip_code'] . "'>
                                      <input type='hidden' name='birthdate' value='" . $row['birthdate'] . "'>
                                      <button class='btn btn-success btn-sm btn-flat receive drpd-btn' type='submit' data-id='" . $row['id'] . "' " . (($row['process_id'] == 1 || $row['process_id'] == 2 || $row['process_id'] == 3) ? 'disabled' : '') . "><i class='fa fa-edit'></i> Receive</button>
                                      <button class='btn btn-success btn-sm btn-flat process drpd-btn' type='submit' data-id='" . $row['id'] . "' " . (($row['process_id'] == 2 || $row['process_id'] == 3) ? 'disabled' : '') . "><i class='fa fa-edit'></i> Process</button>
                                      <button class='btn btn-success btn-sm btn-flat interview drpd-btn'
                                          data-id='" . $row['id'] . "'
                                          data-applicantid='" . $row['applicant_id'] . "'
                                          data-applicantname='" . $fullName . "'
                                          data-position='" . $row['position'] . "'
                                          data-email='" . $row['email'] . "'" . (($row['process_id'] == 3) ? 'disabled' : '') . ">
                                          <i class='fa fa-comments'></i> Interview
                                      </button>
                                      <button class='btn btn-success btn-sm btn-flat accept drpd-btn' type='submit' data-id='" . $row['id'] . "'><i class='fa fa-user-plus'></i> Accept</button>
                                      <button class='btn btn-danger btn-sm btn-flat reject drpd-btn' type='submit' data-id='" . $row['id'] . "'><i class='fa fa-user-times'></i> Reject</button>";
                                    }
                                    echo "
                                    </form>
                                  </div>
                                  </div>
                                </td>
                                <td>
                                
                                <div class='btn-group'>
                                <button type='button' class='btn btn-primary'>Action</button>
                                <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <span class='caret'></span>
                                </button>
                                <div class='dropdown-menu'>
                                    <input type='hidden' value='" . $row['street_address'] . "'>
                                    <input type='hidden' value='" . $row['city'] . "'>
                                    <input type='hidden' value='" . $row['state_province'] . "'>
                                    <input type='hidden' value='" . $row['postal_zip_code'] . "'>
                                    <input type='hidden' value='" . $row['birthdate'] . "'>
                                    <button class='btn btn-info btn-sm view btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-eye'></i> View</button>
                                    <button class='btn btn-success btn-sm edit btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>";
                                   if ($row['availability'] > 0) { 
                                    } else {
                                      echo "
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
                                          <button class='btn btn-danger btn-sm btn-flat drpd-btn' type='submit' name='delete'>
                                              <i class='fa fa-trash'></i> Archive
                                          </button>
                                      </form>                                  
                                      ";
                                  }
                                  echo "
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
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    $('#aid').val(id); 
    getRow(id);
  });

  $('.view_resume').click(function(e){
    e.preventDefault();
    $('#view_resume').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });

    $('.receive').click(function (e) {
    e.preventDefault();
    $('#receive').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });

    $('.process').click(function (e) {
    e.preventDefault();
    $('#process').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });

    $('.send_email').click(function (e) {
    e.preventDefault();
    $('#send_email').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });

    $('.reject').click(function (e) {
    e.preventDefault();
    $('#reject').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });

    $('.accept').click(function (e) {
    e.preventDefault();
    $('#accept').modal('show');
    var id = $(this).data('id');
    getRow(id);
    });


    $('.interview').click(function(e) {
      e.preventDefault();
      $('#interviewModal').modal('show');
      var id = $(this).data('id');
      var applicantid = $(this).data('applicantid');
      var applicantName = $(this).data('applicantname');
      var position = $(this).data('position');
      var email = $(this).data('email');
      $('#applicantName').text(applicantName);
      $('#interviewPosition').text(position);


     $('#applicationId').val(id);
    $('#applicantNameInput').val(applicantName);
    $('#applicantIdInput').val(applicantid);
    $('#interviewPositionInput').val(position);
    $('#interviewApplicant_idInput').val(id);
    $('#interviewEmail').val(email);
    });

    $('.view').click(function(e){
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    var position = $(this).data('position');
    getRow(id, position);
    });


});

function getRow(id, position) {
  console.log('ID passed to getRow function:', id);
  $.ajax({
    type: 'POST',
    url: 'recruitment_row.php',
    data: { id: id },
    dataType: 'json',
    success: function(response) {
      if ('error' in response) {
        console.error(response.error);
      } else {
        
        $('#aid').val(response.id);
        $('.aid').val(response.applicant_id);
        $('#aid_view').html(response.applicant_id);
        $('.del_app_name').html(response.firstname+' '+response.lastname);
        $('#app_birthdate').html(response.birthdate);
        $('#app_contact_info').html(response.contact_info);
        $('#app_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#edit_firstname').val(response.firstname);
        $('#edit_middlename').val(response.middlename);
        $('#edit_lastname').val(response.lastname);
        $('#edit_street_address').val(response.street_address);
        $('#edit_city').val(response.city);
        $('#edit_state_province').val(response.state_province);
        $('#edit_postal_zip_code').val(response.postal_zip_code);
        $('#datepicker_edit_birthdate').val(response.birthdate);
        $('#edit_email').val(response.email);
        $('#edit_phone').val(response.contact_info);
        $('#edit_gender').val(response.gender);
        $('#edit_position').val(response.position_id);
        $('#edit_schedule').val(response.schedule_id);
        $('#add-ress').val(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code).html(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code);
        $('#email_send_text').html(response.email);
        $('#email_send').val(response.email);
        $('#email_val').val(response.email).html(response.email);
        $('#gender_val').val(response.gender).html(response.gender);
        $('#pos_ition_val').val(response.position).html(response.position);
        $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
        $('#receive_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#process_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#reject_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#accept_name').html(response.firstname+' '+response.middlename+' '+response.lastname);
        $('#receive_aid').val(response.id);
        $('#receive_fname').val(response.firstname);
        $('#receive_mname').val(response.middlename);
        $('#receive_lname').val(response.lastname);
        $('#receive_email').val(response.email);
        $('#receive_position').val(response.position);
        $('#process_aid').val(response.id);
        $('#process_fname').val(response.firstname);
        $('#process_mname').val(response.middlename);
        $('#process_lname').val(response.lastname);
        $('#process_email').val(response.email);
        $('#process_position').val(response.position);
        $('#reject_aid').val(response.id);
        $('#reject_fname').val(response.firstname);
        $('#reject_mname').val(response.middlename);
        $('#reject_lname').val(response.lastname);
        $('#reject_email').val(response.email);
        $('#reject_position').val(response.position);
        $('#accep_aid').val(response.id);
        $('#accep_fname').val(response.firstname);
        $('#accep_mname').val(response.middlename);
        $('#accep_lname').val(response.lastname);
        $('#accep_email').val(response.email);
        $('#accep_position').val(response.position);
        $('#accep_address').val(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code).html(response.street_address+' '+response.city+' '+response.state_province+' '+response.postal_zip_code);
        $('#accep_birthdate').val(response.birthdate);
        $('#accep_gender').val(response.gender);
        $('#accep_contact').val(response.contact_info);
        $('#accep_position_id').val(response.position_id);

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


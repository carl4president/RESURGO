
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
        Interviewee List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Recruitment</a></li>
        <li class="active">Interviewee List</li>
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
                    <th>Position</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                <?php
                  
                  $sql = "SELECT * FROM interview_details INNER JOIN application ON application.applicant_id = interview_details.applicant_id";
                  $query = $conn->query($sql);

                    while ($row = $query->fetch_assoc()) {
                        $fullName = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
                        echo "
                            <tr>
                                <td>" . $row['applicant_id'] . "</td>
                                <td>" . $fullName . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['position'] . "</td>
                                <td>" . $row['date'] . "</td>
                                <td>" . $row['time'] . "</td>
                                <td>" . $row['location'] . "</td>
                                <td>
                                <div class='btn-group'>
                                <button type='button' class='btn btn-primary'>Action</button>
                                <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <span class='caret'></span>
                                </button>
                                <div class='dropdown-menu'>
                                    <button class='btn btn-success btn-sm edit_interview btn-flat drpd-btn' data-id='" . $row['id'] . "'
                                    data-applicationid='" . $row['application_id'] . "'
                                    data-applicantid='" . $row['applicant_id'] . "'
                                    data-applicantname='" . $fullName . "'
                                    data-email='" . $row['email'] . "'
                                    data-position='" . $row['position'] . "'
                                    data-date='" . $row['date'] . "'
                                    data-time='" . $row['time'] . "'
                                    data-location='" . $row['location'] . "'><i class='fa fa-edit'></i> Edit</button>
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
  <?php include 'includes/interview_modal.php';
   ?>
  
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
  $('.box-body').on('click', '.edit_interview', function(e) {
    e.preventDefault();
    $('#interviewModal').modal('show');
      var id = $(this).data('id');
      var applicationid = $(this).data('applicationid');
      var position = $(this).data('position');
      var email = $(this).data('email');
      var date = $(this).data('date');
      var time = $(this).data('time');
      var location = $(this).data('location');
      $('#applicantName').text(applicantName);
      $('#interviewPosition').text(position);

      $('#aid').val(id);
    $('#applicantNameInput').val(applicantName);
    $('#applicantId').val(applicationid);
    $('#interviewPositionInput').val(position);
    $('#interviewApplicant_idInput').val(id);
    $('#interviewEmail').val(email);
    $('#interviewDate').val(date);
    $('#interviewTime').val(time);
    $('#interviewLocation').val(location);
    });


</script>
</body>
</html>


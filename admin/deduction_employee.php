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
        Employee Deductions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Deductions</li>
        <li class="active">Employee Deductions</li>
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
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Deduction</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Effective Date</th>
                  <th>Tools</th>

                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employee_deductions.id AS edid
                    FROM employee_deductions
                    LEFT JOIN deductions ON deductions.id = employee_deductions.deduction_id
                    LEFT JOIN employees ON employees.employee_id = employee_deductions.employee_id";
                   $query = $conn->query($sql);
                   while ($row = $query->fetch_assoc()) {
                    $typeMapping = [
                        1 => 'Monthly',
                        2 => 'Semi-Monthly',
                        3 => 'Once',
                    ];
                
                    $type = isset($typeMapping[$row['type']]) ? $typeMapping[$row['type']] : 'Unknown';
                
                    echo "
                        <tr>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['deduction']."</td>
                          <td>" . $type . "</td>
                          <td>".number_format($row['amount'], 2)."</td>
                          <td>".$row['effective_date']."</td>
                          <td>
                          <div class='btn-group'>
                          <button type='button' class='btn btn-primary'>Action</button>
                          <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <span class='caret'></span>
                          </button>
                          <div class='dropdown-menu'>
                            <button class='btn btn-success btn-sm edit btn-flat drpd-btn' data-id='".$row['edid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat drpd-btn' data-id='".$row['edid']."'><i class='fa fa-trash'></i> Delete</button>
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
  <?php include 'includes/deduction_employee_modal.php'; ?>
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


$(document).ready(function() {
    function handleEffectiveDateGroupVisibility() {
        var selectedValue = $('#edit_type').val();
        if (selectedValue == 3) {
            $('#edit_effectiveDateGroup').show();
        } else {
            $('#edit_effectiveDateGroup').hide();
        }
    }
    handleEffectiveDateGroupVisibility();
    $('#edit_type').change(handleEffectiveDateGroupVisibility);
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'deduction_employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.deducid').val(response.empid);
      $('#edit_empid').val(response.employee_id);
       $('#edit_deduction').val(response.deduction_id);
      $('#edit_type').val(response.type);
      $('#edit_amount').val(response.amounts);
      $('#edit_date').val(response.effective_date);
      $('#del_deduction').html(response.deduction);
      $('#del_empid').html(response.employee_id);
      $('#del_empname').html(response.firstname+' '+response.middlename+' '+response.lastname);
      

      if (response.type == 3) {
        $('#edit_effectiveDateGroup').show();
      } else {
        $('#edit_effectiveDateGroup').hide();
      }
    }
  });
}
</script>
</body>
</html>

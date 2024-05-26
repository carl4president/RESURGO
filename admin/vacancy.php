
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
       Vacancy List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Recruitment</a></li>
        <li class="active">Vacancy List</li>
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
                    <th>#</th>
                    <th>Vacancy Information</th>
                    <th>Availability</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                <?php 
                    $i = 1;
                    $plan = $conn->query("SELECT * FROM vacancy order by id asc");
                    while($row = $plan->fetch_assoc()):
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $dets = strtr(html_entity_decode($row['details']), $trans);
                        $dets = str_replace(array("<li>", "</li>"), array("", ","), $dets);
                        $desc = strtr(html_entity_decode($row['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
                    
                        echo "
                        <tr>
                            <td class='text-center'>$i</td>
                            <td class='col-sm-7'>
                                <p>Position : <b> ".$row['position'] ."</b></p>
                                <p class='truncate'><span>Job Details : </span><i><small>" . strip_tags($dets) . "</small></i></p>
                                <p class='truncate'><span>Job Description : </span><i><small>" . strip_tags($desc) . "</small></i></p>
                            </td>
                            <td class='text-center'>{$row['availability']}</td>
                            <td>
                                <img src='".(!empty($row['banner']) ? '../images/'.$row['banner'] : '../images/profile.jpg')."' width='30px' height='30px'>
                                <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['id']."'><span class='fa fa-edit'></span></a>
                            </td>

                            <td class='text-center'>";
                            
                        if ($row['status'] == 1) {
                            echo "<span class='badge badge-success' style='color: #fff; background-color: #28a745;'>Active</span>";
                        } else {
                            echo "<span class='badge badge-danger' style='color: #fff; background-color: #dc3545;'>Closed</span>";
                        }

                        echo "</td>
                        <td>
                        <div class='btn-group'>
                        <button type='button' class='btn btn-primary'>Action</button>
                        <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          <span class='caret'></span>
                        </button>
                        <div class='dropdown-menu'>
                            <button class='btn btn-info btn-sm view btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-eye'></i> View</button>
                            <button class='btn btn-success btn-sm edit btn-flat drpd-btn' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat drpd-btn' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                          </div>
                          </div>
                          </td>
                        </tr>
                        ";
                        
                        $i++;
                    endwhile; 
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
  <?php include 'includes/vacancy_modal.php';
   ?>
  
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

  $('.box-body').on('click', '.view', function(e){
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.box-body').on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.box-body').on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });
});

function html_entity_decode(encodedString) {
    var parser = new DOMParser();
    var doc = parser.parseFromString('<!doctype html><body>' + encodedString, 'text/html');
    return doc.body.textContent;
}

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'vacancy_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log('Server Response:', response);
      $('.vacaid').val(response.id);
      $('#vacid').val(response.id);
      $('#edit_vac').closest('.jqte').find('.jqte_editor').html(response.description);
      $('#edit_vac_details').closest('.jqte').find('.jqte_editor').html(response.details);
      $('#edit_availability').val(response.availability);
      $('#edit_position').val(response.position);
      $('#photo_vacancy').val(response.banner);
      $('#edit_status').find('option[value="' + response.status + '"]').prop('selected', true);
      $('#vac_val').html(response.description);
      $('#vac_details_val').html(response.details);
      $('#val_availability').val(response.availability).html(response.availability);
      $('#val_position').val(response.position).html(response.position);
      $('#del_vacid').val(response.id);
      $('#del_vacancy_position').val(response.position).html(response.position);
    }
  });
}


</script>
</body>
</html>


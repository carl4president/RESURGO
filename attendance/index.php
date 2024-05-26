<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page" style="background: url(../img/bg.jpg) no-repeat center center fixed; background-size: cover;">
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-6">
            <!-- Login Box -->
            <div class="login-box">
              	<div class="login-logo" style="background-color: white; opacity: 0.7;">
              		<p id="date"></p>
                  <p id="time" class="bold"></p>
              	</div>
              
              	<div class="login-box-body">
                	<h4 class="login-box-msg">SELECT STATUS OF ATTENDANCE</h4>
                <form id="attendance" method="POST">
            	   <div class="form-group">
                    <select class="form-control" name="status" id="status">
                      <option value="in_am">Time In (AM)</option>
                      <option value="out_am">Time Out (AM)</option>
                      <option value="in_pm">Time In (PM)</option>
                      <option value="out_pm">Time Out (PM)</option>
                    </select>
                  </div>
                    <div class="form-group has-feedback">
                		<video id="preview" width="100%"></video>
              		</div>
              		<div class="form-group has-feedback">
                		<input type="hidden" class="form-control input-lg" id="employee" name="employee" required>
              		</div>
              		<div class="row">
                    <div class="col-xs-offset-1">
                  			<span style="font-size: 13px;">Finish Attendance? <a href="../employee_portal/index.php"> Login Now! </a></span>
                		</div>
              		</div>
            	</form>
                </div>
                <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
                </div>
            		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
        </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Table for Attendance Records -->
            <div class="panel panel-default">
                <div class="panel-heading">Today's Attendance Records</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Time In (AM)</th>
                                <th>Time Out (AM)</th>
                                <th>Time In (PM)</th>
                                <th>Time Out (PM)</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                    include 'conn.php';
                                    
                                    $now = date('Y-m-d');
                                    $sql = "SELECT attendance.*, employees.firstname, employees.lastname 
                                            FROM attendance 
                                            INNER JOIN employees ON attendance.employee_id = employees.employee_id 
                                            WHERE attendance.date = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $now);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    $attendanceData = [];
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $row['firstname'] = formatFirstName($row['firstname']);
                                            $attendanceData[] = $row;
                                        }
                                    }
                                    
                                    $stmt->close();
                                    $conn->close();
                                    
                                    function formatFirstName($firstname) {
                                        $parts = explode(' ', $firstname);
                                        $formattedFirstName = '';
                                        foreach ($parts as $index => $part) {
                                            if ($index === 0) {
                                                $formattedFirstName .= substr($part, 0, 1) . '.';
                                            } else {
                                                $formattedFirstName .= ' ' . substr($part, 0, 1) . '.';
                                            }
                                        }
                                        return $formattedFirstName;
                                    }
                                    
                                    foreach ($attendanceData as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $row['employee_id'] . "</td>";
                                        echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['time_in_AM'] . "</td>";
                                        echo "<td>" . $row['time_out_AM'] . "</td>";
                                        echo "<td>" . $row['time_in_PM'] . "</td>";
                                        echo "<td>" . $row['time_out_PM'] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </tbody>
                    </table>
  	      </div>
  		
</div>
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
  Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        alert("No cameras found");
    }
  }).catch(function(e) {
    console.error(e);
  });

  
  function submitForm(data) {
  var attendance = data.serialize();
    $.ajax({
      type: 'POST',
      url: '../employee_portal/attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
          
          setTimeout(function() {
            location.reload();
        }, 2000);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }
  

    
  $('#attendance').submit(function(e){
    e.preventDefault();
    submitForm($(this));
  });

  
  scanner.addListener('scan', function(c) {
    document.getElementById('employee').value = c;
    submitForm($('#attendance')); 
  });

  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
    
}, 100);

 var currentHour = moment().hour();
$('#status option').remove(); 

if (currentHour < 11) {
    $('#status').append('<option value="in_am">Time In (AM)</option>');
} else if (currentHour >= 11 && currentHour < 12) {
    if (!$('#status option[value="out_am"]').length) { 
        $('#status').append('<option value="out_am">Time Out (AM)</option>');
    }
} else if (currentHour >= 12 && currentHour < 13.5) {
    $('#status').append('<option value="out_am">Time Out (AM)</option>');
    $('#status').append('<option value="in_pm">Time In (PM)</option>');
} else if (currentHour >= 13.5 && currentHour < 16) {
    $('#status option[value="out_am"]').remove();
    if (!$('#status option[value="in_pm"]').length) { 
        $('#status').append('<option value="in_pm">Time In (PM)</option>');
    }
} else if (currentHour >= 16) {
    if (!$('#status option[value="out_pm"]').length) { 
        $('#status').append('<option value="out_pm">Time Out (PM)</option>');
    }
}



});
</script>
</body>
</html>
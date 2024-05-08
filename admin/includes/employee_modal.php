<!-- Add -->
<div class="modal fade" id="addnew" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname" required oninput="validateNameInput(this)">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="middlename" class="col-sm-3 control-label">Middlename</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="middlename" name="middlename" required oninput="validateNameInput(this)">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" required oninput="validateNameInput(this)">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="address" class="col-sm-3 control-label">Address</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="datepicker_add_birthdate" class="col-sm-3 control-label">Birthdate</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add_birthdate" name="birthdate">
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact" oninput="validateContactInput(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="" selected>- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="position" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM vacancy";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['position']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="schedule" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_edit.php">
            		<input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname" required oninput="validateNameInput(this)">
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_middlename" class="col-sm-3 control-label">Middlename</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_middlename" name="middlename" required oninput="validateNameInput(this)">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname" required oninput="validateNameInput(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="edit_address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit_birthdate" class="col-sm-3 control-label">Birthdate</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit_birthdate" name="birthdate">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact" oninput="validateContactInput(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_val" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                    <input type="email" class="form-control"" name="email" id="email_val">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_gender" class="col-sm-3 control-label">Gender</label>
                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="edit_gender">
                      <option value="" selected>- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Position</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="position" id="edit_position" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM vacancy";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['position']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_schedule" name="schedule">
                      <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employees_archive.php">
              <input type="hidden" class="empid" name="id">
              <input type="hidden" id="del_employee_id" name="employee_id">
              <input type="hidden" id="del_firstname" name="firstname">
              <input type="hidden" id="del_middlename" name="middlename">
              <input type="hidden" id="del_lastname" name="lastname">
              <input type="hidden" id="del_address" name="address">
              <input type="hidden" id="del_birthdate" name="birthdate">
              <input type="hidden" id="del_contact" name="phone">
              <input type="hidden" id="del_gender" name="gender">
              <input type="hidden" id="del_email" name="email">
              <input type="hidden" id="del_position_id" name="position_id">
              <input type="hidden" id="del_schedule_id" name="schedule_id">
              <input type="hidden" id="del_photo" name="photo">
              <input type="hidden" id="del_hire_date" name="hire_date">
              <input type="hidden" id="del_username" name="username">
              <input type="hidden" id="del_password" name="password">

            		<div class="text-center">
	                	<p>ARCHIVED EMPLOYEE</p>
	                	<h2 class="bold del_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Archived</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="view" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Employee Details</span></b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <img id="photo_val" alt="Employee Photo" height="100px" width="100px" class="img-circle">
              </div>
              <div class="form-group">
            <h4>Employee ID :<b> <span class="employee_id"></span></b></h4>
		        <h4>Name : <b> <span id="employee_name"></span></b></h4>
            <h4>Address : <b> <span id="address_val"></span></b></h4>
            <h4>Date of Birth : <b> <span id="birthdate_val"></span></b></h4>
            <h4>Contact : <b> <span id="contact_val"></span></b></h4>
            <h4>Gender : <b> <span id="gender_val"></span></b></h4>
            <h4>Email : <b> <span id="email_view"></span></b></h4>
		        <h4>Position :<b> <span id="position_value"></span></b></h4>
            <h4>Schedule : <b> <span id="schedule_val"></span></b></h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script>

        function validateContactInput(inputElement) {
                const inputValue = inputElement.value;
                const numericValue = inputValue.replace(/[^0-9]/g, "");
                inputElement.value = numericValue;
            }


            function validateNameInput(inputElement) {
                const inputValue = inputElement.value;
                const alphabeticValue = inputValue.replace(/[^a-zA-Z\s]+/g, "");
                inputElement.value = alphabeticValue;
            }

        
                function validateForm() {
                const requiredFields = ["firstname", "middlename", "lastname", "street_address", "datepicker_add_birthdate", "city", "state_province", "postal_zip_code", "email", "contact", "formFile"];
                
                for (const field of requiredFields) {
                    const fieldValue = document.getElementById(field).value.trim();
                    if (fieldValue === "") {
                    alert("All data are required to fill up.");
                    return false;
                    }

                    if (field === "contact") {
                    if (fieldValue.length !== 11) {
                        alert("Phone number must be exactly 11 digits long. Please try again.");
                        return false;
                    }

                    
                    if (!fieldValue.startsWith("09")) {
                        alert("Phone number must start with '0' and followed by'9'. Please try again.");
                        return false;
                    }
                    }

                    if (["firstname", "middlename", "lastname"].includes(field) && fieldValue.length < 2) {
                    alert(`${field.charAt(0).toUpperCase() + field.slice(1)} must be at least 2 characters long. Please try again.`);
                    return false;
                    }
                }

                return true;
                }
</script>

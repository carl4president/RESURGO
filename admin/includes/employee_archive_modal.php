<!-- Delete -->
<div class="modal fade" id="retrieve" data-backdrop="static">
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
              <input type="hidden" id="ret_employee_id" name="employee_id">
              <input type="hidden" id="ret_firstname" name="firstname">
              <input type="hidden" id="ret_middlename" name="middlename">
              <input type="hidden" id="ret_lastname" name="lastname">
              <input type="hidden" id="ret_address" name="address">
              <input type="hidden" id="ret_birthdate" name="birthdate">
              <input type="hidden" id="ret_contact" name="phone">
              <input type="hidden" id="ret_gender" name="gender">
              <input type="hidden" id="ret_email" name="email">
              <input type="hidden" id="ret_position_id" name="position_id">
              <input type="hidden" id="ret_schedule_id" name="schedule_id">
              <input type="hidden" id="ret_photo" name="photo">
              <input type="hidden" id="ret_hire_date" name="hire_date">
              <input type="hidden" id="ret_username" name="username">
              <input type="hidden" id="ret_password" name="password">

            		<div class="text-center">
	                	<p>RETRIEVE EMPLOYEE</p>
	                	<h2 class="bold ret_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="retrieve"><i class="fa fa-mail-reply"></i> Retrieve</button>
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
              <h4 class="modal-title"><b><span class="ret_employee_name"></span></b></h4>
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
<!-- Add -->
<div class="modal fade" id="addnew" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Applicant</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="application_add.php" enctype="multipart/form-data" onsubmit="return validateForm()">
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname" required oninput="validateNameInput(this)" >
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
                  	<label for="street_address" class="col-sm-3 control-label">Street</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="street_address" id="street_address"></input>
                  	</div>

                    <label for="city" class="col-sm-1 control-label">City</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="city" id="city"></input>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="state_province" class="col-sm-3 control-label">State/Province</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="state_province" id="state_province"></input>
                  	</div>

                    <label for="postal_zip_code" class="col-sm-3 control-label">Postal/Zip Code</label>

                  	<div class="col-sm-2">
                      <input type="text" class="form-control" name="postal_zip_code" id="postal_zip_code" oninput="validateContactInput(this)"></input>
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
                    <label for="email" class="col-sm-3 control-label">Email</label>

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
                    <label for="photo" class="col-sm-3 control-label">Resume</label>

                    <div class="col-sm-9">
                       <input class="form-control" type="file" id="formFile" name="resume">
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

<div class="modal fade" id="edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Application</b></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="POST" action="applicant_edit.php">
            <input type="hidden" id="aid" name="id">
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
                  	<label for="edit_street_address" class="col-sm-3 control-label">Street</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="street_address" id="edit_street_address"></input>
                  	</div>

                    <label for="edit_city" class="col-sm-1 control-label">City</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="city" id="edit_city"></input>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_state_province" class="col-sm-3 control-label">State/Province</label>

                  	<div class="col-sm-4">
                      <input type="text" class="form-control" name="state_province" id="edit_state_province"></input>
                  	</div>

                    <label for="edit_postal_zip_code" class="col-sm-3 control-label">Postal/Zip Code</label>

                  	<div class="col-sm-2">
                      <input type="text" class="form-control" name="postal_zip_code" id="edit_postal_zip_code"></input>
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
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_phone" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_phone" name="contact" oninput="validateContactInput(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label">Gender</label>
                      
                    <div class="col-sm-9">
                      <select name="gender" id="edit_gender" class="form-control">
                          <option value="Male" <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Male</option>
                          <option value="Female" <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Female</option>
                      </select>
                  </div>

                </div>
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Position</label>

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
          	</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                 </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="view_resume" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>View Resume</b></h4>
            </div>
            <div class="modal-body">
                <div class="form-group" id="resumeContent" style="position: relative; overflow: hidden;">
                    <div id="resumeImageContainer"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>View Applicant</b></h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
                  <h4>Applied for : <b><span id="pos_ition_val"></span></b></h4>
                  <h4>Applicant ID : <b><span id="aid_view"></span></b></h4>
                  <h4>Name : <b><span id="app_name"></span></b></h4>
                  <h4>Gender : <b><span id="gender_val"></span></b></h4>
                  <h4>Address : <b><span id="add-ress"></span></b></h4>
                  <h4>Date of Birth : <b><span id="app_birthdate"></span></b></h4>
                  <h4>Contact : <b><span id="app_contact_info"></span></b></h4>
                  <h4>Email : <b><span id="email_val"></span></b></h4>
                  

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="send_email" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Send Email</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="accept_applicants.php">
            		
                <div class="form-group">
                    <label for="email_send" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9">
                        <h5 id="email_send_text"></h5>
                      <input type="hidden" class="form-control" id="email_send" name="email">
                    </div>
                </div>
				        <div class="form-group">
                    <label for="subject" class="col-sm-3 control-label">Subject</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Message</label>

                    <div class="col-sm-12">
			                  	<textarea id="message" name="message" class="text-jqte"></textarea>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="send_email"><i class="fa fa-check-square-o"></i> Send</button>
            	</form>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="receive" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Send Receive Email Confirmation</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="accept_applicants.php">
            		
            <input type="hidden" id="receive_aid" name="id">
            <input type="hidden" id="receive_fname" name="firstname">
            <input type="hidden" id="receive_mname" name="middlename">
            <input type="hidden" id="receive_lname" name="lastname">
            <input type="hidden" id="receive_email" name="email">
            <input type="hidden" id="receive_position" name="position">
            		<div class="text-center">
	                	
                        <h3>Are you sure you want to send <br> Receive Email to <b><span id="receive_name"></span></b>?</h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="receive"><i class="fa fa-check-square-o"></i> Send</button>
            	</form>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="process" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Send Processing Email Confirmation</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="accept_applicants.php">
            		
            <input type="hidden" id="process_aid" name="id">
            <input type="hidden" id="process_fname" name="firstname">
            <input type="hidden" id="process_mname" name="middlename">
            <input type="hidden" id="process_lname" name="lastname">
            <input type="hidden" id="process_email" name="email">
            <input type="hidden" id="process_position" name="position">
            		<div class="text-center">
	                	
                        <h3>Are you sure you want to send <br> Processing Email to <b><span id="process_name"></span></b>?</h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="process"><i class="fa fa-check-square-o"></i> Send</button>
            	</form>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="interviewModal" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel" aria-hidden="true" data-backdrop="static"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewModalLabel">Interview Invitation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action='accept_applicants.php' method='post'>
                    <p>Dear <span id="applicantName" name="applicantname"></span>,</p>
                    <p>Congratulations! Your application for the position of <span id="interviewPosition" name="position"></span> has been shortlisted for an interview.</p>
                    <p>Interview details:</p>
                        <input type="hidden" id="applicantIdInput" name="applicantid">
                        <input type="hidden" id="applicantNameInput" name="applicantname">
                        <input type="hidden" id="interviewPositionInput" name="position">
                        <input type="hidden" id="interviewEmail" name="email">
                        <input type="hidden" id="applicationId" name="id">
                        <div class="form-group">
                            <label for="datepicker_add" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                              <div class="date">
                                  <input type="text" class="form-control" id="datepicker_add" name="interview_date" required>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interview_time" class="col-sm-2 control-label">Time</label>
                            <div class="col-sm-10">
                                <div class="bootstrap-timepicker">
                                  <input type="text" class="form-control timepicker" id="interview_time" name="interview_time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interview_location" class="col-sm-2 control-label">Location:</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control"id="interview_location" name="interview_location">
                              </div>
                        </div>
                    <p>Please be prepared, and feel free to contact Carl John Yasay through Facebook for any further details.</p>
                    <p>Best regards,<br>OLSHCO</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class='btn btn-success btn-sm btn-flat' type='submit' name='interview'><i class="fa fa-check-square-o"></i></i> Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="accept" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Send Acceptance Email Confirmation</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="accept_applicants.php">
            		
            <input type="hidden" id="accep_aid" name="id">
            <input type="hidden" id="accep_fname" name="firstname">
            <input type="hidden" id="accep_mname" name="middlename">
            <input type="hidden" id="accep_lname" name="lastname">
            <input type="hidden" id="accep_email" name="email">
            <input type="hidden" id="accep_position" name="position">
            <input type="hidden" id="accep_address" name="address">
            <input type="hidden" id="accep_birthdate" name="birthdate">
            <input type="hidden" id="accep_gender" name="gender">
            <input type="hidden" id="accep_contact" name="contact">
            <input type="hidden" id="accep_position_id" name="position_id">
            		<div class="text-center">
                    <h3>Are you sure you want to send <br> Acceptance Email to <b><span id="accept_name"></span></b>?</h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="accept"><i class="fa fa-check-square-o"></i> Send</button>
            	</form>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reject" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Send Rejection Email Confirmation</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="accept_applicants.php">
            		
            <input type="hidden" id="reject_aid" name="id">
            <input type="hidden" id="reject_fname" name="firstname">
            <input type="hidden" id="reject_mname" name="middlename">
            <input type="hidden" id="reject_lname" name="lastname">
            <input type="hidden" id="reject_email" name="email">
            <input type="hidden" id="reject_position" name="position">
            		<div class="text-center">
                    <h3>Are you sure you want to send <br> Rejection Email to <b><span id="reject_name"></span></b>?</h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="reject"><i class="fa fa-check-square-o"></i> Send</button>
            	</form>
              </div>
        </div>
    </div>
</div>



<script>
  const formFileInput = document.getElementById("formFile");

  formFileInput.addEventListener("change", function () {
    const allowedExtension = "pdf";
    const fileName = this.value.toLowerCase();

    if (!fileName.endsWith("." + allowedExtension)) {
        alert("Please select a valid PDF file.");
        this.value = ""; // Clear the input field
    }
});
</script>

<script>
$(document).ready(function() {
    $('#datepicker_add').keydown(function(event) {
        event.preventDefault(); 
    });
    
    $('#datepicker_add_birthdate').keydown(function(event) {
        event.preventDefault(); 
    });
    
    $('#datepicker_edit_birthdate').keydown(function(event) {
        event.preventDefault(); 
    });
    
    $('#datepicker_add').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: '0d' 
    });
    
    
	$('.text-jqte').jqte();


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

                    // Check if the phone number starts with "09"
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
});

</script>

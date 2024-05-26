<style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    display: inline-block;
    padding: 5px 10px;
    cursor: pointer;
    background-color: #800;
    color: white;
    border: 1px solid #800;
    border-radius: 4px;
    font-size: 14px;
    text-align: center;
    transition: background-color 0.3s, border-color 0.3s;
}

.custom-file-upload:hover {
    background-color: #590000;
    border-color: #590000;
}
#file-name-profile {
    display: inline-block;
    margin-top: 10px;
    margin-left: 5px;
    font-size: 14px;
    color: #333;
}
</style>
<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Admin Profile</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="username" class="col-sm-3 control-label">Username</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                    </div>
                </div>
                <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo:</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" onchange="checkFile()">
                        <label for="photo" class="custom-file-upload">
                            Choose File
                        </label>
                        <span id="file-name-profile">No file chosen</span>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_password" class="col-sm-3 control-label">Current Password:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

    <script>
    function checkFile() {
        var fileInput = document.getElementById('photo');
        var fileNameSpan = document.getElementById('file-name-profile');

        if (fileInput.files && fileInput.files.length > 0) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            var fileName = fileInput.files[0].name;

            if (!allowedExtensions.exec(fileName)) {
                alert('Please upload an image file with extension .jpg, .jpeg, or .png.');
                fileInput.value = '';
                fileNameSpan.textContent = 'No file chosen';
                return false;
            } else {
                fileNameSpan.textContent = fileName;
            }
        } else {
            fileNameSpan.textContent = 'No file chosen';
        }
    }
</script>


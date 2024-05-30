<?php
include 'attendance/conn.php';
?>

<?php

if(isset($_GET['id'])) {
    
    $decodedId = $_GET['id'];
    for ($i = 0; $i < 10; $i++) {
        $decodedId = base64_decode($decodedId);
    }
    
    
    $qry = $conn->query("SELECT * FROM vacancy WHERE id=".$decodedId)->fetch_array();

    if ($qry) {
        $position = $qry['position']; 
        
    } else {
        echo "Error fetching data from the database.";
    }
} else {
    echo "ID parameter is missing.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Lady of the Sacred Heart College of Guimba, Inc.</title>
    
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="style/home_style.css">
    <link rel="icon" href="img/logo.png" type="image/icon type">
</head>
    <section id="header">
            <a href="index.php"><img src="img/logo.png" class= "logo" alt=""></a>
            <div class="center-title">
                <h3>Application Data Entry</h3>
                <p>Add a new Applicant</p>
            </div>
            <div class="help-policy">
                <ul>
                    <li><a href="application_portal/vacancy/index.php">VIEW VACANCY</a></li>
                </ul>
            </div>
    </section>
    <section id="online-application-form" class="section-p1">
        <div class="online-application-form-content">
        <h2>Job Application</h2>
        <p>Please complete the form below to apply for a position with us.</p>
        <form id="applicationForm" autocomplete="off">
        <div class="input">
            <ul>
            <li id="full-name">
            <h4>Full Name <span>*</span></h4>
                <div>
                    <input type="text" class="first_name" id="first_name" name="first_name" required 
                           pattern="[a-zA-Z\s]{2,}" title="First name must contain at least 2 characters and only letters">
                    <label for="first_name">First Name</label>
                </div>
                <div class="middle-box">
                    <input type="text" class="middle_name" name="middle_name" id="middle_name" 
                           pattern="[a-zA-Z\s]{2,}" title="Middle name must contain at least 2 characters and only letters">
                    <label for="middle_name">Middle Name</label>
                </div>
                <div>
                    <input type="text" class="last_name" name="last_name" id="last_name" required 
                           pattern="[a-zA-Z\s]{2,}" title="Last name must contain at least 2 characters and only letters">
                    <label for="last_name">Last Name</label>
                </div>

            </li>
            <li id="gender">
            <h4>Sex<span>*</span></h4>
                    <div class="position-select">
                    <select class="form-select" name="gender" id="gender">
                            <option <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Male</option>
                        <option <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Female</option>
                    </select>
                    </div>
            </li>
            <li id="address">
            <h4>Current Address <span>*</span></h4>
                <div class="address">
                    <input type="text" class="street" id="street" name="street" required>
                    <label for="street">Street Address <span>*</span></label>
                    <div class="address-row">
                        <div>
                            <input type="text" class="city" id="city" name="city" required>
                            <label for="city">City <span>*</span></label>
                        </div>
                        <div class="middle-box">
                            <input type="text" class="state_province" id="state_province" name="state_province" required>
                            <label for="state_province">State / Province <span>*</span></label>
                        </div>
                        <div>
                            <input type="text" class="postal_zip_code" id="postal_zip_code" name="postal_zip_code" oninput="validateContactInput(this)">
                            <label for="postal_zip_code">Postal / Zip Code <span>*</span></label>
                        </div>
                    </div>
                </div>
               </li>
               <li id="birthday">
               <h4>Date of Birth <span>*</span></h4>
                    <div class="birthday-input">
                    <input type="date" name="birthdate" id="birthdate" name="birthdate">
                    </div>
                
                </li>
                <li id="email-address">
                <h4>Email <span>*</span></h4>
                    <div class="email-input">
                        <input type="email" name="email" id="email" placeholder="ex:name@gmail.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address (e.g., name@gmail.com)">
                    </div>

                 </li>
                 <li id="phone-num">
                    <h4>Contact Number <span>*</span></h4>
                    <div class="phone-input">
                        <input type="tel" class="phone" id="phone" name="phone" inputmode="numeric" minlength="11" maxlength="11" required 
                           pattern="0[0-9]{10}" title="Phone number must be exactly 11 digits long and start with 0 (e.g., 09123456789)"
                           oninput="validateContactInput(this)">

                        <label for="phone">Phone Number</label>
                    </div>
                </li>
                <li id="select-position">
                <h4>Position for Applying <span>*</span></h4>
                <div class="position-select">
                    <input type="hidden" name="position_id" value="<?php echo $decodedId; ?>">
                    <input type="text" value="<?php echo htmlspecialchars($position); ?>" readonly>
                </div>
                </li>
                <li id="resume-select">
                <h4>Resume <span>*</span></h4>
                <div class="file-input-container">
                       <input type="file" name="resume" id="real-file" hidden="hidden"/>
                        <button type="button" id="custom-button">CHOOSE A FILE</button>
                        <span id="custom-text">No file chosen, yet.</span>
                </div>
                    </li>
            <div class="submit-button">
               <input type="submit" value="Submit">
            </div>
            </ul>
        </form>
    </div>

    </section>

     <footer>
        <section id="footer-content">
        <div class="row">
            <div class="col">
                <h4>ABOUT OLSHCO</h4>
                <p>OLSHCO, located in Guimba, Nueva Ecija, is a Catholic private school that was founded in 1947. It provides extensive educational programs and has been managed by the Missionaries of the Sacred Heart (MSC) and the Franciscan Sisters of the Immaculate Conception of the Holy Mother of God (SFIC) since its establishment.</p>
            </div>
            <div class="col">
                <h4>CONNECT WITH US!</h4>
                <ul>
                    <li><img src="img/location.png" alt="">Guimba, Nueva Ecija 3115 Guimba Central Luzon</li>
                    <li><img src="img/telephone.png" alt="">(044) 364 7186</li>
                    <li><img src="img/mail.png" alt="">olshco1947@yahoo.com.ph</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <h4>QUICK LINKS</h4>
            <ul sttle="padding: 0; margin: 0;">
                <li><a href="#">About Us</a></li>
                <li><a href="#">School Information</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        </section>
        
      <section id="copyright">
         <h4>Copyright © 2023 Our Lady of the Sacred Heart College of Guimba, Inc. || <span>
             <a href="credits.php"  style="color: #5f0000; text-decoration: none; cursor: pointer;" onmouseover="this.style.color='#440000';" onmouseout="this.style.color='#5f0000';">Team RESURGO</a>
         </span> • All Rights Reserved</h4>
      </section>
    </footer>
    
<div class="modal fade" id="successMessageModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" style="color: white;">Success</h5> <!-- Changed from Error to Success -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="successMessage" style="color: white;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorMessageModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #c73e1d;">
            <div class="modal-header">
                <h5 class="modal-title" style="color: white;">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="errorMessage" style="color: white;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var endDate = new Date();
    endDate.setFullYear(endDate.getFullYear() - 18);  
    var startDate = new Date();
    startDate.setFullYear(startDate.getFullYear() - 85); 
    var startDateISOString = startDate.toISOString().split('T')[0];
    var endDateISOString = endDate.toISOString().split('T')[0];
    
    var input = document.getElementById('birthdate');
    input.setAttribute('min', startDateISOString);
    input.setAttribute('max', endDateISOString);
});

function validateContactInput(inputElement) {
    const inputValue = inputElement.value;
    const numericValue = inputValue.replace(/[^0-9]/g, "");
    inputElement.value = numericValue;
}

const FinputElement = document.getElementById("first_name");
FinputElement.addEventListener("input", function() {
    const inputValue = FinputElement.value;
    const alphabeticValue = inputValue.replace(/[^a-zA-Z\s]+/g, "");
    FinputElement.value = alphabeticValue;
});

const MinputElement = document.getElementById("middle_name");
MinputElement.addEventListener("input", function() {
    const inputValue = MinputElement.value;
    const alphabeticValue = inputValue.replace(/[^a-zA-Z\s]+/g, "");
    MinputElement.value = alphabeticValue;
});

const LinputElement = document.getElementById("last_name");
LinputElement.addEventListener("input", function() {
    const inputValue = LinputElement.value;
    const alphabeticValue = inputValue.replace(/[^a-zA-Z\s]+/g, "");
    LinputElement.value = alphabeticValue;
});

const formFileInput = document.getElementById("real-file");
formFileInput.addEventListener("change", function () {
    const allowedExtension = "pdf";
    const fileName = this.value.toLowerCase();
    if (!fileName.endsWith("." + allowedExtension)) {
        alert("Please select a valid PDF file.");
        this.value = ""; 
    }
});

function validateForm() {
    const firstName = document.getElementById("first_name").value;
    const middleName = document.getElementById("middle_name").value;
    const lastName = document.getElementById("last_name").value;
    const street = document.getElementById("street").value;
    const birthdate = document.getElementById("birthdate").value;
    const city = document.getElementById("city").value;
    const state_province = document.getElementById("state_province").value;
    const postal_zip_code = document.getElementById("postal_zip_code").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const formFile = document.getElementById("real-file").value;
    
    if (firstName === "" || middleName === "" || lastName === "" || street === "" || birthdate === "" || city === "" || state_province === "" || postal_zip_code === "" || email === "" || phone === "" || formFile === "") {
        alert("All data are required to fill up.");
        return false;
    } else if (firstName.length < 2){
        alert("First Name must be at least 2 characters long. Please Try Again.");
        return false;
    } else if (middleName.length < 2){
        alert("Middle Name must be at least 2 characters long. Please Try Again.");
        return false;
    } else if (lastName.length < 2){
        alert("Last Name must be at least 2 characters long. Please Try Again.");
        return false;
    } else if (!/^\d{11}$/.test(phone)) {
        alert("Phone number must be exactly 11 digits long and contain only numbers. Please try again.");
        return false;
    } else if (!/^0[1-9]\d{9}$/.test(phone)) {
        alert("Invalid phone number format. Please enter a valid 11-digit phone number starting with 0.");
        return false;
    }

    return true;
}

$('#applicationForm').submit(function(event) {
    event.preventDefault();
    
    if (validateForm()) {
        var formData = new FormData(this);
        $.ajax({
            url: 'online_application_data.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.error) {
                    $('#errorMessage').text(data.message);
                    $('#errorMessageModal').modal('show');
                } else {
                    $('#successMessage').text(data.message);
                    $('#successMessageModal').modal('show');
                }
            },
            error: function(xhr, status, error) {
                var data = JSON.parse(xhr.responseText);
                if (data.error) {
                    $('#errorMessage').text(data.message);
                    $('#errorMessageModal').modal('show');
                } else {
                    location.reload();
                }
            }
        });
    }
});


$('#successMessageModal').on('hidden.bs.modal', function (e) {
    
    window.location.href = 'index.php'; 
});

$('#errorMessageModal').on('hidden.bs.modal', function (e) {
    location.reload(); 
});
</script>

<script src="script/input_file_script.js"></script>
      
</body>
</html>
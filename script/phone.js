const phoneInput = document.getElementById("phone");

  // Add an input event listener to the element
  phoneInput.addEventListener("input", function() {
    // Get the current input value
    const inputValue = phoneInput.value;

    // Define the pattern to check
    const pattern = /^09[0-9]{9}$/;

    // Check if the input value matches the pattern
    if (pattern.test(inputValue)) {
      // Input is valid
      phoneInput.setCustomValidity("");
    } else {

      phoneInput.setCustomValidity("Phone number must start with '09' and be 11 digits long.");
    }
  });
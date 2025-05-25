console.log("Script Loaded");

document.addEventListener("DOMContentLoaded", function () {
  const password = document.getElementById("password");
  const confirmPass = document.getElementById("confirm_password");
  const submitBtn = document.getElementById("signup");
  const checkbox = document.querySelector("#eula");

  function validateSubmit() {
    console.log("Validating submit..."); // Debugging line
    if (password.value === confirmPass.value && checkbox.checked) {
      submitBtn.removeAttribute("disabled");
    } else {
      submitBtn.setAttribute("disabled", "true");
    }
  }

  confirmPass.addEventListener("input", function () {
    console.log("Confirm Password Input Detected"); // Debugging line
    if (password.value === confirmPass.value) {
      confirmPass.style.borderColor = "green";
    } else {
      confirmPass.style.borderColor = "red";
    }
    validateSubmit(); 
  });

  checkbox.addEventListener("change", function () {
    console.log("Checkbox Changed"); // Debugging line
    validateSubmit();
  });
});

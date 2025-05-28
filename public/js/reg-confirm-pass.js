console.log("Script Loaded");

document.addEventListener("DOMContentLoaded", function () {
  const password = document.getElementById("password");
  const confirmPass = document.getElementById("confirm_password");
  const submitBtn = document.getElementById("signup");
  const checkbox = document.querySelector("#eula");

  function validateSubmit() {
    if (
      password.value.trim() !== "" && 
      confirmPass.value.trim() !== "" && 
      password.value === confirmPass.value && 
      checkbox.checked
    ) {
      submitBtn.removeAttribute("disabled");
    } else {
      submitBtn.setAttribute("disabled", "true");
    }
  }

  // Validates password and confirm password fields
  confirmPass.addEventListener("input", function () {
    if (password.value.trim() === "" || confirmPass.value.trim() === "") {
      confirmPass.style.borderColor = "gray"; // Neutral color when empty
    } else if (password.value === confirmPass.value) {
      confirmPass.style.borderColor = "green";
    } else {
      confirmPass.style.borderColor = "red";
    }
    validateSubmit();
  });

  password.addEventListener("input", validateSubmit);
  checkbox.addEventListener("change", validateSubmit);
});

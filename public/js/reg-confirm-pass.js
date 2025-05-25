console.log("Script Loaded");

document.addEventListener("DOMContentLoaded", function () {
  const password = document.getElementById("password");
  const confirmPass = document.getElementById("confirm_password");
  const submitBtn = document.getElementById("signup");
  const checkbox = document.querySelector("#eula");

  function validateSubmit() {
    if (password.value === confirmPass.value && checkbox.checked) {
      submitBtn.removeAttribute("disabled");
    } else {
      submitBtn.setAttribute("disabled", "true");
    }
  }

  confirmPass.addEventListener("input", function () {
    if (password.value === confirmPass.value) {
      confirmPass.style.borderColor = "green";
    } else {
      confirmPass.style.borderColor = "red";
    }
    validateSubmit(); 
  });

  checkbox.addEventListener("change", function () {
    validateSubmit();
  });

  // toggle login and signup
  const signupBtn = document.querySelector(".get-signup");
  const loginBtn = document.querySelector(".get-login");
  const loginForm = document.getElementById("login-form");
  const signupForm = document.getElementById("signup-form");
  
  signupBtn.addEventListener("click", () => {
    loginForm.style.display = "none";
    signupForm.style.display = "block";
  });
  loginBtn.addEventListener("click", () => {
    loginForm.style.display = "block";
    signupForm.style.display = "none";
  });

});

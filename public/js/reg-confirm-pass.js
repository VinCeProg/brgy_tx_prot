document.addEventListener("DOMContentLoaded", function () {
  const password = document.getElementById("password");
  const confirmPass = document.getElementById("confirm_password");
  const submitBtn = document.getElementById("signup");

  confirmPass.addEventListener("input", function () {
    if (password.value === confirmPass.value) {
      confirmPass.style.setProperty("border-color", "green", "important");
      submitBtn.removeAttribute("disabled");
    } else {
      confirmPass.style.setProperty("border-color", "red", "important");
      submitBtn.setAttribute("disabled", "true");
    }
  });
});

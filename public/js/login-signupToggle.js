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

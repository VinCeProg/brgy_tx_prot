<?php
$pagetitle = 'Login/Signup';
// session_start();
require("../../functions.php");
require("partials/html.head.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<body>
  <div class="login-container">

    <form action="/brgy_tx_prot/src/controllers/adminLoginController.php" method="post">
      <img src="/brgy_tx_prot/public/images/barangay.svg" alt="Logo"><br>
      <h2>Barangay Resident Login</h2><br>

      <div class="input-container">
        <label for="email" class="test">Email</label>
        <input type="email" id="email-login" name="email-login" placeholder="example@email.com" required>
      </div><br>

      <div class="input-container">
        <label for="password" class="test">Password</label>
        <input type="password" id="password-login" name="password-login" placeholder="••••••••••••" minlength="8">
      </div><br>

      <input type="submit" name="login" value="Login" class="form-btn">
      <a href="#">Forgot Password?</a>
    </form>

</body>

</html>
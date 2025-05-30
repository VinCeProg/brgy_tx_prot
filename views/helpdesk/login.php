<?php
$pagetitle = 'Login/Signup';
require("../../functions.php");
require("partials/html.head.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// adminpass password teststaff
?>

<body>
  <div class="login-container">

    <form class="form" action="/brgy_tx_prot/src/controllers/adminLoginController.php" method="post">
      <img src="/brgy_tx_prot/public/images/barangay.svg" alt="Logo"><br>
      <h2 style="text-align: center;">Barangay Helpdesk Login</h2>
      <span class="input-span">
        <label for="email" class="label">Staff ID</label>
        <input type="text" name="staff_id" required /></span>
      <span class="input-span">
        <label for="password" class="label">Password</label>
        <input type="password" name="password" id="password" required/></span>
      <input class="submit" type="submit" value="Log in" />
      <a href="/brgy_tx_prot/index.php" rel="noopener noreferrer">Go Back to Care Portal</a>
    </form>

  </div>
</body>

</html>
<div class="form-cont" id="login-form">
  <form action="login.php" method="post">
    <img src="public/images/barangay.svg" alt="Logo"><br>
    <label for="email">Email</label>
    <input type="email" required> <br>
    <label for="password">Password</label>
    <input type="password" required min="8"> <br>
    <input type="submit" name="login" value="Login" class="form-btn">
    <a href="#">Forgot Password?</a>
    <br>
    <label>Don't have an account yet? <a href="#">Create one!</a></label>
  </form>
</div>

<div class="form-cont" id="signup-form">
<form action="register.php" method="post">
  <img src="public/images/barangay.svg" alt="Logo"><br>
  <label for="firstname">First Name</label>
  <input type="text" id="firstname" name="firstname" required><br>
  
  <label for="lastname">Last Name</label>
  <input type="text" id="lastname" name="lastname" required><br>
  
  <label for="address">Address</label>
  <input type="text" id="address" name="address" required><br>
  
  <label for="email">Email Address</label>
  <input type="email" id="email" name="email" required><br>
  
  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" required pattern="[0-9]{11}" maxlength="11"><br>
  
  <label for="password">Password</label>
  <input type="password" id="password" name="password" required minlength="8"><br>
  
  <label for="confirm_password">Verify Password</label>
  <input type="password" id="confirm_password" name="confirm_password" required minlength="8"><br>
  
  <input type="submit" name="register" value="Create Account" class="form-btn">
  <br>
  <label>Already have an account? <a href="#">Login here!</a></label>
</form>
</div>
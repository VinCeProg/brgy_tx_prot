<div class="form-cont" id="login-form">
  <form action="login.php" method="post">
    <img src="public/images/barangay.svg" alt="Logo"><br>
    <h2>Login</h2> <br>
    <div class="input-container">
      <label for="email" class="test">Email</label>
      <input type="email" required>
    </div> <br>
    <div class="input-container">
      <label for="password" class="test">Password</label>
      <input type="password" required min="8">
    </div> <br>
    <input type="submit" name="login" value="Login" class="form-btn">
    <a href="#">Forgot Password?</a>
    <br>
  </form>
  <p style="text-align: center;">Don't have an account yet? <button class="get-signup get-btn">Click Here!<button></p>
</div>

<div class="form-cont" id="signup-form">
  <form action="register.php" method="post" class="sign-form">
    <img src="public/images/barangay.svg" alt="Logo"><br>
    <h2>Sign-Up</h2> <br>

    <fieldset>
      <legend>Personal Information</legend>
      <label for="firstname">First Name</label>
      <input type="text" id="firstname" name="firstname" required><br>

      <label for="lastname">Last Name</label>
      <input type="text" id="lastname" name="lastname" required><br>

      <label for="address">Address</label>
      <input type="text" id="address" name="address" required><br>
    </fieldset>
    <br>

    <fieldset>
      <legend>Contact Information</legend>
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required><br>

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" required pattern="[0-9]{11}" maxlength="11">
    </fieldset>
    <br>

    <fieldset>
      <legend>Create a Password</legend>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required minlength="8"><br>
      <label for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="8"><br>
    </fieldset>
    <br>
    <label for="eula"><input type="checkbox" required> I have read the <a href="#">Terms and Conditions</a></label>
    <input type="submit" name="register" value="Create Account" class="form-btn" disabled>
    <br>
  </form>
  <p style="text-align: center;">Already have an account? <button class="get-login get-btn">Login!</button></p>
</div>
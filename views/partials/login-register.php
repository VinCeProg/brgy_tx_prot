<div class="logreg-container">

  <div class="form-cont" id="login-form">
    <form action="/brgy_tx_prot/src/controllers/residentLoginController.php" method="post">
      <img src="/brgy_tx_prot/public/images/barangay.svg" alt="Logo"><br>
      <h2>Barangay Resident Login</h2><br>

      <div class="input-container">
        <label for="email" class="test">Email</label>
        <input type="email" id="email-login" name="email-login" placeholder="example@email.com" required>
      </div><br>

      <div class="input-container">
        <label for="password" class="test">Password</label>
        <input type="password" id="password-login" name="password-login" placeholder="••••••••••••" minlength="8" maxlength="32" autocomplete="off" required>
      </div><br>

      <input type="submit" name="login" value="Login" class="form-btn">
      <a href="#" id="forgot-link">Forgot Password?</a>
    </form>
    <p style="text-align: center;">Don't have an account yet? <button class="get-signup get-btn">Click Here!<button></p>
  </div>

  <div id="forgot-popover" class="popover">
    <div class="popover-content">
      <p>Please proceed to the Barangay office to have your password reset.</p>
      <button id="close-popover">OK</button>
    </div>
  </div>


  <div class="signup-form" id="signup-form" style="display: none;">
    <form action="/brgy_tx_prot/src/controllers/residentSignupController.php" method="post" class="sign-form">
      <img src="/brgy_tx_prot/public/images/barangay.svg" alt="Barangay Logo"><br>
      <h2>Create Resident Account</h2><br>

      <fieldset>
        <legend>Personal Information</legend>

        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="Juan" required><br>

        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Dela Cruz" required><br>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="1904 Pureza St. Sta. Mesa, Manila City, NCR" required><br>
      </fieldset>
      <br>

      <fieldset>
        <legend>Contact Information</legend>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="example@email.com" required autocomplete="email"><br>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="09123456789" required pattern="[0-9]{11}" maxlength="11" inputmode="numeric">
      </fieldset>
      <br>

      <fieldset>
        <legend>Create a Password</legend>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" minlength="8" maxlength="32" required><br>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required minlength="8" maxlength="32"><br>
        <div class="note"><strong>Note:</strong> <em>Password must be at least 8 characters, max 32 characters</em></div>
      </fieldset>
      <br>

      <label>
        <input type="checkbox" id="eula" required>
        I have read the
        <a href="#" id="terms-link">
          Terms and Conditions
        </a>
      </label>
      <br>

      <input type="submit" name="register" value="Create Account" class="form-btn" id="signup" disabled>
      <br>
    </form>
    <p style="text-align: center;">
      Already have an account?
      <button type="button" class="get-login get-btn">Login!</button>
    </p>
    <!-- Terms and Conditions Popover -->
    <div id="terms-popover" class="popover terms-and-conditions" style="visibility: hidden;">
      <div class="popover-content" style="max-height: 70vh; overflow-y: auto;">
        <?php require "terms-and-conditions.php" ?>
        <button id="check-tnc">I agree to these Terms and Conditions</button>
        <button id="close-terms-popover" style="margin-top: 10px;">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="/brgy_tx_prot/public/js/reg-confirm-pass.js" defer></script>
<script src="/brgy_tx_prot/public/js/login-signupToggle.js" defer></script>
<script>
  const forgotLink = document.getElementById('forgot-link');
  const popover = document.getElementById('forgot-popover');
  const closeBtn = document.getElementById('close-popover');

  forgotLink.addEventListener('click', function(e) {
    e.preventDefault();
    popover.style.visibility = 'visible'; // Fix: Use visibility instead of display
  });

  closeBtn.addEventListener('click', function() {
    popover.style.visibility = 'hidden'; // Fix: Hide popover properly
  });
</script>
<script>
  // Terms and Conditions Popover Logic
  const termsLink = document.getElementById('terms-link');
  const termsPopover = document.getElementById('terms-popover');
  const closeTermsBtn = document.getElementById('close-terms-popover');
  const checkTncBtn = document.getElementById('check-tnc');
  const eulaCheckbox = document.getElementById('eula');

  termsLink.addEventListener('click', function(e) {
    e.preventDefault();
    termsPopover.style.visibility = 'visible';
  });

  closeTermsBtn.addEventListener('click', function() {
    termsPopover.style.visibility = 'hidden';
  });
  
  checkTncBtn.addEventListener('click', function() {
    eulaCheckbox.checked = true;
    termsPopover.style.visibility = 'hidden';
  });
</script>
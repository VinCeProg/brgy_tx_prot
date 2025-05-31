<?php
$residentModel = new Resident($conn);
$nonStaffResidents = $residentModel->getNonStaffResidents();
?>
<div class="page-title">
  <h1>Create Staff Account</h1>
  <p>Here, you can create new staff accounts</p>
</div>
<div class="staff-form-wrapper">
  <form id="staffForm" action="/brgy_tx_prot/src/controllers/adminCreateStaffController.php" method="POST" class="staff-form">
    <!-- Select Resident -->
    <label for="resident_id">Select Resident:</label>
    <select name="resident_id" id="resident_id" required>
      <option value="">Select Resident to Start</option>
      <?php foreach ($nonStaffResidents as $nonStaff): ?>
        <option value="<?= htmlspecialchars($nonStaff['UserID']) ?>">
          <?= htmlspecialchars($nonStaff['UserID']) ?> - <?= htmlspecialchars($nonStaff['fullname']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <!-- Password -->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required autocomplete="new-password" minlength="6">

    <!-- Confirm Password -->
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required autocomplete="new-password" minlength="6">

    <!-- Submit Button -->
    <button type="submit" id="signup" disabled>Create Staff Account</button>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    console.log("Script Loaded");

    const password = document.getElementById("password");
    const confirmPass = document.getElementById("confirm_password");
    const submitBtn = document.getElementById("signup");

    function validateSubmit() {
      const isPasswordFilled = password.value.trim() !== "";
      const isConfirmFilled = confirmPass.value.trim() !== "";
      const passwordsMatch = password.value === confirmPass.value;

      submitBtn.disabled = !(isPasswordFilled && isConfirmFilled && passwordsMatch);
    }

    function updateConfirmPasswordStyle() {
      confirmPass.style.borderColor =
        confirmPass.value.trim() === "" || password.value.trim() === "" ?
        "gray" :
        password.value === confirmPass.value ?
        "green" :
        "red";
    }

    confirmPass.addEventListener("input", function() {
      updateConfirmPasswordStyle();
      validateSubmit();
    });

    password.addEventListener("input", validateSubmit);
  });
</script>
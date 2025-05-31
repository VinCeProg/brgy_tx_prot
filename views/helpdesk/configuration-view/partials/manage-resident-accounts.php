<?php
$residentModel = new Resident($conn);
$residentList = $residentModel->getAllResident();
?>
<div class="resident-page-title">
  <h1>Manage Residents</h1>
  <p>Update resident information and change their password.</p>
</div>

<div class="resident-form-container">
  <form id="residentForm" action="/brgy_tx_prot/src/controllers/adminUpdateResidentController.php" method="POST">

    <div class="resident-form-group">
      <label for="resident_id">Select Resident</label>
      <select name="resident_id" id="resident_id" required>
        <option value="">Select a resident</option>
        <?php foreach ($residentList as $resident): ?>
          <option value="<?= htmlspecialchars($resident['UserID']) ?>">
            <?= htmlspecialchars($resident['UserID']) ?> - 
            <?= htmlspecialchars($resident['FirstName'] . ' ' . $resident['LastName']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="resident-form-layout">
      <!-- Column 1: Personal & Contact Info -->
      <div class="resident-form-column">
        <fieldset class="resident-fieldset">
          <legend>Personal Information</legend>

          <div class="resident-form-group">
            <label>First Name</label>
            <input type="text" name="first_name" id="first_name" required>
          </div>

          <div class="resident-form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" id="last_name" required>
          </div>

          <div class="resident-form-group">
            <label>Address</label>
            <input type="text" name="address" id="address" required>
          </div>
        </fieldset>

        <fieldset class="resident-fieldset">
          <legend>Contact Information</legend>

          <div class="resident-form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" required>
          </div>

          <div class="resident-form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" id="phone" required pattern="[0-9]{11}" title="Enter 11-digit number">
          </div>
        </fieldset>
      </div>

      <!-- Column 2: Password & Submit -->
      <div class="resident-form-column">
        <fieldset class="resident-fieldset">
          <legend>Change Password</legend>

          <div class="resident-form-group">
            <label>New Password</label>
            <input type="password" name="password" id="password" minlength="6">
          </div>

          <div class="resident-form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" minlength="6">
          </div>
        </fieldset>

        <div class="resident-form-actions">
          <button type="submit" id="updateBtn" disabled>Save Changes</button>
        </div>
      </div>
    </div>
  </form>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const residentSelect = document.getElementById("resident_id");
    const updateBtn = document.getElementById("updateBtn");

    const firstName = document.getElementById("first_name");
    const lastName = document.getElementById("last_name");
    const address = document.getElementById("address");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");

    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    const residentData = <?= json_encode($residentList, JSON_HEX_TAG) ?>;
    let originalData = {};

    residentSelect.addEventListener("change", function() {
      const selectedID = this.value;
      const selected = residentData.find(r => r.UserID == selectedID);
      if (selected) {
        firstName.value = selected.FirstName;
        lastName.value = selected.LastName;
        address.value = selected.Address;
        email.value = selected.Email;
        phone.value = selected.PhoneNo;

        originalData = {
          FirstName: selected.FirstName,
          LastName: selected.LastName,
          Address: selected.Address,
          Email: selected.Email,
          PhoneNo: selected.PhoneNo
        };
      }
      validateForm();
    });

    function validateForm() {
      const changed =
        firstName.value !== originalData.FirstName ||
        lastName.value !== originalData.LastName ||
        address.value !== originalData.Address ||
        email.value !== originalData.Email ||
        phone.value !== originalData.PhoneNo;

      const passFilled = password.value.trim() !== "";
      const confirmFilled = confirmPassword.value.trim() !== "";
      const passMatch = password.value === confirmPassword.value;

      updateBtn.disabled = !(changed || (passFilled && confirmFilled && passMatch));
    }

    [firstName, lastName, address, email, phone, password, confirmPassword].forEach(el =>
      el.addEventListener("input", validateForm)
    );
  });
</script>
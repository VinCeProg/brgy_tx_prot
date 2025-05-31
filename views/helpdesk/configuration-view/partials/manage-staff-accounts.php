<?php
$staffModel = new Staff($conn);
$staffList = $staffModel->getAllStaff();

?>
<div class="page-title">
  <h1>Manage Staff Accounts</h1>
  <p>Here, you can view and update staff account details.</p>
</div>
<div class="staff-form-wrapper">
  <form id="staffManagementForm" action="/brgy_tx_prot/src/controllers/adminUpdateStaffController.php" method="POST" class="staff-form">
    <!-- Select staff -->
    <label for="staff_id">Select Staff:</label>
    <select name="staff_id" id="staff_id" required>
      <option value="">Select Staff to Start</option>
      <?php foreach ($staffList as $staff): ?>
        <option value="<?= htmlspecialchars($staff['staff_id']) ?>">
          <?= htmlspecialchars($staff['staff_id']) ?> - <?= htmlspecialchars($staff['fullname']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <!-- Change Password -->
    <label for="password">New Password:</label>
    <input type="password" name="password" id="password" autocomplete="new-password" minlength="6">

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" autocomplete="new-password" minlength="6">

    <!-- Checkbox: Is Active -->
    <label>
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" name="is_active" id="is_active" value="1">
      Active Status
    </label>

    <!-- Checkbox: Is Admin -->
    <label>
      <input type="hidden" name="is_admin" value="0">
      <input type="checkbox" name="is_admin" id="is_admin" value="1">
      Admin Privileges
    </label>

    <!-- Submit Button -->
    <button type="submit" id="updateStaff" disabled>Save Changes</button>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    const staffSelect = document.getElementById("staff_id");
    const password = document.getElementById("password");
    const confirmPass = document.getElementById("confirm_password");
    const isActiveCheckbox = document.getElementById("is_active");
    const isAdminCheckbox = document.getElementById("is_admin");
    const submitBtn = document.getElementById("updateStaff");

    const staffData = <?= json_encode($staffList, JSON_HEX_TAG) ?>; // Secure PHP data embedding

    let originalData = {};

    staffSelect.addEventListener("change", function() {
      const selectedStaffId = this.value;
      const selectedStaff = staffData.find(staff => staff.staff_id == selectedStaffId);

      if (selectedStaff) {
        originalData = {
          is_active: selectedStaff.is_active == 1,
          is_admin: selectedStaff.is_admin == 1
        };

        isActiveCheckbox.checked = originalData.is_active;
        isAdminCheckbox.checked = originalData.is_admin;
      }

      validateForm(); // Revalidate after selection change
    });

    function validateForm() {
      const isPasswordChanged = password.value.trim() !== "";
      const isConfirmFilled = confirmPass.value.trim() !== "";
      const passwordsMatch = password.value === confirmPass.value;
      const isActiveChanged = isActiveCheckbox.checked !== originalData.is_active;
      const isAdminChanged = isAdminCheckbox.checked !== originalData.is_admin;

      submitBtn.disabled = !((isPasswordChanged && passwordsMatch) || isActiveChanged || isAdminChanged);
    }

    password.addEventListener("input", validateForm);
    confirmPass.addEventListener("input", validateForm);
    isActiveCheckbox.addEventListener("change", validateForm);
    isAdminCheckbox.addEventListener("change", validateForm);
  });
</script>
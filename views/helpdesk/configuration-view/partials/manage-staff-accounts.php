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
    <!-- Dropdown: Role -->
    <label for="role_id">Role:</label>
    <select name="role_id" id="role_id">
      <?php
      $roles = $staffModel->getAllRoles(); // You’ll need to add this method
      foreach ($roles as $role):
      ?>
        <option value="<?= $role['role_id'] ?>"><?= htmlspecialchars($role['role']) ?></option>
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
    <br>

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
    const roleSelect = document.getElementById("role_id");
    const submitBtn = document.getElementById("updateStaff");

    const staffData = <?= json_encode($staffList, JSON_HEX_TAG) ?>;

    let originalData = {};

    staffSelect.addEventListener("change", function() {
      const selectedStaffId = this.value;
      const selectedStaff = staffData.find(staff => staff.staff_id == selectedStaffId);

      if (selectedStaff) {
        originalData = {
          is_active: selectedStaff.is_active == 1,
          role_id: selectedStaff.role_id
        };

        isActiveCheckbox.checked = originalData.is_active;
        roleSelect.value = originalData.role_id;
      }

      validateForm();
    });

    function validateForm() {
      const isPasswordChanged = password.value.trim() !== "";
      const passwordsMatch = password.value === confirmPass.value;
      const isActiveChanged = isActiveCheckbox.checked !== originalData.is_active;
      const roleChanged = roleSelect.value != originalData.role_id;

      submitBtn.disabled = !(
        (isPasswordChanged && passwordsMatch) ||
        isActiveChanged ||
        roleChanged
      );
    }

    password.addEventListener("input", validateForm);
    confirmPass.addEventListener("input", validateForm);
    isActiveCheckbox.addEventListener("change", validateForm);
    roleSelect.addEventListener("change", validateForm);
  });
</script>
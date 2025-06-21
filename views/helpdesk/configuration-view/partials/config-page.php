<div class="page-title">
  <h1>Configuration</h1>
  <p>Customize system settings by selecting a category below.</p>
</div>
<br>
<div class="config-container <?= ($_SESSION['staff_permissions']['manage_content']) === 1 ? '' : 'hidden' ?>">
  <h3>Transparency Display</h3>
  <ul>
    <li><a href="?page=manage-resolvedtx-display">Manage Resolved Tickets Display</a></li>
    <li><a href="?page=add-resolvedtx-display">Add New Display</a></li>
  </ul>
</div>
<hr>
<div class="config-container <?= ($_SESSION['staff_permissions']['manage_resident_acc']) === 1 ? '' : 'hidden' ?>">
  <h3>Resident</h3>
  <ul>
    <li><a href="?page=manage-resident-accounts">Manage Resident Accounts</a></li>
  </ul>
</div>
<hr>
<div class="config-container <?= ($_SESSION['staff_permissions']['manage_staffacc']) === 1 ? '' : 'hidden' ?>">
  <h3>Staff</h3>
  <ul>
    <li><a href="?page=manage-staff-accounts">Manage Staff Accounts</a></li>
    <li><a href="?page=create-staff-account">Create New Staff Account</a></li>
  </ul>
</div>
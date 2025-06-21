<aside class="config-wrapper">
  <div class="config-container">
    <button onclick="window.location.href='/brgy_tx_prot/views/helpdesk/index.php';" class="back-btn" title="Go Back" style="width: 100px;">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      back
    </button>
    <h2>Settings</h2>
    <p>Manage user accounts, adjust access permissions, and configure the display showcase for resolved tickets.</p>
  </div>
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
</aside>
<header>
  <img src="/brgy_tx_prot/public/images/barangay.svg" alt="Logo" style="width: 56px" />
  <nav>
    <a href="/brgy_tx_prot/views/helpdesk/index.php" class="<?= $pagetitle === 'Overview' ? 'active' : '' ?>">Overview</a>
    <a href="/brgy_tx_prot/views/helpdesk/feedbacks.php" class="<?= $pagetitle === 'Feedbacks' ? 'active' : '' ?> <?= $_SESSION['staff_permissions']['manage_content'] === 1 ? '' : 'hidden' ?>">Feedback</a>
    <a href="/brgy_tx_prot/views/helpdesk/generate-report.php" class="<?= $pagetitle === 'Reporting' ? 'active' : '' ?> <?= $_SESSION['staff_permissions']['generate_report'] === 1 ? '' : 'hidden' ?>">Reporting</a>
    <a href="/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=config-page" class="<?= $pagetitle === 'Configuration' ? 'active' : '' ?>">Configuration</a>
  </nav>
  <div class="user-profile">
    <div class="profile-logo <?= $_SESSION['staff_permissions']['role_id'] === 1 ? "profile-admin" : "profile-staff" ?>">
      <?= substr($_SESSION['staff']['fullname'], 0, 1) ?>
    </div>
    <div>
      <strong><?= $_SESSION['staff']['fullname'] ?></strong><br />
      <small><?= $_SESSION['staff_permissions']['role'] ?></small> <br>
      <small><a href="/brgy_tx_prot/src/controllers/adminLogoutController.php" style="color: var(--secondary-color);">Logout</a></small>
    </div>
  </div>
</header>
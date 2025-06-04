 <?php
  // dd($_SERVER);
  $pagetitle = 'Configuration';
  session_start();
  require("../../../config/staff-auth.php"); //for login auth
  require("../../../functions.php");
  require("../partials/html.head.php");
  require __DIR__ . "/../../../config/database.php";
  require __DIR__ . "/../../../src/models/Staff.php";
  require __DIR__ . "/../../../src/models/Resident.php";
  require __DIR__ . "/../../../src/models/Ticket.php";


  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
  $allowed_pages = ['manage-resident-accounts', 'manage-staff-accounts', 'create-staff-account', 'manage-resolvedtx-display', 'add-resolvedtx-display'];
  if (in_array($page, $allowed_pages)) {
    $content = "partials/{$page}.php";
  } else {
    $content = "partials/404.php";
  }
  ?>

 <body>
   <?php require("../partials/navbar.php"); ?>
   <main class="config-main">

     <?php require("partials/aside.php"); ?>

     <section class="dynamic-window">
       <?php
        if (file_exists($content)) {
          require($content);
        } else {
          echo "<p>Error: Partial file not found ($content).</p>";
        }
        ?>
     </section>
   </main>
 </body>

 </html>
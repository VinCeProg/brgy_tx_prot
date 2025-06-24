<?php
$pagetitle = 'Feedback Form';
session_start();
require("../functions.php");
require("partials/html.head.php");
// print_r($_SESSION);
// exit();
?>

<body>

  <?php
  $navbar = (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) ? "partials/newnav.php" : "partials/navbar.php";
  require($navbar);
  ?>

  <main style="background-color: white; padding: 24px">
    <!-- Barangay FAQ Page -->
    <link rel="stylesheet" href="/brgy_tx_prot/public/css/faq.css">
    <div class="faq-wrapper">
      <h1 class="faq-title">Frequently Asked Questions</h1>
      <p class="faq-desc">Find answers to common questions about using the Barangay Request and Complaint System. Click on a question to view the answer, or use the button below to expand or collapse all.</p>
      <button id="faq-toggle-all" class="faq-toggle-all-btn">Expand All</button>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>Paano ba gamitin tong Barangay Request and Complaint System?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            <strong>STEP 1:</strong> LOG-IN TO YOUR CITIZEN ACCOUNT.<br>
            <strong>STEP 2:</strong> ON “HOME” LOOK FOR THE BUTTON “SUBMIT A REQUEST”.<br>
            <strong>STEP 3:</strong> FILL OUT THE REQUEST TICKET BY INPUTTING THE REQUIRED INFORMATION AND 1 PHOTO THAT IS CONNECTED TO YOUR REQUEST.<br>
            <strong>STEP 4:</strong> AFTER VERIFYING ALL THE INFORMATION SUBMIT THE TICKET.<br>
            *If you want to check the status or if the complaint went through follow STEP 5 and STEP 6.*<br>
            <strong>STEP 5:</strong> GO BACK TO “HOME” AND LOOK FOR “TRACK STATUS” (Its beside the SUBMIT TICKET button).<br>
            <strong>STEP 6:</strong> CHECK IF YOUR REQUEST APPEARS ON THE LIST OF REQUESTS. YOU CAN ALSO CHECK THE STATUS OF YOUR REQUESTS HERE.
          </p>
        </div>
      </div>
      <hr>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>May limit ba sa pagbibigay ng request/issue sa site na ito?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            Wala pong limit per day ang pagsesend ng inyong mga hinaing sa Barangay Complaint & Request System namin! Siguraduhin lang po natin na ang ating pinapadalang reklamo ay para sa ikabubuti o ikakatahimik ng ating barangay at hindi para sa personal ikasisira ng kapwa nating mamayanan.
          </p>
        </div>
      </div>
      <hr>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>May oras ba ng pagsasara ang Barangay Request/Complaint System?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            Wala pong oras ng pagsasara ang Barangay Complaint/Request system ngunit may mga araw na ito ay isasara namin para sa aming monthly maintenance/sudden urgent system issues or failures.
          </p>
        </div>
      </div>
      <hr>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>Ilang araw po ba bago maaksyonan ang issue/request na aming ipinadala?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            Aabutin po ito ng mga 3-4 business days depende po sa urgency ng inyong request. Ang layunin po ng Barangay sa website na ito ay maka resolba ng reklamo bawat araw Kahit ano pa pong urgency level Ninyo. Magantay lang po kayo sa message sa webapp o tawag ng Barangay sa numero ninyo.
          </p>
        </div>
      </div>
      <hr>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>Nais kong palitan yung password ng account ko na binago ng wala akong kaalaman. Maari ba naming kayong tawagan na lang upang maayos ito?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            Ang binigay po saaming utos ng aming punong Barangay ay dapat po ay makapunta po kayo sa Barangay po Ninyo upang matukoy ang iyong account at kung ikaw ba Talaga ang may-ari nito. Ito ay para maiwasan ang pagbabago ng account ng aming mga mabuting residente.
          </p>
        </div>
      </div>
      <hr>
      <div class="question-container">
        <div class="faq-question-row" tabindex="0" aria-expanded="false">
          <h2>May kinakailangan ba na documento sa pagsasampa ng isang issue o wala?</h2>
          <span class="faq-arrow">&#x25BC;</span>
        </div>
        <div class="faq-answer" style="display:none;">
          <p>
            Kadalasan po ay wala ngunit ang Barangay po ay manghihingi ng dokumento kung kinakailangan sa inyo. Kung gusto Ninyo naman po manghingi ng dokumento sa Barangay kung maari ay sa Baranagay po kayo dumeretso at hindi sa site upang maayos na mabigyan kayo ng maayos na instruction sa inyong gagawin upang makuha ang kailangan na dokumento.
          </p>
        </div>
      </div>
    </div>
  </main>

  <?php require("partials/footer.php"); ?>

  <script>
    document.querySelectorAll('.faq-question-row').forEach(function(row) {
      row.addEventListener('click', function() {
        const answer = this.nextElementSibling;
        const arrow = this.querySelector('.faq-arrow');
        const expanded = this.getAttribute('aria-expanded') === 'true';

        if (!expanded) {
          answer.style.display = 'block';
          arrow.style.transform = 'rotate(180deg)';
          this.setAttribute('aria-expanded', 'true');
        } else {
          answer.style.display = 'none';
          arrow.style.transform = 'rotate(0deg)';
          this.setAttribute('aria-expanded', 'false');
        }
      });

      row.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
          this.click();
        }
      });
    });

    const toggleAllBtn = document.getElementById('faq-toggle-all');
    let allExpanded = false;
    toggleAllBtn.addEventListener('click', function() {
      allExpanded = !allExpanded;
      document.querySelectorAll('.faq-question-row').forEach(function(row) {
        const answer = row.nextElementSibling;
        const arrow = row.querySelector('.faq-arrow');

        if (allExpanded) {
          answer.style.display = 'block';
          arrow.style.transform = 'rotate(180deg)';
          row.setAttribute('aria-expanded', 'true');
        } else {
          answer.style.display = 'none';
          arrow.style.transform = 'rotate(0deg)';
          row.setAttribute('aria-expanded', 'false');
        }
      });
      toggleAllBtn.textContent = allExpanded ? 'Collapse All' : 'Expand All';
    });
  </script>


</body>

</html>
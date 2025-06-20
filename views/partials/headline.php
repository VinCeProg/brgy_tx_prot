<?php
echo $_SERVER['REQUEST_URI'];
if ($_SERVER['REQUEST_URI'] === "/brgy_tx_prot/views/dashboard/index.php") {
  $content_data = json_decode(file_get_contents("../../public/content/headline.json"), true);
} else {
  $content_data = json_decode(file_get_contents("../public/content/headline.json"), true);
}
?>
<pre>
  <?
  print_r($content_data);
  exit
  ?>
</pre>

<div class="headline" id="headline">
  <div class="headline-title">
    <h2 id="greet">
      Maligayang pagdating sa Barangay PUP! Ngayon ay
    </h2>
    <p>WHAT'S NEW</p>
    <hr
      style="
            padding-bottom: 30px;
            border: 1px solid black;
            margin-bottom: 30px;
          " />
  </div>

  <div class="headline-container">
    <div class="headline-one">
      <img src="/brgy_tx_prot/public/images/headline-first.png" alt="Barangay PUP Resbakuna" />
      <img src="/brgy_tx_prot/public/images/headline-second.png" alt="Barangay PUP Contacts" />
      <img src="/brgy_tx_prot/public/images/headline-third.png" alt="Taurist Spots" />
    </div>

    <div class="headline-two">
      <img src="<?= $content_data['image'] ?>" alt="Job Hunt" />
      <h3>
        <?= $content_data['title'] ?>
      </h3>
      <?php foreach ($content_data['paragraphs'] as $paragraph): ?>
        <p><?= $paragraph ?></p>
        <br>
      <?php endforeach; ?>
    </div>

    <div class="headline-three">
      <img
        src="/brgy_tx_prot/public/images/headline-contacts.png"
        alt="Barangay PUP Emergency Contacts" />
    </div>
  </div>
</div>

<script>
  function updateClock() {
    const now = new Date();

    const day = now.toLocaleString('fil-PH', {
      weekday: 'long',
      timeZone: 'Asia/Manila'
    });
    const date = now.toLocaleString('fil-PH', {
      day: '2-digit',
      month: 'long',
      year: 'numeric',
      timeZone: 'Asia/Manila'
    });

    document.getElementById('greet').textContent = "Maligayang pagdating sa Barangay PUP! Ngayon ay " + day + ", " + date;
  }
  updateClock();
  setInterval(updateClock, 1000);
</script>
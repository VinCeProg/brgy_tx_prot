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
      <h3>
        PINALAWAK NA ANG AMBULANCE SERVICES SA BARANGAY PUP STA. MESA.
      </h3>
      <p>
        Matagumpay ang naging turn-over ceremony ng mga madami ambulansya sa
        ating barangay PUP na pinangunahan ng ating Mayor at Vice Mayo at ng
        ating Sangguniang Bayan kasama ang bawat Barangay Recipients.<br />
        Isang magandang hakbang ito upang mapalawak ang serbisyong
        pangkalusugan sa ating bayan. Basta't sama-sama, kayang-kaya!
      </p>
      <img src="/brgy_tx_prot/public/images/headline-fourth.png" alt="Job Hunt" />
      <p>
        PUP Barangay is hosting a job hunt to connect residents with local
        employment opportunities and support community livelihood.
      </p>
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
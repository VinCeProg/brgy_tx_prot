<div class="title-container" id="transparency-service">
  <p>INNOVATIVE PUBLIC SERVICE</p>
  <h3>TRANSPARENCY & GOOD GOVERNANCE</h3>
</div>

<div class="carousel">
  <div class="card"><img src="/brgy_tx_prot/public/images/card1.png" alt="Card 1"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card2.png" alt="Card 2"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card3.png" alt="Card 3"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card4.png" alt="Card 4"></div>

  <!-- Duplicate cards to maintain seamless scrolling -->
  <div class="card"><img src="/brgy_tx_prot/public/images/card1.png" alt="Card 1"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card2.png" alt="Card 2"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card3.png" alt="Card 3"></div>
  <div class="card"><img src="/brgy_tx_prot/public/images/card4.png" alt="Card 4"></div>
</div>


<script>
  function nextCard() {
    const carousel = document.querySelector(".carousel-container");
    carousel.scrollBy({
      left: 320,
      behavior: "smooth"
    });
  }

  function prevCard() {
    const carousel = document.querySelector(".carousel-container");
    carousel.scrollBy({
      left: -320,
      behavior: "smooth"
    });
  }
</script>
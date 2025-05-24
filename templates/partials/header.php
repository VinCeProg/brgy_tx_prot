<header>
  <div class="title">
    <a href="#"><img src="public/images/barangay.svg" alt="Baranggay Logo"></a>
    <div class="title-text">
      <h1>Barangay PUP</h1>
      <p>Barangay PUP, Sta. Mesa, Manila</p>
    </div>
  </div>
  <button id="burger-toggle" aria-label="Toggle menu">&#9776;</button>
</header>

<script>
  const menu_toggle = document.getElementById("burger-toggle");
  const navbar = document.querySelector("nav");

  menu_toggle.addEventListener("click", () => {
    if (navbar.style.display === "none" || navbar.style.display === "") {
      navbar.style.display = "block";
    } else {
      navbar.style.display = "none";
    }
  });
</script>
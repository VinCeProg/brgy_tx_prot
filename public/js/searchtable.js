function filterTable() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.querySelectorAll("table tbody tr");

  rows.forEach(row => {
    const cells = Array.from(row.getElementsByTagName("td"));
    const match = cells.some(cell => cell.textContent.toLowerCase().includes(input));
    row.style.display = match ? "" : "none";
  });
}

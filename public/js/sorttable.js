document.addEventListener("DOMContentLoaded", () => {
  const table = document.querySelector("table");
  const tbody = table.querySelector("tbody");
  const sortColumnSelect = document.getElementById("sortColumn");
  const sortOrderBtn = document.getElementById("sortOrderBtn");
  const resetSortBtn = document.getElementById("resetSortBtn");

  let ascending = true;
  const originalRows = Array.from(tbody.querySelectorAll("tr"));

  sortOrderBtn.addEventListener("click", () => {
    ascending = !ascending;
    sortOrderBtn.textContent = ascending ? "Asc" : "Desc";
    sortTable();
  });

  sortColumnSelect.addEventListener("change", sortTable);

  resetSortBtn.addEventListener("click", () => {
    tbody.innerHTML = "";
    originalRows.forEach(row => tbody.appendChild(row));
    sortColumnSelect.selectedIndex = 0;
    ascending = true;
    sortOrderBtn.textContent = "Asc";
  });

  function sortTable() {
    const columnIndex = parseInt(sortColumnSelect.value);
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.sort((a, b) => {
      const aText = a.children[columnIndex].textContent.trim().toLowerCase();
      const bText = b.children[columnIndex].textContent.trim().toLowerCase();

      // If the value looks like a number or date, try comparing that way
      const aVal = isNaN(Date.parse(aText)) ? isNaN(aText) ? aText : parseFloat(aText) : new Date(aText);
      const bVal = isNaN(Date.parse(bText)) ? isNaN(bText) ? bText : parseFloat(bText) : new Date(bText);

      if (aVal < bVal) return ascending ? -1 : 1;
      if (aVal > bVal) return ascending ? 1 : -1;
      return 0;
    });

    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));
  }
});

document.addEventListener("DOMContentLoaded", function () {

  const statusColors = {
    "PENDING": "orange",
    "IN PROGRESS": "blue",
    "RESOLVED": "green",
    "CLOSED": "gray"
  };

  document.querySelectorAll(".status-text").forEach(function (statusEl) {
    const statusValue = statusEl.textContent.trim().toUpperCase();
    statusEl.style.color = statusColors[statusValue] || "black";
  });

  const priolvlColors = {
    "LOW": "#2e7d32",       // Green
    "MEDIUM": "#f9a825",    // Amber
    "HIGH": "#ef6c00",      // Deep Orange
    "URGENT": "#c62828"     // Red
  }

  document.querySelectorAll('.priority-display').forEach(function (priolvlEl) {
    const priolvlValue = priolvlEl.textContent.trim().toUpperCase();
    priolvlEl.style.color = priolvlColors[priolvlValue] || "black";
  });
});
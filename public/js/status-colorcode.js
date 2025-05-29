document.addEventListener("DOMContentLoaded", function () {
  console.log("Status coloring script loaded");

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
});
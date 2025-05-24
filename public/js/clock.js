function updateClock() {
  const now = new Date();

  const day = now.toLocaleString('en-PH', { weekday: 'long', timeZone: 'Asia/Manila' });
  const date = now.toLocaleString('en-PH', { day: '2-digit', month: 'long', year: 'numeric', timeZone: 'Asia/Manila' });
  const time = now.toLocaleString('en-PH', { hour: '2-digit', minute: '2-digit', second: '2-digit', timeZone: 'Asia/Manila' });

  document.getElementById('ph-day').textContent = day;
  document.getElementById('ph-date').textContent = date;
  document.getElementById('ph-time').textContent = time;
}

setInterval(updateClock, 1000);
updateClock();

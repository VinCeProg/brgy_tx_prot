<form class="tx-sub" action="src/controllers/ticketController.php" method="POST" enctype="multipart/form-data">
  <label for="subject">SUBJECT</label>
  <input type="text" name="subject" id="subject" required><br> <br>

  <label for="description">DESCRIPTION</label>
  <textarea name="description" id="description" rows="4" required></textarea><br> <br>

  <label for="file">Attach file (image/video only)</label>
  <input type="file" id="file" name="file" accept="image/*,video/*"><br>

  <div id="file-preview" style="margin-top: 10px;"></div> <br>

  <input type="submit" value="SUBMIT TICKET">
</form>

<script>
  document.getElementById('file').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('file-preview');
    const file = event.target.files[0];
    previewContainer.innerHTML = ''; // Clear previous preview

    if (!file) return;

    const fileType = file.type;

    if (fileType.startsWith('image/')) {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.style.maxWidth = '300px';
      img.style.maxHeight = '200px';
      previewContainer.appendChild(img);
    } else if (fileType.startsWith('video/')) {
      const video = document.createElement('video');
      video.src = URL.createObjectURL(file);
      video.controls = true;
      video.style.maxWidth = '300px';
      video.style.maxHeight = '200px';
      previewContainer.appendChild(video);
    } else {
      previewContainer.textContent = "Unsupported file type.";
    }
  });
</script>
<form class="tx-sub" action="/brgy_tx_prot/src/controllers/ticketController.php" method="POST" enctype="multipart/form-data">
  <label for="issue-type">Select Issue Type</label> <br>
  <select name="issue-type" id="issue-type" required>
    <option value="" disabled selected>-- Choose the type of issue you're reporting --</option>
    <option value="streetlight-repair">Streetlight Repair</option>
    <option value="flooding">Flooding</option>
    <option value="garbage-collection">Garbage Collection</option>
    <option value="road-damage">Road Damage</option>
    <option value="noise-complaint">Noise Complaint</option>
    <option value="other">Other</option>
  </select><br> <br>

  <label for="subject">Subject</label>
  <input type="text" name="subject" id="subject" minlength="5" maxlength="100" required placeholder="A short title or summary of your concern"><br> <br>

  <label for="description">Description</label>
  <textarea name="description" id="description" rows="4" maxlength="500" required placeholder="Provide more details about your request or complaint. Include location, time, or links if relevant."></textarea><br> <br>

  <label for="file">Attach file (image/video only)</label> <br>
  <input type="file" id="file" name="file" accept="image/*,video/*">
  <div id="file-preview" style="margin-top: 10px;"></div> <br>
  <div class="note"><strong>Note:</strong> <em>You can only upload <strong>one file</strong>. If you need to include more, please add a link in the description.</em></div>
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
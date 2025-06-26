<?php
$jsonPath = __DIR__ . '/../../../../public/content/headline.json'; // Adjust path if needed
$data = json_decode(file_get_contents($jsonPath), true);
$uploadDir = __DIR__ . '/../../../../public/images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data['title'] = htmlspecialchars($_POST['title']);
  $rawParagraphs = array_filter($_POST['paragraphs']);
  $data['paragraphs'] = array_map('htmlspecialchars', $rawParagraphs);
  $data['date'] = $_POST['date'];

  // Handle image upload if a new file is provided
  if (isset($_FILES['imageFile']) && is_uploaded_file($_FILES['imageFile']['tmp_name'])) {
    $uploadName = basename($_FILES['imageFile']['name']);
    $uploadTmp = $_FILES['imageFile']['tmp_name'];
    $uploadPath = $uploadDir . $uploadName;

    if (move_uploaded_file($uploadTmp, $uploadPath)) {
      $data['image'] = '/brgy_tx_prot/public/images/' . $uploadName;
    } else {
      echo "<p style='color:red;'>Image upload failed.</p>";
    }
  }

  if (file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT))) {
    echo "<script>alert(`Announcement Updated Successfully`)</script>";
  } else {
    echo "<p style='color:red;'>Failed to write to JSON file.</p>";
  }
}
?>
<div class="edit-display-form">
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="date" value="<?= date("Y-m-d") ?>">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required><br><br>

    <label>Paragraphs:</label>
    <?php foreach ($data['paragraphs'] as $para): ?>
      <textarea name="paragraphs[]" rows="3" cols="60"><?= htmlspecialchars($para) ?></textarea><br>
    <?php endforeach; ?>
    
    <textarea name="paragraphs[]" rows="3" cols="60" placeholder="Add new paragraph..."></textarea><br>

    <label>Upload Image:</label>
    <input type="file" name="imageFile" accept="image/*"><br>
    <br>
    <img src="<?= htmlspecialchars($data['image']) ?>" width="200px">
    <br>
    <button type="submit">Publish</button>
  </form>
</div>
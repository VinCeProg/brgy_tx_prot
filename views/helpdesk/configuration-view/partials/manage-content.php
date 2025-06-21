<?php
$jsonPath = __DIR__ . '/../../../../public/content/test.json'; // Adjust path if needed
$data = json_decode(file_get_contents($jsonPath), true);
$uploadDir = __DIR__ . '/../../../../public/images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data['title'] = $_POST['title'];
  $data['paragraphs'] = array_filter($_POST['paragraphs']); // Remove empty inputs

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
    echo "<p style='color:green;'>JSON updated successfully!</p>";
  } else {
    echo "<p style='color:red;'>Failed to write to JSON file.</p>";
  }
}
?>

<form method="POST" enctype="multipart/form-data">
  <label>Title:</label><br>
  <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required><br><br>

  <label>Paragraphs:</label><br>
  <?php foreach ($data['paragraphs'] as $para): ?>
    <textarea name="paragraphs[]" rows="3" cols="60"><?= htmlspecialchars($para) ?></textarea><br><br>
  <?php endforeach; ?>
  <!-- One extra for adding a new paragraph -->
  <textarea name="paragraphs[]" rows="3" cols="60" placeholder="Add new paragraph..."></textarea><br><br>

  <label>Upload Image:</label><br>
  <input type="file" name="imageFile" accept="image/*"><br>
  <img src="<?= htmlspecialchars($data['image']) ?>" width="200px">
  <br>
  <button type="submit">Save Changes</button>
</form>

<form action="/brgy_tx_prot/src/controllers/feedbackController.php" method="POST" class="feedback-form">
  <h2>We Value Your Feedback</h2>
  <p>Tell us what you liked — or what we can do better. Your feedback helps us improve your experience.</p>
  <label for="name">Your Name (optional):</label>
  <input type="text" name="name" id="name" placeholder="Your name">

  <label for="rating">How would you rate your experience?</label>
  <div class="rating-stars">
    <input type="radio" name="rating" id="star5" value="5"><label for="star5">★</label>
    <input type="radio" name="rating" id="star4" value="4"><label for="star4">★</label>
    <input type="radio" name="rating" id="star3" value="3"><label for="star3">★</label>
    <input type="radio" name="rating" id="star2" value="2"><label for="star2">★</label>
    <input type="radio" name="rating" id="star1" value="1"><label for="star1">★</label>
  </div>


  <label for="comment">What would you like to tell us?</label>
  <textarea name="comment" id="comment" rows="4" required placeholder="Your feedback..."></textarea>

  <button type="submit">Submit Feedback</button>
</form>
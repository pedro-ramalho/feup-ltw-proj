<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/review.class.php');
  require_once(__DIR__ . '/../classes/user.class.php');
?>

<?php
  function draw_review(Review $review) { ?>
  <div id="customer-review">
    <div class="author-score-container">
      <div id="pfp-author">
        <img src="../assets/user.png">
        <h3 id ="review-author"><?=Review::get_author(get_db(), $review->id)?></h3>
      </div>
      <h3 id="review-score"><?=$review->score?>/5</h3>
    </div>
    <p id="review-content"><?=$review->text?></p>
  </div>
<?php } ?>

<?php
  function draw_review_form($restaurant_id) { 
    if (isset($_SESSION['id'])) {
    ?>
    <div id="review-form">
      <h2>Add your review</h2>
      <form action="database/action_add_review.php" method="post" id="add-review-form">
        <label for="review-score">
          Score<input id="review-score" type="number" name="review-score" min="0" max="5" placeholder="score...">
        </label>
        <label>
          Comment<input id="review-comment" type="text" name="review-comment" placeholder="Add a comment...">
        </label>
        <input type="hidden" name="restaurant-id" value="<?=$restaurant_id?>" readonly="readonly">
        <button id="submit-review" type="submit">Submit</button>
      </form>
    </div>

    <?php }
    else { ?>
      <div id="review-placeholder">
        <h2>To add a review, sign in first!</h2>
      </div>
    <?php } ?>
<?php } ?>
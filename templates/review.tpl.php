<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/review.class.php');
  require_once('database/classes/user.class.php');
?>

<?php
  function draw_review(Review $review) { ?>
  <div id="customer-review">
    <div class="author-score-container">
      <div id="pfp-author">
        <img src="../assets/user.png">
        <h3 id ="review-author"><?=Review::get_author(get_db_extended_path(), $review->id)?></h3>
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
      <form action="database/action_add_review.php" method="post" id="add-review-form">
        <h2>Add your review</h2>
        <label>
        Score:  <input type="number" name="review-score" id="review-score" min="0" max="5">
        </label>
        <label>
        Comment:  
        <input type="text" name="review-comment" id="review-comment">
        </label>
        <input type="hidden" name="restaurant-id" value="<?=$restaurant_id?>" readonly="readonly">
      </form>
    <?php }
    else { ?>
      <div id="review-placeholder">
        <h2>To add a review, sign in first!</h2>
      </div>
    <?php } ?>
<?php } ?>
<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/review.class.php');
  require_once('database/classes/user.class.php');
?>

<?php function draw_review(Review $review) { ?>
  <div id="customer-review">
    
    <p id="review-content"><?=$review->text?></p>
  </div>
<?php } ?>
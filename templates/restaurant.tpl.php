<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/restaurant.class.php');
?>

<?php function draw_restaurant(Restaurant $restaurant) { ?>
  <div class="restaurant-frontpage">
    <h1 class="restaurant-title"><?=$restaurant->res_name?></h1>
    <img src="../assets/temp.jpg" alt="restaurant's display image">
    <div id="score-button">
      <h3><?=$restaurant->score?></h3>
      <button class="favorite-restaurant">+</button>
    </div>
  </div>
<?php } ?>

<?php function draw_restaurant_preview(Restaurant $restaurant) { ?>
  <div class="restaurant-preview">
    <a href="view_restaurant.php?id=<?=$restaurant->id?>">
      <h1 class="restaurant-preview-title"><?=$restaurant->res_name?></h1>
      <img src="../assets/temp.jpg" alt="restaurant's preview image">
      <div class="score-container">
        <h3><?=$restaurant->score?></h3>
      </div>
      <div class="restaurant-categories-container">
        <?php
        foreach($restaurant->categories as $category) {
          ?> <h5 class="preview-restaurant-category"><?=$category?></h5>
        <?php } ?>
      </div>
    </a>
    <button class="favorite-restaurant">
      <img src="../assets/star.svg">
    </button>
  </div>
<?php } ?>
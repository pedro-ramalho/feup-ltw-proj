<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/restaurant.class.php');
?>

<?php function draw_restaurant(Restaurant $restaurant) { ?>
  <div class="restaurant-frontpage">
    <div id="restaurant-info">
      <div class="restaurant-name-score">
        <h1 class="restaurant-title"><?=$restaurant->res_name?></h1>
        <h3 class="restaurant-score"><?=$restaurant->score?>/5</h3>
      </div>
      <div class="categories-container">
        <?php
        foreach($restaurant->categories as $category) {
          ?> <h5 class="preview-category"><?=$category?></h5>
        <?php } ?>
      </div>
      <h3 class="restaurant-coords"><?=$restaurant->coords?></h3>
    </div>
    <img src="../assets/temp.jpg" alt="restaurant's display image">
    <div id="score-button">
      <button class="favorite-restaurant">Add to favorites</button>
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

<?php function draw_restaurant_form(Restaurant $restaurant) { ?>
  <div class="edit-restaurant">
    <form method="post">
      <div id="restaurant-info">
        <div class="restaurant-name-score">
          <input type="text" value="<?=$restaurant->res_name?>">
          <h3 class="restaurant-score"><?=$restaurant->score?>/5</h3>
        </div>
        <div class="categories-container">
          <?php
          foreach($restaurant->categories as $category) {
            ?> <h5 class="preview-category"><?=$category?></h5>
          <?php } ?>
        </div>
        <input id="new-restaurant-coords" type="text" value="<?=$restaurant->coords?>">
        <button id="save-restaurant-info">Save</button>
      </div>
    </form>
    <div id="upload-img">
      <label id="file-upload">
        <input type="file" name="image">Choose file
      </label>
      <input type="submit" value="Send">
      <img src="../assets/temp.jpg" alt="restaurant's display image">
    </div>
    <div id="edit-dishes">
      <a href="edit_dishes.php?id=<?=$restaurant->id?>">Edit dishes</a>
    </div>
  </div>
<?php } ?>

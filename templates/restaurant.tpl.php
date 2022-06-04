<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
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
      <div class="coordinates">
        <img src="../assets/icons/gps.svg">
        <h3 class="restaurant-coords"><?=$restaurant->coords?></h3>    
      </div>
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
      <div class="categories-container">
        <?php
        foreach($restaurant->categories as $category) {
          ?> <h5 class="preview-category"><?=$category?></h5>
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
            ?> <input type="text" class="preview-category" value="<?=$category?>">
          <?php } ?>
        </div>
        <input id="new-restaurant-coords" type="text" value="<?=$restaurant->coords?>">
        <button class="save">Save</button>
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
      <a href="../pages/edit_dishes.php?id=<?=$restaurant->id?>">Edit dishes</a>
    </div>
  </div>
<?php } ?>

<?php function edit_restaurant_form(Restaurant $restaurant) { ?>
  <div class="edit-restaurant">
    <h1>Edit restaurant</h1>
    <form method="post">
      <div class="restaurant-info">
        <label for="restaurant-name">
          Name<input id="restaurant-name" type="text" value="<?=$restaurant->res_name?>">
        </label>
        <label for="category">
          Categories<input type="text" placeholder="category">
        </label>
        <label for="coordinates">
          Price<input id="coordinates" type="text" value="<?=$restaurant->coords?>">
        </label>
        <div id="upload-img">
          <label class="upload-img" id="file-upload">
            <input type="file" name="image">Upload image
          </label>
          <button class="save" type="submit" value="Save">Save</button>
          <a href="../pages/edit_dishes.php?id=<?=$restaurant->id?>">Edit dishes</a>
        </div>
      </div>
    </form>
  </div>
<?php } ?>


<?php function draw_restaurant_setup(int $user_id) { ?>
  <h1>Setup your own restaurant</h1>
  <div class="setup-restaurant">
    <form method="post">
      <div class="res-info">
        <label for="res-name">
          Restaurant name<input type="text" placeholder="name">
        </label>
        <label for="category">
          Cagegory<input type="text" placeholder="category">
        </label>
        <label for="coords">
          Coordinates<input type="text" placeholder="coordinates">
        </label>
        <div id="upload-img">
          <label class="upload-img" id="file-upload">
            <input type="file" name="image">Upload image
          </label>
          <button class="save" type="submit" value="Save">Save</button>
        </div>
      </div>
    </form>
  </div>
<?php } ?>

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

<?php function draw_restaurant_preview(Restaurant $restaurant, $image) { ?>
  <div class="preview">
    <section class="restaurant-info">
      <h1><?=$restaurant->res_name?></h1>
      <div class="preview-section">
        <img id="home-icon" class="icon" src="../assets/icons/home.svg">
        <h2><?=$restaurant->addr?></h2>
      </div>
      <p>Category</p>
      <div class="favorite-score-container">
        <div id="score" class="preview-section">
          <img id="star-icon" class="icon" src="../assets/icons/star.svg">
          <p><?=$restaurant->score?></p>
        </div>
        <div class="favorite">
          <form method="post" action="#">
            <input type="image" src="../assets/icons/favorite.svg">
          </form>
        </div>
      </div>
    </section>
    <section class="image-container">
      <img src="../assets/img/preview/restaurants/<?=$image['id']?>.jpg" alt="restaurant's preview image">
    </section>
  </div>
<?php } ?>

<?php function edit_restaurant_form(Restaurant $restaurant) { ?>
  <div class="edit-restaurant">
    <h1>Edit restaurant</h1>
    <form action="../actions/action_edit_restaurant.php" method="post" enctype="multipart/form-data">
      <div class="restaurant-info">
        <label for="restaurant-name">
          Name<input id="restaurant-name" name="restaurant-name" type="text" value="<?=$restaurant->res_name?>">
        </label>
        <label for="category">
          Categories<input type="text" id="categories" name="categories" placeholder="category">
        </label>
        <label for="coordinates">
          Coordinates<input id="coordinates" name="coordinates" type="text" value="<?=$restaurant->coords?>">
        </label>
        <div id="upload-img">
          <label class="upload-img" id="file-upload">
            <input type="file" name="image">Upload image
          </label>
          <input type="hidden" name="restaurant-id" value="<?=$restaurant->id?>">
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

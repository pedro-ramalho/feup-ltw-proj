<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
?>

<?php function draw_restaurant(Restaurant $restaurant) { ?>
  <div id="restaurant-frontpage">
    <div id="restaurant-bg-img-container">
      <img id="res-bg-image" src="../assets/img/bg/restaurant.jpg" alt="restaurant background image">
      <img id="add-res-to-favorites" class="icon res-favorite-button" src="../assets/icons/favorite.svg" alt="add to favorite" title="add restaurant to favorites">
      <img id="remove-res-from-favorites" class="icon res-favorite-button" src="../assets/icons/favorite.svg" alt="remove from favorites" title="remove restaurant from favorites">
    </div>
    <div id="restaurant-details">
      <h1 id="res-name"><?=$restaurant->res_name?></h1>
      <div id="res-miscellaneous">
        <h3 id="restaurant-score" class="res-info"><img id="res-star-icon" class="icon" src="../assets/icons/star.svg"><?=$restaurant->score?>/5</h3>
        <h3 id="restaurant-addr" class="res-info"><img id="res-home-icon" class="icon" src="../assets/icons/home.svg"><?=$restaurant->addr?></h3>
        <h3 id="restaurant-coords" class="res-info"><img id="res-gps-icon" class="icon" src="../assets/icons/gps.svg" alt=""><?=$restaurant->coords?></h3>
        <div id="res-categories-container">
          <img id="res-category-icon" class="icon" src="../assets/icons/category.svg">
          <?php
          foreach($restaurant->categories as $category) {
            ?> <h5 class="res-preview-category"><?=$category?></h5>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php function draw_restaurant_preview(Restaurant $restaurant, $image) { ?>
  <div class="preview">
    <section class="info">
      <a href="view_restaurant.php?id=<?=$restaurant->id?>">
        <h1><?=$restaurant->res_name?></h1>
      </a>
      <h2><?=$restaurant->addr?></h2>
      <div class="categories-container">
        <p>Category</p>
      </div>
      <div class="icons-container">
        <div class="score">
          <img id="star" class="icon" src="../assets/icons/star.svg">
          <p><?=$restaurant->score?></p>
        </div>
        <img id="favorite" class="icon" src="../assets/icons/favorite.svg">
      </div>
    </section>
    <section class="image-container">
      <img src="<?=$image?>.jpg" width="250" height="250">
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
    <form action="../actions/action_add_restaurant.php" method="post">
      <div class="res-info">
        <input id="owner-id" name="owner-id" type="hidden" value=<?=$_SESSION['id']?>>
        <label for="res-name">
          Restaurant name<input id="res-name" name="res-name" type="text" placeholder="name">
        </label>
        <label for="category">
          Cagegory<input id="res-category" name="res-category" type="text" placeholder="category">
        </label>
        <label for="address">
          Address<input id="res-address" name="res-address" type="text" placeholder="address">
        </label>
        <label for="coords">
          Coordinates<input id="res-coords" name="res-coords" type="text" placeholder="coordinates">
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

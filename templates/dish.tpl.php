<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
?>

<?php function draw_dish(Dish $dish) { ?>
  <div class="dish-frontpage"> <!-- click event listener -->
    <img src="../assets/temp.jpg" alt="restaurant's preview image">
    <div class="dish-description">
      <p id="dish-shopping-bag"><img id="dish-shopping-bag-icon" src="../assets/icons/shopping_bag.svg"><?=$dish->name?></p>
      <div id="dish-categories-container">
        <?php
        foreach($dish->categories as $category) {
          ?> <h5 class="dish-preview-category"><?=$category?></h5>
        <?php } ?>
      </div>
      <div id="dish-price-favorite-container">
        <p id="dish-price"><img id="dish-price-icon" src="../assets/icons/price.svg"><?=$dish->price?></p>
        <img id="dish-favorite-icon" src="../assets/icons/favorite.svg">
      </div>
    </div>
  </div>
<?php } ?>

<?php function draw_dish_preview(Dish $dish, $image) { ?>
<?php
  $db = get_db();
  
  $id = Dish::get_dish_restaurant($db, $dish->id);
  $restaurant = Restaurant::get_restaurant($db, $id);  
?>
  <div class="preview">
    <section class="info">
      <div class="order">
        <form method="post">
          <input id="shopping-bag" class="icon" type="image" src="../assets/icons/shopping_bag.svg">
        </form>
        <h1><?=$dish->name?></h1>
      </div>
      <h2><?=$restaurant->res_name?></h2>
      <div class="categories-container">
        <p>Category</p>
      </div>
      <div class="icons-container">
        <div class="price">
          <img id="price" class="icon" src="../assets/icons/price.svg">
          <p><?=$dish->price?></p>
        </div>
        <img id="favorite" class="icon" src="../assets/icons/favorite.svg">
      </div>
    </section>
    <section class="image-container">
      <img src="<?=$image?>.jpg" width="250" height="250" alt="Dish preview image">
    </section>
  </div>
<?php } ?>

<?php function draw_dish_form(Dish $dish) { ?>
  <form method="post">
    <label for="dish-name">
      Name<input id="dish-name" type="text" value="<?=$dish->name?>">
    </label>
    <label for="dish-price">
      Price<input id="dish-price" type="text" value="<?=$dish->price?>">
    </label>
    <div class="categories-container">
    <?php
      foreach($dish->categories as $category) {
        ?> <h5 class="preview-category"><?=$category?></h5>
      <?php } ?>
    </div>
    <button type="submit">Save</button>
  </form>
  <img src="../assets/temp.jpg" alt="restaurant's display image">
  <div id="buttons">
    <label id="file-upload">
      <input type="file" name="image">Choose file
    </label>
    <input type="submit" value="Send">
  </div>
<?php } ?>

<?php function edit_dish_form(Dish $dish) { ?>
  <div class="edit-dish">
    <h1>Edit dish</h1>
    <form method="post">
      <div class="dish-info">
        <label for="dish-name">
          Name<input id="dish-name" type="text" value="<?=$dish->name?>">
        </label>
        <label for="category">
          Categories<input type="text" placeholder="category">
        </label>
        <label for="price">
          Price<input id="price" type="text" value="<?=$dish->price?>">
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
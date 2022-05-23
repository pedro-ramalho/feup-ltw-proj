<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
?>

<?php function draw_dish(Dish $dish) { ?>
  <div class="dish-frontpage"> <!-- click event listener -->
    <img src="../assets/temp.jpg" alt="restaurant's preview image">
    <div class="dish-description">
      <p><?=$dish->name?></p>
      <p><?=$dish->price?>€</p>
    </div>
    <button class="favorite-restaurant">
      <img src="../assets/star.svg">
    </button>
  </div>
<?php } ?>

<?php function draw_dish_preview(Dish $dish) { ?>
<?php
  $db = get_db();
  
  $id = Dish::get_dish_restaurant($db, $dish->id);
  $restaurant = Restaurant::get_restaurant($db, $id);  
?>
  <div class="dish-preview">
    <h1 class="dish-preview-title"><?=$dish->name?></h1>
    <img src="../assets/temp.jpg" alt="dish's preview image">
    <p id="dish-price"><?=$dish->price?>€</p>
    <a id="dish-restaurant" href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->res_name?></a>
    <button class="favorite-dish">
      <img src="../assets/star.svg">
    </button>
    <div class="categories-container">
      <?php
      foreach($restaurant->categories as $category) {
        ?> <h5 class="preview-category"><?=$category?></h5>
      <?php } ?>
    </div>
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
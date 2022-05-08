<?php 
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/dish.class.php');
?>

<?php function draw_dish(Dish $dish) { ?>
  <div class="dish-container"> <!-- click event listener -->
    <button class="favorite-dish">+</button>
    <img src="https://picsum.photos/200" alt="dish image">
    <div class="dish-description">
      <p><?=$dish->name?></p>
      <p><?=$dish->price?>€</p>
    </div>
  </div>
<?php } ?>

<?php function draw_dish_preview(Dish $dish) { ?>
<?php
  $db = getDatabaseConnection();
  
  $id = Dish::get_dish_restaurant($db, $dish->id);
  $restaurant = Restaurant::get_restaurant($db, $id);  
?>
  <div class="dish-preview-container">
    <button class="favorite-dish">+</button>
    <img src="https://picsum.photos/200" alt="dish image">
    <div class="dish-preview-description">
      <p><?=$dish->name?></p>
      <p><?=$dish->price?>€</p>
      <a href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->res_name?></a>
    </div>
  </div>
<?php } ?>
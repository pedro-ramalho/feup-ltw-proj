<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/restaurant.class.php');
?>

<?php function draw_restaurant(Restaurant $restaurant) { ?>
  <div class="restaurant-frontpage">
    <h1 class="restaurant-title"><?=$restaurant->res_name?></h1>
    <img src="https://picsum.photos/200" alt="restaurant's display image">
    <h3><?=$restaurant->score?></h3>
    <button class="favorite-restaurant">+</button>
  </div>
<?php } ?>

<?php function draw_restaurant_preview(Restaurant $restaurant) { ?>
  <div class="restaurant-preview">
    <a href="restaurant.php?id=<?=$restaurant->id?>">
      <h1 class="restaurant-preview-title"><?=$restaurant->res_name?></h1>
      <img src="../assets/temp.jpg" alt="restaurant's preview image" width="1000" height="120">
      <h3><?=$restaurant->score?></h3>
      <button class=" "></button>
    </a>
  </div>
<?php } ?>
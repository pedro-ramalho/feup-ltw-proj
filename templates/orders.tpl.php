<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');

  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

?>

<!-- orders made by a customer -->
<?php function draw_customer_order(Order $order) { 
  $db = get_db();

  $restaurant = Restaurant::get_restaurant($db, $order->restaurant);
  $dish = Dish::get_dish($db, $order->dish);
?>
  <div class="order">
    <img src="../assets/temp.jpg" width="200" height="200">
    <div class="order-info">
      <h1><?=$restaurant->res_name?></h1>
      <h2><?=$dish->name?></h2>
      <h3><?=$dish->price?>€</h3>
      <h3 class="state"><?=$order->state?></h3>
    </div>
  </div>
<?php } ?> 

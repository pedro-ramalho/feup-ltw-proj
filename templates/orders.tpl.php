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
  <tr>
    <td><?=$order->id?></td><td><?=$restaurant->res_name?></td>
    <td><?=$dish->name?></td><td><?=$dish->price?>€</td><td><?=$order->state?></td>
  </tr>    
<?php } ?> 

<?php function draw_restaurant_order(Order $order) {
  $db = get_db();

  $restaurant = Restaurant::get_restaurant($db, $order->restaurant);
  $dish = Dish::get_dish($db, $order->dish);
  $user = User::get_user($db, $order->customer);
?>
  <tr>
    <td><?=$order->id?></td><td><?=$user->username?></td><td><?=$restaurant->res_name?></td>
    <td><?=$dish->name?></td><td><?=$dish->price?>€</td>
    <td>
      <form class="order-state-form" action="../actions/action_update_order_state.php" method="post">
      <input class="order-id-input" type="number" name="order_id" hidden="" value="<?=$order->id?>">
      <select class="order-state" name="order_state">
        <option value="received">received</option>
        <option value="preparing">preparing</option>
        <option value="ready">ready</option>
        <option value="delivered">delivered</option>
      </select>
      </form>
    </td>
  </tr>    
<?php } ?>

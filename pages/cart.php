<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  /* include database connection */
  require_once(__DIR__ . '/../database/connection.php');

  /* include classes */
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/review.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  /* include restaurant templates */
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');
  require_once(__DIR__ . '/../templates/review.tpl.php');

  $db = get_db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/previews.css">
  <link rel="stylesheet" href="../css/previews/preview_dish.css">
  <link rel="stylesheet" href="../css/pages/page_cart.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <title><?=$restaurant->res_name?></title>
  <script src="../javascript/header_scroll.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/favorite_button.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
  <script src="../javascript/orders.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <section id="orders-container">
    <?php if($session->thereAreOrders()) {
      foreach($session->getOrders() as $order) {
        $dish = Dish::get_dish($db, intval($order['dish_id']));
        ?>
        
        <form action="../actions/action_order_dish.php" method="post" class="order-form">
          <input type="number" name="dish_id" hidden="" value="<?=$dish->id?>" readonly="readonly">
          <input type="number" class="dish-quantity-form" name="dish_quantity" hidden="" value="<?=$order['quantity']?>">
          <input type="number" name="user_id" hidden="" value="<?=$order['user_id']?>">
          <input type="number" name="restaurant_id" hidden="" value="<?=$dish->restaurant?>">
          <p class="base-price" hidden=""><?=$dish->price?></p>
          <p class="order-dish-name"><?=$dish->name?></p> 
          <div class="quantity-container">
            <button type="button" class="increase-quantity">+</button>
            <p class="order-quantity"><?=$order['quantity']?></p>
            <button type="button" class="decrease-quantity">-</button>
          </div>
          <p class="order-price"><?=$dish->price*$order['quantity']?></p>
          <button class="remove-form-button">x</button>
        </form>
      <?php } ?>
      <button type="submit" id="submit-orders">Submit</button>
    <?php } 
    else { ?>
      <p class="no-orders-message">You have no orders!</p>
    <?php } ?>

    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
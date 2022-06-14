<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();


  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.php');
  
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');
  require_once(__DIR__ . '/../templates/orders.tpl.php');

  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
  require_once(__DIR__ . '/../classes/order.class.php');

  $db = get_db();

  $user = User::get_user($db, intval($session->getId()));

  $owned_restaurants = Restaurant::get_owned_restaurants($db, intval($session->getId()));
  $fav_restaurants = Restaurant::get_fav_restaurants($db, intval($session->getId()));
  $fav_dishes = Dish::get_fav_dishes($db, intval($session->getId()));
  $customer_orders = Order::get_customer_orders($db, $session->getId());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/previews.css">
  <link rel="stylesheet" href="../css/orders/orders_layout.css">
  <link rel="stylesheet" href="../css/orders/orders_customer.css">
  <link rel="stylesheet" href="../css/previews/preview_restaurant.css">
  <link rel="stylesheet" href="../css/previews/preview_dish.css">
  <link rel="stylesheet" href="../css/pages/page_profile.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <script src="../javascript/profile.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/favorite_button.js" defer></script>
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
  <script src="../javascript/header_scroll.js" defer></script>
  <script src="../javascript/update_order_states.js" defer></script>
  <title>Profile</title>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
  <nav id="profile-options">
    <div class="profile-section">
      <a id="acc-anchor" href="#" class="selected"><img src="../assets/icons/account.svg"> <p>Account</p></a>
    </div>
    <div class="profile-section">
      <a id="orders-anchor" href="#"><img src="../assets/icons/orders.svg"> <p>Orders</p></a>
    </div>
    <div class="profile-section">
      <a id="owned-res-anchor" href="#"><img src="../assets/icons/owner.svg"> <p>Owned restaurants</p></a>
    </div>
    <h1>Favorites</h1>
    <section id="favorites">
      <div class="profile-section">
        <a id="fav-dishes-anchor" href="#"><img src="../assets/icons/dish.svg"> <p>Favorite dishes</p></a>
      </div>
      <div class="profile-section">
        <a id="fav-res-anchor" href="#"><img src="../assets/icons/restaurant.svg"> <p>Favorite restaurants</p></a>
      </div>
    </section>
  </nav>
  <section id="option-content">
    <section id="user-credentials">
      <h1 class="content-header">Your profile</h1>
      <?php draw_profile_form($user) ?>
    </section>
    <section id="user-orders" hidden>
      <section class="orders" id="customer-orders">
        <h1 class="content-header">Your orders</h1>
        <table>
          <tr class="table-header">
            <td>Order</td><td>Restaurant</td><td>Dish</td><td>Price</td><td>State</td>
          </tr>        
          <?php 
            foreach ($customer_orders as $order)
              draw_customer_order($order);
          ?>
        </table>
      </section>
      <section class="orders" id="restaurant-orders">
        <h1 class="content-header">Orders made by other customers</h1>
          <table>
            <tr class="table-header">
              <td>Order</td><td>Customer</td><td>Restaurant</td><td>Dish</td><td>Price</td><td>State</td>
            </tr>
            <?php
              foreach ($customer_orders as $order)
                draw_restaurant_order($order);
            ?>
          </table>
          <button id="save-orders-state-button" class="save">Save</button>
      </section>
    </section>
    <section id="owned-restaurants" hidden>
      <a href="add_restaurant.php" id="add-restaurant-link">Create your own restaurant</a>
      
      <?php
      if ($owned_restaurants && count($owned_restaurants) > 0) {
        ?> <div class="preview-flex-container"> <?php
        foreach ($owned_restaurants as $owned_restaurant) {
          $stmt = $db->prepare('SELECT * FROM RestaurantImage WHERE restaurant_id = ? ORDER BY id DESC');
          $stmt->execute(array($owned_restaurant->id));
          $img = $stmt->fetch();

          $path = "../assets/img/default";
          
          if ($img) 
            $path = "../assets/img/preview/restaurants/" . $img['id'];

          draw_restaurant_preview($owned_restaurant, $path, $session);
        }
        ?></div><?php
      }
      else
        echo "<p class=\"none-found-message\">You own no restaurants yet. <a href=\"#\">Create your restaurant</a></p>"
      ?>
    </section>
    <section id="favorite-dishes" hidden>
      <h1 class="content-header">Your favorite dishes</h1>
      <?php
        if ($fav_dishes && count($fav_dishes) > 0) {
        ?> <div class="preview-flex-container"> <?php
          foreach ($fav_dishes as $fav_dish) {
            $stmt = $db->prepare('SELECT * FROM DishImage WHERE dish_id = ? ORDER BY id DESC');
            $stmt->execute(array($dish->id));
            $img = $stmt->fetch();
          
            $path = "../assets/img/default";
          
            if ($img) 
              $path = "../assets/img/preview/dishes/" . $img['id'];

            draw_dish_preview($fav_dish, $path, $session);
          }
          ?></div><?php
          }
        else
          echo "<p class=\"none-found-message\">You haven't favorited any dishes yet.</p>";
      ?>
    </section>
    <section id="favorite-restaurants" hidden>
      <h1 class="content-header">Your favorite restaurants</h1>
      
        <?php
          if ($fav_restaurants && count($fav_restaurants) > 0) {
            ?> <div class="preview-flex-container"> <?php
            foreach ($fav_restaurants as $fav_restaurant) {
              $stmt = $db->prepare('SELECT * FROM RestaurantImage WHERE restaurant_id = ? ORDER BY id DESC');
            $stmt->execute(array($fav_restaurant->id));
            $img = $stmt->fetch();

            $path = "../assets/img/default";
            
            if ($img) 
              $path = "../assets/img/preview/restaurants/" . $img['id'];
              draw_restaurant_preview($fav_restaurant, $path, $session);
            }
            ?></div><?php
          }
          else {
            echo "<p class=\"none-found-message\">You haven't favorited any restaurants yet.</p>";
          }
        ?>
      </div>
    </section>
  </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
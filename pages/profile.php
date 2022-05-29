<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

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

  $user = User::get_user($db, intval($_SESSION['id']));

  $owned_restaurants = Restaurant::get_owned_restaurants($db, intval($_SESSION['id']));
  $fav_restaurants = Restaurant::get_fav_restaurants($db, intval($_SESSION['id']));
  $fav_dishes = Dish::get_fav_dishes($db, intval($_SESSION['id']));
  $customer_orders = Order::get_customer_orders($db, $_SESSION['id']);
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
  <link rel="stylesheet" href="../css/orders/orders_layout.css">
  <link rel="stylesheet" href="../css/orders/orders_customer.css">
  <link rel="stylesheet" href="../css/previews/preview_restaurant.css">
  <link rel="stylesheet" href="../css/previews/preview_dish.css">
  <link rel="stylesheet" href="../css/pages/page_profile.css">

  <script src="../javascript/profile.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
  <title>Profile</title>
</head>
<body>
  <?php draw_sidebar() ?>
  <?php draw_header() ?>
  <main>
  <nav id="profile-options">
    <div class="profile-section">
      <img src="../assets/icons/account.svg"> 
      <a id="acc-anchor" href="#" class="selected">Account</a>
    </div>
    <div class="profile-section">
      <img src="../assets/icons/orders.svg">
      <a id="orders-anchor" href="#">Orders</a>
    </div>
    <div class="profile-section">
      <img src="../assets/icons/owner.svg">
      <a id="owned-res-anchor" href="#">Owned restaurants</a>
    </div>
    <h1>Favorites</h1>
    <section id="favorites">
      <div class="profile-section">
        <img src="../assets/icons/dish.svg">
        <a id="fav-dishes-anchor" href="#">Favorite dishes</a>
      </div>
      <div class="profile-section">
        <img src="../assets/icons/restaurant.svg">
        <a id="fav-res-anchor" href="#">Favorite restaurants</a>
      </div>
    </section>
  </nav>
  <section id="option-content">
    <section id="user-credentials">
      <h1 class="content-header">Your profile</h1>
      <?php draw_profile_form($user) ?>
    </section>


    <section id="user-orders">
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
        <form method="post" action="#">
          <table>
            <tr class="table-header">
              <td>Order</td><td>Customer</td><td>Restaurant</td><td>Dish</td><td>Price</td><td>State</td>
            </tr>
            <?php
              foreach ($customer_orders as $order)
                draw_restaurant_order($order);
            ?>
          </table>
          <button class="save" type="submit">Save</button>
        </form>
      </section>
    </section>

    <section id="owned-restaurants" hidden>
      <?php
      if ($owned_restaurants && count($owned_restaurants) > 0) {
        echo "<a href=\"#\" id=\"add-restaurant-link\">+</a>";
        foreach ($owned_restaurants as $owned_restaurant)
          draw_restaurant_preview($owned_restaurant);
      }
      else
        echo "<p class=\"none-found-message\">You own no restaurants yet. <a href=\"#\">Create your restaurant</a></p>"
      ?>
    </section>
    <section id="favorite-dishes" hidden>
      <h1 class="content-header">Your favorite dishes</h1>
      <?php
        if ($fav_dishes && count($fav_dishes) > 0)
          foreach ($fav_dishes as $fav_dish)
            draw_dish_preview($fav_dish);
        else
          echo "<p class=\"none-found-message\">You haven't favorited any dishes yet.</p>";
      ?>
    </section>
    <section id="favorite-restaurants" hidden>
      <h1 class="content-header">Your favorite restaurants</h1>
      <?php
        if ($fav_restaurants && count($fav_restaurants) > 0)
          foreach ($fav_restaurants as $fav_restaurant)
            draw_restaurant_preview($fav_restaurant);
        else
          echo "<p class=\"none-found-message\">You haven't favorited any restaurants yet!</p>";
      ?>
    </section>
  </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.php');
  
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');

  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  $db = get_db();

  $user = User::get_user($db, intval($_SESSION['id']));

  $owned_restaurants = Restaurant::get_owned_restaurants($db, intval($_SESSION['id']));
  $fav_restaurants = Restaurant::get_fav_restaurants($db, intval($_SESSION['id']));
  $fav_dishes = Dish::get_fav_dishes($db, intval($_SESSION['id']));
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
    <a id="acc-anchor" href="#" class="selected">Account</a>
    <a id="owned-res-anchor" href="#">Owned restaurants</a>
    <h1>Favorites</h1>
    <section id="favorites">
      <a id="fav-dishes-anchor" href="#">Favorite dishes</a>
      <a id="fav-res-anchor" href="#">Favorite restaurants</a>
    </section>
  </nav>
  <section id="option-content">
    <section id="user-credentials">
      <?php draw_profile_form($user) ?>
    </section>
    <section id="owned-restaurants" hidden>
      <?php foreach ($owned_restaurants as $owned_restaurant)
              draw_restaurant_preview($owned_restaurant);
      ?>
    </section>
    <section id="favorite-dishes" hidden>
      <?php foreach ($fav_dishes as $fav_dish)
              draw_dish_preview($fav_dish);
      ?>
    </section>
    <section id="favorite-restaurants" hidden>
      <?php foreach ($fav_restaurants as $fav_restaurant)
              draw_restaurant_preview($fav_restaurant);
      ?>
    </section>
  </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
<?php
  
  /* include and start a new session */

  require_once('utils/session.php');

  $session = new Session();


  /* include templates */

  require_once('templates/common.php');
  require_once('templates/restaurant.tpl.php');
  require_once('templates/dish.tpl.php');
  
  
  /* include classes */

  require_once('classes/restaurant.class.php');
  require_once('classes/dish.class.php');

  
  define("NUMBER_OF_ITEMS", 4);


  /* quick database access to fetch some restaurants and dishes */

  $db = new PDO('sqlite:' . __DIR__ . '/database/restaurant.db');
  
  $restaurants = Restaurant::get_limited_restaurants($db, NUMBER_OF_ITEMS);
  $dishes = Dish::get_limited_dishes($db, NUMBER_OF_ITEMS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/stickers.css">
  <link rel="stylesheet" href="css/pages/page_index.css">
  <link rel="icon" href="assets/logo/favicon.png">
  <title>Agile Eating</title>
  <script src="javascript/header_scroll.js" defer></script>
  <script src="javascript/sidebar_button.js" defer></script>
  <script src="javascript/dynamic_search.js" defer></script>
  <script src="javascript/messages.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main id="main-page">

    <section id="frontpage">
      <section id="slogan">
        <h1>Agile Eating - fast and simple</h1>
        <p>Discover amazing places to eat, tasteful dishes to enjoy</p>
        <p>Join our community!</p>
        <div id="slogan-anchors">
          <a href="pages/sign_in.php">Sign in</a>
          <a href="pages/sign_up.php">Sign up</a>
        </div>
      </section>
      <img src="assets/frontpage_v2.png" id="frontpage-img">
    </section>

    <section id="categories">
      <div id="categories-header">
        <img src="assets/icons/category.svg" class="icon">
        <h1>Categories</h1>
      </div>
      <div id="categories-container">
        <p>FAST-FOOD</p>
        <p>PREMIUM</p>
        <p>AFFORDABLE</p>
        <p>DIET</p>
        <p>VEGAN</p>
        <p>VEGETARIAN</p>
        <p>SUSHI</p>
        <p>LACTOSE-FREE</p>
        <p>FAST-FOOD</p>
      </div>    
    </section>

    <section id="main-suggestions">
      <section class="suggestions">
        <div class="suggestions-header">
          <h1 class="suggestion-title">Popular restaurants</h1>
          <a href="pages/list_restaurants.php" class="suggestions-anchor">SEE MORE</a>
        </div>
        <div class="images">
          <?php 
            foreach($restaurants as $restaurant) {
              $stmt = $db->prepare('SELECT * FROM RestaurantImage WHERE restaurant_id = ? ORDER BY id DESC');
              $stmt->execute(array($restaurant->id));
              $img = $stmt->fetch();

              $path = "../assets/img/default";
              
              if ($img) 
                $path = "../assets/img/preview/restaurants/" . $img['id'];
              
              draw_restaurant_showcase($restaurant, $path);
            } 
          ?>
        </div>
      </section>

      <section class="suggestions">
        <div class="suggestions-header">
          <h1 class="suggestion-title">Popular dishes</h1>
          <a href="pages/list_dishes.php" class="suggestions-anchor">SEE MORE</a>
        </div>
        <div class="images">
          <?php 
            foreach($dishes as $dish) {
              $stmt = $db->prepare('SELECT * FROM DishImage WHERE dish_id = ? ORDER BY id DESC');
              $stmt->execute(array($dish->id));
              $img = $stmt->fetch();

              $path = "../assets/img/default";
              
              if ($img) 
                $path = "../assets/img/preview/dishes/" . $img['id'];
              
              draw_dish_showcase($dish, $path);
            } 
          ?>
        </div>
      </section>
    </section>

    <?php draw_stickers(); ?>

  </main>

  <?php draw_footer() ?>
</body>
</html>
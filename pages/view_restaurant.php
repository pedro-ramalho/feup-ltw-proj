<?php
  declare(strict_types = 1);

  session_start();

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
  
  $restaurant_id = intval($_GET['id']);

  $restaurant = Restaurant::get_restaurant($db, $restaurant_id);
  $dishes = Dish::get_restaurant_dishes($db, $restaurant_id);
  $reviews = Review::get_restaurant_reviews($db, $restaurant_id);
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
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/pages/page_view_restaurant.css">
  <title>Document</title>
  <script src="../javascript/header_scroll.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
</head>
<body>
  <?php draw_sidebar() ?>
  <?php draw_header() ?>
  <main>
    <section id="restaurant-info">
      <?php draw_restaurant($restaurant) ?>
    </section>
    <section id="restaurant-dishes">
      <h1>Dishes</h1>
      <div class="dishes-container">
      <?php
        foreach ($dishes as $dish)
          draw_dish($dish);
      ?>
      </div>
    </section>
    <section id="restaurant-reviews">
      <h1>Reviews</h1>
      <div class="reviews-container">
        <?php 
          draw_review_form($restaurant_id);
          foreach ($reviews as $review) 
            draw_review($review);
        ?>
      </div>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
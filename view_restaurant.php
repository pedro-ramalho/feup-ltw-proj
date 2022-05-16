<?php
  declare(strict_types = 1);

  session_start();

  /* include database connection */
  require_once('database/connection.php');

  /* include classes */
  require_once('database/classes/restaurant.class.php');
  require_once('database/classes/review.class.php');

  /* include restaurant templates */
  require_once('templates/restaurant.tpl.php');


  $db = get_db_extended_path();
  
  $restaurant_id = intval($_GET['id']);

  $restaurant = Restaurant::get_restaurant($db, $restaurant_id);
  $reviews = Review::get_restaurant_reviews($db, $restaurant_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <main>
    <section id="restaurant-info">
      <?php draw_restaurant($restaurant) ?>
    </section>
    <section id="restaurant-reviews">
      <?php foreach ($reviews as $review) ?>
    </section>
  </main>
</body>
</html>
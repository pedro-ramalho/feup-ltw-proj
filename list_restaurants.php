<?php
  declare(strict_types = 1);

  session_start();

  /* include database connection */
  require_once('database/connection.php');
  
  /* include restaurant class */
  require_once('database/classes/restaurant.class.php');

  /* include templates */
  require_once('templates/common.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::get_all_restaurants($db);
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
  <?php draw_header() ?>
  <section id="restaurant-previews">
    <?php 
      foreach($restaurants as $restaurant) 
        draw_restaurant_preview($restaurant); 
    ?>
  </section>
  <?php draw_footer() ?>
</body>
</html>
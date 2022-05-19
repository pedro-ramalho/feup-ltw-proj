<?php 
  declare(strict_types = 1);  

  session_start();

  if(!isset($_SESSION['id'])) die(header('Location: /sign_in.php'));

  /* include database connection */
  require_once('database/connection.php');

  /* include classes */
  require_once('database/classes/restaurant.class.php');
  require_once('database/classes/dish.class.php');

  /* include restaurant templates */
  require_once('templates/common.php');
  require_once('templates/restaurant.tpl.php');
  require_once('templates/dish.tpl.php');

  $db = get_db_extended_path();
  
  $restaurant_id = intval($_GET['id']);
  
  $restaurant = Restaurant::get_restaurant($db, $restaurant_id);
  $dishes = Dish::get_restaurant_dishes($db, $restaurant_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/pages/edit-restaurant-page.css">
  <title>Edit Restaurant</title>
</head>
<body>
  <?php draw_header(); ?>
  <main>
    <section id="restaurant-info">
      <?php draw_restaurant_form($restaurant) ?>
    </section>
  </main>
  <?php draw_footer(); ?>
</body>
</html>
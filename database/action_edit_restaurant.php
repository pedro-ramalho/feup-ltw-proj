<?php
  declare(strict_types = 1);

  session_start();

  require_once('connection.php');
  require_once('classes/restaurant.class.php');
  require_once('classes/dish.class.php');

  $db = get_db_simple_path();

  $restaurant = Restaurant::get_restaurant($db, intval($_POST['restaurant-id']));
  $dishes = Dish::get_restaurant_dishes($db, ($_POST['restaurant-id']));

  if ($restaurant) {
    /* 
    $restaurant->res_name = $_POST['res-name'];
    $restaurant->categories = $_POST['categories'];
    
    foreach ($dishes as $dish) {
      $dish->name = ;
      $dish->price = ;
    }

    $restaurant->save($db);
    $dish->save($db);
    */
  }
?>
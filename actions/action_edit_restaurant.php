<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');

  $session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  $db = get_db();

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
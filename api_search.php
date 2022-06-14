<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/database/connection.php');
  require_once(__DIR__ . '/classes/restaurant.class.php');
  require_once(__DIR__ . '/classes/dish.class.php');

  $db = get_db();
  
  $restaurants = Restaurant::search_restaurants($db, $_GET['search'], 5);
  $dishes = Dish::search_dishes($db, $_GET['search'], 5);

  echo json_encode(Array($restaurants, $dishes));
?>
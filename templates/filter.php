<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  function array_contains($superset, $set) : bool {
    foreach($set as $elem)
      if (!in_array($elem, $superset))
        return false;
    
    return true;
  }

  function filter_restaurants(float $min_score, float $max_score, $categories) : array {
    $db = get_db();

    $restaurants = Restaurant::get_all_restaurants($db);
    $filtered_restaurants = array();

    foreach ($restaurants as $restaurant) 
      if (floatval($restaurant->score) >= $min_score && 
          floatval($restaurant->score) <= $max_score &&
          array_contains($restaurant->categories, $categories))
          
          $filtered_restaurants[] = new Restaurant(
            intval($restaurant->id),
            intval($restaurant->owner_id),
            floatval($restaurant->score),
            $restaurant->categories,
            $restaurant->res_name,
            $restaurant->addr,
            $restaurant->coords
          );
    
    return $filtered_restaurants;
  }

  function filter_dishes(float $min_price, float $max_price, $categories) : array {
    $db = get_db();

    $dishes = Dish::get_all_dishes($db);
    $filtered_dishes = array();

    foreach ($dishes as $dish) 
      if (floatval($dish->price) >= $min_price &&
          floatval($dish->price) <= $max_price &&
          array_contains($dish->categories, $categories))

          $filtered_dishes[] = new Dish(
            intval($dish->id),
            intval($dish->restaurant),
            floatval($dish->price),
            $dish->name,
            $categories
          );
    
    return $filtered_dishes;
  }
?>

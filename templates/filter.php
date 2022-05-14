<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/classes/restaurant.class.php');

  function array_contains($superset, $set) : bool {
    foreach($set as $elem)
      if (!in_array($elem, $superset))
        return false;
    
    return true;
  }

  function filter_restaurants(float $min_score, float $max_score, $categories) : array {
    $db = getDatabaseConnection();

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
?>

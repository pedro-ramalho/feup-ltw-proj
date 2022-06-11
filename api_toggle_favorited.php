<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/utils/session.php');
  
  $session = new Session();

  require_once(__DIR__ . '/database/connection.php');
  require_once(__DIR__ . '/classes/dish.class.php');
  require_once(__DIR__ . '/classes/restaurant.class.php');

  $db = get_db();

  
  $usID = $session->getId();
  $response = [];

  if (!$session->isLoggedIn()) {
    $response['response'] = 'error';
  }
  else if (isset($_GET['dish'])) {
    if (Dish::is_favorited($db, $usID, intval($_GET['dish']))) {
      $stmt = $db->prepare('DELETE FROM FavoriteDish WHERE dish = ? AND user = ?');
      $stmt->execute(array(intval($_GET['dish']), $usID));
      $response['response'] = 'unfavorited'; 
    } 
    else {
      $stmt = $db->prepare('INSERT INTO FavoriteDish (dish, user) values (?, ?)');
      $stmt->execute(array(intval($_GET['dish']), $usID));
      $response['response'] = 'favorited';
    }
  }
  else if (isset($_GET['res'])) {
    if (Restaurant::is_favorited($db, $usID, intval($_GET['res']))) {
      $stmt = $db->prepare('DELETE FROM FavoriteRestaurant WHERE restaurant = ? AND user = ?');
      $stmt->execute(array(intval($_GET['res']), $usID));
      $response['response'] = 'unfavorited'; 
    } 
    else {
      $stmt = $db->prepare('INSERT INTO FavoriteRestaurant (restaurant, user) values (?, ?)');
      $stmt->execute(array(intval($_GET['res']), $usID));
      $response['response'] = 'favorited';
    }
  } 
  else {
    $response['response'] == 'error';
  }
  echo json_encode($response);
?>
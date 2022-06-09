<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/utils/session.php');
  
  $session = new Session();

  require_once(__DIR__ . '/database/connection.php');
  require_once(__DIR__ . '/classes/dish.class.php');

  $db = get_db();

  $usID = $session->getId();
  $response = [];
  

  if (Dish::is_favorited($db, $usID, intval($_GET['dish']))) {
    $stmt = $db->prepare('DELETE FROM FavoriteDish WHERE dish = ? AND user = ?');
    $stmt->execute(array($_GET['dish'], $usID));
    $response['response'] = 'unfavorited'; 
  } 
  else {
    $stmt = $db->prepare('INSERT INTO FavoriteDish (dish, user) values (?, ?)');
    $stmt->execute(array($_GET['dish'], $usID));
    $response['response'] = 'favorited';
  }

  echo json_encode($response);
?>
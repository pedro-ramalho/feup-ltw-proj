<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();


  if (!isset($_SESSION['id']))
    die();


  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  $state = $_POST['order_state'];
  $order_id = intval($_POST['order_id']);

  $stmt = $db->prepare('UPDATE OrderDish SET curr_state = ? WHERE id = ?');
  $stmt->execute(array($state, $order_id));  
?>
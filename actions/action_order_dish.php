<?php
  declare(strict_types = 1);

  session_start();
  
  if (!isset($_SESSION['id']))
    die();

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
  require_once(__DIR__ . '/../classes/order.class.php');

  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();
?>
<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id']))
    die();
  
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../utils/validation.php');

  $owner_id = intval($_POST['owner-id']);

  $restaurant_name = $_POST['res-name'];
  $restaurant_category = $_POST['res-category'];
  $restaurant_address = $_POST['res-address'];
  $restaurant_coordinates = $_POST['res-coords'];

  $db = get_db();

  if (!valid_restaurant_name($restaurant_name)) {
    echo 'Invalid restaurant name';
    die();
  }

  if (!valid_category($restaurant_category)) {
    echo 'Invalid category';
    die();
  }

  if (!valid_address($restaurant_address)) {
    echo 'Invalid address';
    die();
  }

  if (!valid_coordinates($restaurant_coordinates)) {
    echo 'Invalid coordinates';
    die();
  }

  Restaurant::add_restaurant(
    $db, $owner_id, $restaurant_name, $restaurant_address, $restaurant_coordinates
  );

  header('Location: ../index.php'); 
?>
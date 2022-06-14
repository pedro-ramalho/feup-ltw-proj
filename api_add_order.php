<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/database/connection.php');
  require_once(__DIR__ . '/classes/restaurant.class.php');
  require_once(__DIR__ . '/classes/dish.class.php');

  $response = array();
  if (!isset($_GET['dish_id'])) {
    $response['response'] = 'error';
    echo json_encode($response);
    die();
  }

  $session->addOrder(intval($_GET['dish_id']));
  $response['response'] = 'success';

  echo json_encode($response);
?>
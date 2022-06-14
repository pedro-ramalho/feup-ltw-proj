<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    $session->addMessage("error", "You need to be logged in!");
    header('Location: localhost:9000/pages/sign-in.php');
    die();
  }
  

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
  require_once(__DIR__ . '/../classes/order.class.php');

  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  if (!isset($_POST['user_id']) || !isset($_POST['dish_id']) || !isset($_POST['dish_quantity']) || !isset($_POST['restaurant_id'])) {
    $session->addMessage("error", "There was an error processing that order!");
    die();
  }

  $user_id = intval($_POST['user_id']);
  $dish_id = intval($_POST['dish_id']);
  $dish_quantity = intval($_POST['dish_quantity']);
  $restaurant_id = intval($_POST['restaurant_id']);
  if ($dish_quantity === 0) {
    die();
  }

  $stmt = $db->prepare("INSERT INTO OrderDish(customer, curr_state) VALUES (?, 'received')");
  $stmt->execute(array($user_id));

  $a_stmt = $db->prepare("SELECT id FROM OrderDish ORDER BY id DESC");
  $a_stmt->execute();
  $order_dish = intval($a_stmt->fetch()['id']);


  $another_stmt = $db->prepare("INSERT INTO DishQuantity (order_dish, dish, quantity) VALUES (?, ?, ?)");
  $another_stmt->execute(array($order_dish, $dish_id, $dish_quantity));
?>
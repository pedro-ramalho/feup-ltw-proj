<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id']))
    die();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/review.class.php');

  $db = get_db();

  if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['review-comment'])) {
    echo 'The review can only contain numbers, letters and whitespaces';
    die();
  }

  Review::add_review(
    $db, intval($_SESSION['id']), intval($_POST['restaurant-id']), 
    intval($_POST['review-score']), $_POST['review-comment']
  );

  header('Location: ../index.php');
?>
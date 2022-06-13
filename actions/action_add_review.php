<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    $session->addMessage("error", "Login to be able to add a review");
    header('Location: localhost:9000/pages/sign-in.php');
    die();
  }
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/review.class.php');
  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  if (!valid_review($_POST['review-comment'])) {
    $session->addMessage("error", "The review you tried to enter contained invalid characters. Please try again.");
    header("Location:".$_SERVER['HTTP_REFERER']);
    die();
  }

  Review::add_review(
    $db, intval($_SESSION['id']), intval($_POST['restaurant-id']), 
    intval($_POST['review-score']), $_POST['review-comment']
  );

  $session->addMessage("success", "Review added.");
  header("Location:".$_SERVER['HTTP_REFERER']);
?>
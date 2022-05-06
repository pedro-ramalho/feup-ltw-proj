<?php
  declare(strict_types = 1);

  session_start();

  require_once('connection.php');
  require_once('classes/user.class.php');

  $db = getDatabaseConnection();

  $user = User::get_user_from_credentials($db, $_POST['username'], $_POST['password']);
  
  if ($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->username;
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
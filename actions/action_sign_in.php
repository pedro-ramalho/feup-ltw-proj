<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');

  $db = get_db();

  $user = User::get_user_from_credentials($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->username;
  }

  header('Location: ../index.php');
?>
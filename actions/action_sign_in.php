<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');

  $session = new Session();
  
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');

  $db = get_db();

  $user = User::get_user_from_credentials($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $session->setId($user->id);
    $session->setName($user->username);
    $session->addMessage("success", "Logged in successfuly");
    header('Location: ../index.php');
  }
  else {
    $session->addMessage("error", "Login was not successful");
    header('Location: ../pages/sign_in.php');
  }
?>
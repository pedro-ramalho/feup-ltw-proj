<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../classes/user.class.php');

  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  $new_username = $_POST['username'];
  $new_address = $_POST['address'];
  $new_phone_nr = $_POST['phone-number'];

  echo "<script>console.log($new_username, $new_address, $new_phone_nr)</script>";

  $password = $_POST['password'];

  if (!valid_username($new_username)) {
    echo 'Invalid username';
    die();
  }

  if (!valid_address($new_address)) {
    echo 'Invalid address';
    die();
  } 

  if (!valid_phone_nr($new_phone_nr)) {
    echo 'Invalid phone number';
    die();
  }

  if (!password_verify($password, User::get_user_password($db, $_SESSION['id']))) {
    echo 'Invalid password';
    die();
  }

  User::update_user($db, $_SESSION['id'], $new_username, $new_address, $new_phone_nr);

  header('Location: ../index.php');
?>
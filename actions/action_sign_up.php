<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');

  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  if (!valid_username($_POST['username'])) {
    echo 'Invalid username';
    die();
  }

  if (!valid_password($_POST['password'])) {
    echo "Invalid password";
    die();
  }

  if (!passwords_match($_POST['password'], $_POST['confirm-password'])) {
    echo 'Passwords do not match';
    die();
  }

  if (!valid_phone_nr($_POST['phone-number'])) {
    echo 'Invalid phone number';
    die();
  }

  if (!valid_address($_POST['address'])) {
    echo 'Invalid address';
    die();
  }

  User::register_user($db, $_POST['username'], $_POST['password'], $_POST['address'], $_POST['phone-number']);

  header('Location: ../index.php');
?>
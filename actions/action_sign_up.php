<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');

  $db = get_db();

  /* the username can only contain lowercase/uppercase characters and numbers */
  if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])) {
    echo 'Invalid username';
    die();
  }

  /* the password must contain at least a lowercase character, an uppercase character, a number and a '#', '$' and '%' */
  if (!preg_match("/^[a-z]+[A-Z]+[0-9]+[\#]+[\$]+[\%]+/", $_POST['password'])
      || strlen($_POST['password']) < 8) {
    echo "Invalid password";
    die();
  }

  if (strcmp($_POST['password'], $_POST['confirm-password']) != 0) {
    echo 'Passwords do not match';
    die();
  }

  /* the phone number must contain exactly 9 numbers and 9 numbers only */
  if (!preg_match("/[0-9]{9}/", $_POST['phone-number'])) {
    echo 'Invalid phone number';
    die();
  }

  /* the address can only contain lowercase/uppercase characters and numbers */
  if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['address'])) {
    echo 'Invalid address';
    die();
  }

  User::register_user($db, $_POST['username'], $_POST['password'], $_POST['address'], $_POST['phone-number']);

  header('Location: ../index.php');
?>
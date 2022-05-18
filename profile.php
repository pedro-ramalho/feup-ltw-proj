<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('database/connection.php');
  
  require_once('templates/common.php');

  require_once('database/classes/user.class.php');
  require_once('database/classes/restaurant.class.php');
  require_once('database/classes/dish.class.php');

  $db = get_db_extended_path();

  $customer = User::get_user($db, intval($_SESSION['id']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Profile</title>
</head>
<body>
  <?php draw_header() ?>
  <main>

  </main>
  <?php draw_footer() ?>
</body>
</html>
<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('database/connection.php');
  
  require_once('templates/common.php');
  require_once('templates/profile.tpl.php');

  require_once('database/classes/user.class.php');
  require_once('database/classes/restaurant.class.php');
  require_once('database/classes/dish.class.php');

  $db = get_db_extended_path();

  $user = User::get_user($db, intval($_SESSION['id']));
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
  <link rel="stylesheet" href="css/pages/profile.css">
  <title>Profile</title>
</head>
<body>
  <?php draw_header() ?>
  <main>
  <nav id="profile-options">
    <a href="#">Account</a>
    <a href="#">Owned restaurants</a>
    <section id="favorites">
      <h1>Favorites</h1>
      <a href="#">Favorite dishes</a>
      <a href="#">Favorite restaurants</a>
    </section>
  </nav>
  <section id="option-content">
    <section id="account">
      <?php draw_profile_form($user) ?>
    </section>
    <section id="owned-restaurants">

    </section>
    <section id="favorite-dishes">

    </section>
    <section id="favorite-restaurants">

    </section>
  </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
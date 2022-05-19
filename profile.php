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
  <script src="javascript/profile.js" defer></script>
  <title>Profile</title>
</head>
<body>
  <?php draw_header() ?>
  <main>
  <nav id="profile-options">
    <a id="acc-anchor" href="#">Account</a>
    <a id="owned-res-anchor" href="#">Owned restaurants</a>
    <h1>Favorites</h1>
    <section id="favorites">
      <a id="fav-dishes-anchor" href="#">Favorite dishes</a>
      <a id="fav-res-anchor" href="#">Favorite restaurants</a>
    </section>
  </nav>
  <section id="option-content">
    <section id="user-credentials">
      <?php draw_profile_form($user) ?>
    </section>
    <section id="owned-restaurants" hidden>
      <p>Owned restaurants</p>
    </section>
    <section id="favorite-dishes" hidden>
      <p>Fav dishes</p>
    </section>
    <section id="favorite-restaurants" hidden>
      <p>Fav restaurants</p>
    </section>
  </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
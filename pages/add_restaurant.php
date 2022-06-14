<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if(!$session->isLoggedIn()) die(header('Location: /sign_in.php'));

  /* include database connection */
  require_once(__DIR__ . '/../database/connection.php');

  /* include classes */
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  /* include restaurant templates */
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/pages/main-page.css">
  <link rel="stylesheet" href="../css/pages/page_add_restaurant.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/messages.js"  defer></script>
  <script src="../javascript/header_scroll.js"  defer></script>
  <script src="../javascript/categories.js" defer></script>
  <title>Setup Restaurant</title>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <?php draw_restaurant_setup($session->getId()) ?>
  </main>
  <?php draw_footer() ?>
</body>
</html>

<?php
  declare(strict_types = 1);

  session_start();

  if(!isset($_SESSION['id'])) die(header('Location: /sign_in.php'));

  /* include database connection */
  require_once(__DIR__ . '/../database/connection.php');

  /* include classes */
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  /* include restaurant templates */
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');

  $db = get_db();
  
  $restaurant_id = intval($_GET['id']);
  
  $restaurant = Restaurant::get_restaurant($db, $restaurant_id);
  $dishes = Dish::get_restaurant_dishes($db, $restaurant_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/pages/page_edit_dishes.css">
  <title>Edit Dishes</title>
  <script src="../javascript/sidebar_button.js" defer></script>
</head>
<body>
  <?php draw_sidebar() ?>
  <?php draw_header(); ?>
  <main>
    <div id="edit-dishes">
      <?php foreach($dishes as $dish) { ?>
        <section class="dishes">
          <?php edit_dish_form($dish) ?>
          <?php edit_dish_form($dish) ?>
        </section>
      <?php } ?>
    </div>
  </main>
  <?php draw_footer(); ?>
</body>
</html>
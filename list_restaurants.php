<?php
  declare(strict_types = 1);

  session_start();

  /* include database connection */
  require_once('database/connection.php');
  
  /* include restaurant class */
  require_once('database/classes/restaurant.class.php');

  /* include templates */
  require_once('templates/common.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::get_all_restaurants($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/list-restaurants-page.css">
  <title>Restaurants</title>
</head>
<body>
  <?php draw_header() ?>
  <main>
    <section id="restaurant-previews">
      <?php 
        foreach($restaurants as $restaurant) 
          draw_restaurant_preview($restaurant); 
      ?>
    </section>
    <aside id="restaurant-filter">
      <h1>Choose a filter</h1>
      <form action="#" method="post">
        <section id="restaurant-score">
          <h1>Score</h1>
          <input type="checkbox" name="score" value="score">Score
        </section>
        <section id="restaurant-category">
          <h1>Categories</h1>
          <input type="checkbox" name="category" value="category">Fast-food
          <input type="checkbox" name="category" value="category">Premium
          <input type="checkbox" name="category" value="category">Affordable
          <input type="checkbox" name="category" value="category">Sushi
          <input type="checkbox" name="category" value="category">Vegan
        </section>
        <button type="submit">Apply</button>
      </form>
    </aside>
  </main>
  <?php draw_footer() ?>
</body>
</html>
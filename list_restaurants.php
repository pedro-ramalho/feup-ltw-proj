<?php
  declare(strict_types = 1);

  session_start();

  /* include restaurant class */
  require_once('database/classes/restaurant.class.php');

  /* include templates */
  require_once('templates/common.php');
  require_once('templates/restaurant.tpl.php');
  require_once('templates/filter.php');

  $min_score = !isset($_GET['min_score']) ? 0.0 : floatval($_GET['min_score']);
  $max_score = !isset($_GET['max_score']) ? 5.0 : floatval($_GET['max_score']);

  if ($min_score > $max_score) {
    $min_score = 0;
  }

  $categories = array();

  if (isset($_GET['fast-food'])) $categories[] = 'Fast-food';
  if (isset($_GET['premium'])) $categories[] = 'Premium';
  if (isset($_GET['affordable'])) $categories[] = 'Affordable';
  if (isset($_GET['sushi'])) $categories[] = 'Sushi';
  if (isset($_GET['vegan'])) $categories[] = 'Vegan';

  $restaurants = filter_restaurants($min_score, $max_score, $categories);
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
      <form action="list_restaurants.php" method="get">
        <section id="restaurant-score">
          <h1>Score</h1>
          <input id="min-score" type="number" name="min_score" min="0" max="5" value="0"><label for="min-score">Min</label>
          <input id="max-score" type="number" name="max_score" min="0" max="5" value="5"><label for="max-score">Max</label>
        </section>
        <section id="restaurant-category">
          <h1>Categories</h1>
          <input id="fast-food" type="checkbox" name="fast-food" value="Fast-food"> <label for="fast-food">Fast-food</label>
          <input id="premium" type="checkbox" name="premium" value="Premium"><label for="premium">Premium</label>
          <input id="affordable" type="checkbox" name="affordable" value="Affordable"><label for="affordable">Affordable</label>
          <input id="sushi" type="checkbox" name="sushi" value="Sushi"><label for="sushi">Sushi</label>
          <input id="vegan" type="checkbox" name="vegan" value="Vegan"><label for="vegan">Vegan</label>
        </section>
        <button type="submit">Apply</button>
      </form>
    </aside>
  </main>
  <?php draw_footer() ?>
</body>
</html>
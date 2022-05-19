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

  if ($min_score > $max_score) 
    $min_score = 0;
  
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
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/restaurant-preview.css">
  <link rel="stylesheet" href="css/categories.css">
  <link rel="stylesheet" href="css/pages/list-restaurants-page.css">
  <title>Restaurants</title>
  <script src="javascript/header-scroll.js" defer></script>
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
          <div id="score-input-container">
            <label for="min-score">
              Min<input id="min-score" class="score-number" type="number" name="min_score" min="0" max="5" value="0">
            </label>
            <label for="max-score">
              Max<input id="max-score" class="score-number" type="number" name="max_score" min="0" max="5" value="5">
            </label>
          </div>
        </section>
        <section id="restaurant-category">
          <h1>Categories</h1>
          <div id="category-input-container">
            <label for="fast-food">
              <input id="fast-food" class="category-checkbox" type="checkbox" name="fast-food" value="Fast-food">Fast-food
            </label>
            <label for="premium">
              <input id="premium" class="category-checkbox" type="checkbox" name="premium" value="Premium">Premium
            </label>
            <label for="affordable">
              <input id="affordable" class="category-checkbox" type="checkbox" name="affordable" value="Affordable">Affordable
            </label>
            <label for="sushi">
              <input id="sushi" class="category-checkbox" type="checkbox" name="sushi" value="Sushi">Sushi
            </label>
            <label for="vegan">
              <input id="vegan" class="category-checkbox" type="checkbox" name="vegan" value="Vegan">Vegan
            </label>
            <label for="vegetarian">
              <input id="vegetarian" class="category-checkbox" type="checkbox" name="vegetarian" value="Vegetarian">Vegetarian
            </label>
          </div>
        </section>
        <button type="submit">Apply</button>
      </form>
    </aside>
  </main>
  <?php draw_footer() ?>
</body>
</html>
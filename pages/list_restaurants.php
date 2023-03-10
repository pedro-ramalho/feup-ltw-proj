<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();


  /* include restaurant class */
  require_once(__DIR__ . '/../classes/restaurant.class.php');

  /* include templates */
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/filter.php');

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

  $db = get_db();
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
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/filter.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/previews.css">
  <link rel="stylesheet" href="../css/pages/page_list_restaurants.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <title>Restaurants</title>
  <script src="../javascript/header_scroll.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/score.js" defer></script>
  <script src="../javascript/categories.js" defer></script>
  <script src="../javascript/favorite_button.js" defer></script>
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <aside id="restaurant-filter">
      <h1>Choose a filter</h1>
      <form action="list_restaurants.php" method="get">
        <section id="restaurant-score">
          <h1>Score</h1>
          <div class="number-input" id="score-input-container">
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
          <div class="category-input-container">
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
        <button class="apply" type="submit">Apply</button>
      </form>
    </aside>
    <section id="restaurant-previews">
      <?php 
        foreach($restaurants as $restaurant) {
          $stmt = $db->prepare('SELECT * FROM RestaurantImage WHERE restaurant_id = ? ORDER BY id DESC');
          $stmt->execute(array($restaurant->id));
          $img = $stmt->fetch();

          $path = "../assets/img/default";
          
          if ($img) 
            $path = "../assets/img/preview/restaurants/" . $img['id'];
          
          draw_restaurant_preview($restaurant, $path, $session);
        }       ?>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
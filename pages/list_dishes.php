<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../classes/dish.class.php');

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');
  require_once(__DIR__ . '/../templates/filter.php');

  $db = get_db();

  $min_price = !isset($_GET['min_price']) ? 0.0 : floatval($_GET['min_price']);
  $max_price = !isset($_GET['max_price']) ? 100.0 : floatval($_GET['max_price']);

  if ($min_price > $max_price) 
    $min_price = 0;
  
  $categories = array();

  if (isset($_GET['fast-food'])) $categories[] = 'Fast-food';
  if (isset($_GET['premium'])) $categories[] = 'Premium';
  if (isset($_GET['affordable'])) $categories[] = 'Affordable';
  if (isset($_GET['sushi'])) $categories[] = 'Sushi';
  if (isset($_GET['vegan'])) $categories[] = 'Vegan';

  $dishes = filter_dishes(floatval($min_price), floatval($max_price), $categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/filter.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/previews.css">
  <link rel="stylesheet" href="../css/pages/main-page.css">
  <link rel="stylesheet" href="../css/pages/page_list_dishes.css">
  <link rel="icon" href="../assets/logo/favicon.png">
  <title>Dishes</title>
  <script src="../javascript/header_scroll.js" defer></script>
  <script src="../javascript/sidebar_button.js" defer></script>
  <script src="../javascript/dynamic_search.js" defer></script>
  <script src="../javascript/favorite_button.js" defer></script>
  <script src="../javascript/messages.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main>
    <aside class="filter" id="dish-filter">
      <h1>Choose a filter</h1>
      <form class="filter-form" action="list_dishes.php" method="get">
        <section class="section-input" id="dish-price">
          <h1>Price</h1>
          <div class="number-input" id="price-input-container">
            <label for="min-price">
              Min<input id="min-price" class="price-number" type="number" name="min_price" min="0" max="100" value="0">
            </label>
            <label for="max-price">
              Max<input id="max-price" class="price-number" type="number" name="max_price" min="0" max="100" value="100">
            </label>
          </div>
        </section>
        <section class="section-categories" id="dish-category">
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
    <section id="dish-previews">
      <?php
        foreach ($dishes as $dish) {
          $stmt = $db->prepare('SELECT * FROM DishImage WHERE dish_id = ? ORDER BY id DESC');
          $stmt->execute(array($dish->id));
          $img = $stmt->fetch();
          
          $path = "../assets/img/default";
          
          if ($img) 
            $path = "../assets/img/preview/dishes/" . $img['id'];
          
          draw_dish_preview($dish, $path, $session);
        }
      ?>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
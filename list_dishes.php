<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/classes/dish.class.php');

  require_once('templates/common.php');
  require_once('templates/dish.tpl.php');
  require_once('templates/filter.php');

  $min_price = !isset($_GET['min_price']) ? 0.0 : floatval($_GET['min_price']);
  $max_price = !isset($_GET['max_price']) ? 5.0 : floatval($_GET['max_price']);

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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/list-dishes-page.css">
  <title>Dishes</title>
</head>
<body>
  <?php draw_header() ?>
  <main>
    <section id="dish-previews">
      <?php
        foreach ($dishes as $dish)
          draw_dish_preview($dish);
      ?>
    </section>
    <aside id="dish-filter">
      <h1>Choose a filter</h1>
      <form action="list_dishes.php" method="get">
        <section id="dish-price">
          <h1>Price</h1>
          <div id="price-input-container">
            <label for="min-price">
              Min<input id="min-price" class="price-number" type="number" name="min_price" min="0" max="100" value="0">
            </label>
            <label for="max-price">
              Max<input id="max-price" class="price-number" type="number" name="max_price" min="0" max="100" value="100">
            </label>
          </div>
        </section>
        <section id="dish-category">
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
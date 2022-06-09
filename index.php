<?php
  require_once('utils/session.php');
  $session = new Session();
  require_once('templates/common.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/stickers.css">
  <link rel="stylesheet" href="css/pages/page_index.css">
  <link rel="stylesheet" href="css/pages/main-page.css">
  <link rel="icon" href="assets/logo/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agile Eating</title>
  <script src="javascript/header_scroll.js" defer></script>
  <script src="javascript/sidebar_button.js" defer></script>
  <script src="javascript/dynamic_search.js" defer></script>
  <script src="javascript/messages.js" defer></script>
</head>
<body>
  <?php draw_sidebar($session) ?>
  <?php draw_header($session) ?>
  <main id="main-page">
    <section id="frontpage">
      <section id="slogan">
        <h1>Agile Eating - fast and simple</h1>
        <p>Discover amazing places to eat, tasteful dishes to enjoy</p>
        <p>Join our community!</p>
        <div id="slogan-anchors">
          <a href="pages/page_sign_in.php">Sign in</a>
          <a href="pages/page_sign_up.php">Sign up</a>
        </div>
      </section>
      <img src="assets/frontpage_v2.png">
    </section>
    <section id="main-suggestions">
      <section class="suggestions">
        <div class="suggestions-header">
          <h1 class="suggestion-title">Restaurants</h1>
          <a href="pages/view_restaurant.php" class="suggestions-anchor">SEE MORE</a>
        </div>
        <div class="images">
          <a href="pages/list_restaurants.php">
            <figure>
              <img src="assets/img/category/2.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Fast-food</figcaption>
            </figure>
          </a>
          <a href="pages/list_restaurants.php">
            <figure>
              <img src="assets/img/category/6.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Premium</figcaption>
            </figure>
          </a>
          <a href="pages/list_restaurants.php">
            <figure>
              <img src="assets/img/category/7.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Affordable</figcaption>
            </figure>
          </a>
          <a href="pages/list_restaurants.php">
            <figure>
              <img src="assets/img/category/9.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Diet</figcaption>
            </figure>
          </a>
        </div>
      </section>
      <section class="suggestions">
        <div class="suggestions-header">
          <h1 class="suggestion-title">Dishes</h1>
          <a href="pages/view_restaurant.php" class="suggestions-anchor">SEE MORE</a>
        </div>
        <div class="images">
          <a href="pages/list_dishes.php">
            <figure>
              <img src="assets/img/category/1.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Vegan</figcaption>
            </figure>
          </a>
          <a href="pages/list_dishes.php">
            <figure>
              <img src="assets/img/category/3.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Vegetarian</figcaption>
            </figure>
          </a>
          <a href="pages/list_dishes.php">
            <figure>
              <img src="assets/img/category/8.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Sushi</figcaption>
            </figure>
          </a>
          <a href="pages/list_dishes.php">
            <figure>
              <img src="assets/img/category/5.jpg" alt="dummy-text" width="300" height="200">
              <figcaption>Lactose-free</figcaption>
            </figure>
          </a>
        </div>
      </section>
    </section>  
    <?php draw_stickers(); ?>
  </main>
  <?php draw_footer() ?>
</body>
</html>
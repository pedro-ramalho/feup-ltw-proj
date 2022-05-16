<?php
  require_once('templates/common.php');
  
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/pages/main-page.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agile Eating</title>
</head>
<body>
  <?php draw_header() ?>
  <main>
    <section class="suggestions">
      <h1 class="suggestion-title">Restaurants</h1>
      <div class="images">
        <a href="list_restaurants.php">
          <figure>
            <img src="assets/img/category/2.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Fast-food</figcaption>
          </figure>
        </a>
        <a href="list_restaurants.php">
          <figure>
            <img src="assets/img/category/6.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Premium</figcaption>
          </figure>
        </a>
        <a href="list_restaurants.php">
          <figure>
            <img src="assets/img/category/7.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Affordable</figcaption>
          </figure>
        </a>
        <a href="list_restaurants.php">
          <figure>
            <img src="assets/img/category/9.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Diet</figcaption>
          </figure>
        </a>
      </div>
    </section>

    <section class="suggestions">
      <h1 class="suggestion-title">Dishes</h1>
      <div class="images">
        <a href="list_dishes.php">
          <figure>
            <img src="assets/img/category/1.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Vegan</figcaption>
          </figure>
        </a>
        <a href="list_dishes.php">
          <figure>
            <img src="assets/img/category/3.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Vegetarian</figcaption>
          </figure>
        </a>
        <a href="list_dishes.php">
          <figure>
            <img src="assets/img/category/8.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Sushi</figcaption>
          </figure>
        </a>
        <a href="list_dishes.php">
          <figure>
            <img src="assets/img/category/5.jpg" alt="dummy-text" width="300" height="200">
            <figcaption>Lactose-free</figcaption>
          </figure>
        </a>
      </div>
    </section>
  </main>
  <?php draw_footer() ?>
</body>
</html>
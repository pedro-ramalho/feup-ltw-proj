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
  <title>Document</title>
</head>
<body>
  
</body>
</html>
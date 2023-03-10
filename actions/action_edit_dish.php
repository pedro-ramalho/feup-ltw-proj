<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();


  if (!isset($_SESSION['id']))
    die();
  
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');
  require_once(__DIR__ . '/../utils/validation.php');

  $db = get_db();

  $dish_id = intval($_POST['dish-id-holder']);

  $dish_name = $_POST['dish-name'];

  $categories = $_POST['dish-categories'];

  $dish_categories = array();

  foreach ($categories as $category) {
    if (isset($category)) {
      $dish_categorie[] = intval($category);
    }
  }

  $price = floatval($_POST['dish-price']);

  Dish::update_dish($db, $dish_id, $dish_name, $price, $dish_categories);

  $stmt = $db->prepare('INSERT INTO DishImage(dish_id) VALUES(?)');
  $stmt->execute(array($dish_id));

  $id = $db->lastInsertId();

  $original_file = "../assets/img/original/dishes/$id.jpg";
  $preview_file = "../assets/img/preview/dishes/$id.jpg";
  $display_file = "../assets/img/display/dishes/$id.jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $original_file);

  $original = imagecreatefromjpeg($original_file);

  if (!$original) {
    $original = imagecreatefrompng($original_file);
    $original = imagecreatetruecolor(imagesx($original), imagesy($original));
    imagefill($original, 0, 0, imagecolorallocate($original, 255, 255, 255));
    imagealphablending($original, TRUE);
  }

  /* calculate the width and height of the original image */

  $width = imagesx($original);    
  $height = imagesy($original);  
  $square = min($width, $height); 
  

  /* create and save a preview image */

  $preview = imagecreatetruecolor(200, 200); 
  imagecopyresized($preview, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($preview, $preview_file);


  /* create and save a display image */
  
  $display = imagecreatetruecolor(1200, 600);
  imagecopyresized($display, $original, 0, 0, 0, 0, 1200, 600, $width, $height);
  imagejpeg($display, $display_file);


  header('Location: ../index.php'); 
?>
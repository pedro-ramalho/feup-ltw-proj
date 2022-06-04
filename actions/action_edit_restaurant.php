<?php
  declare(strict_types = 1);

use LDAP\Result;

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../classes/dish.class.php');

  $db = get_db();


  /* fetch data from POST */

  $restaurant_id = intval($_POST['restaurant-id']);
  $restaurant_name = $_POST['restaurant-name'];
  $categories = $_POST['categories'];
  $coordinates = $_POST['coordinates'];

  Restaurant::update_restaurant($db, $restaurant_id, $restaurant_name, array($categories), $coordinates);

  $stmt = $db->prepare('INSERT INTO RestaurantImage(restaurant_id) VALUES(?)');
  $stmt->execute(array($restaurant_id));

  $id = $db->lastInsertId();

  $original_file = "../assets/img/original/restaurants/$id.jpg";
  $preview_file = "../assets/img/preview/restaurants/$id.jpg";
  $display_file = "../assets/img/display/restaurants/$id.jpg";

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
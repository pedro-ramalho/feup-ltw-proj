<?php
  declare(strict_types = 1);

  require_once('connection.php');

  $db = getDatabaseConnection();

  /* insert new restaurant image into database, must contain the restaurant id */
  $stmt = $db->prepare('INSERT INTO RestaurantImage VALUES(?)');
  $stmt->execute(array($_POST['id']));

  $id = $db->lastInsertId();

  $original_file = "assets/img/original/restaurants/$id.jpg";
  $preview_file = "assets/img/preview/restaurants/$id.jpg";
  $display_file = "assets/img/display/restaurants/$id.jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $original_file);
  
  /* UPDATE LATER */
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
  
  /* create and save a preview image */
  $preview = imagecreatetruecolor(800, 400); 
  imagecopyresized($preview, $original, 0, 0, 0, 0, 400, 200, $width, $height);
  imagejpeg($preview, $preview_file);

  /* create and save a display image */
  $display = imagecreatetruecolor(1200, 600);
  imagecopyresized($display, $original, 0, 0, 0, 0, 1200, 600, $width, $height);
  imagejpeg($display, $display_file);
?>
<?php
  declare(strict_types = 1);

  require_once('connection.php');

  $db = getDatabaseConnection();

  /* insert new restaurant image into database, must contain the restaurant id */
  $stmt = $db->prepare('INSERT INTO DishImage VALUES(?)');
  $stmt->execute(array($_POST['id']));

  $id = $db->lastInsertId();

  $original_file = "assets/img/original/dishes/$id.jpg";
  $preview_file = "assets/img/preview/dishes/$id.jpg";
  $display_file = "assets/img/display/dishes/$id.jpg";

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
  $square = min($width, $height);
  $preview = imagecreatetruecolor(200, 200); 
  imagecopyresized($preview, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($preview, $preview_file);

  /* create and save a display image */
  $display = imagecreatetruecolor(600, 400);
  imagecopyresized($display, $original, 0, 0, 0, 0, 600, 400, $width, $height);
  imagejpeg($display, $display_file);
?>
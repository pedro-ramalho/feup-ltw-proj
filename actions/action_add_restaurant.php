<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    $session->addMessage("error", "You need to be logged in!");
    header('Location: localhost:9000/pages/sign-in.php');
    die();
  }
  
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../classes/restaurant.class.php');
  require_once(__DIR__ . '/../utils/validation.php');

  $owner_id = intval($_POST['owner-id']);

  $restaurant_name = $_POST['res-name'];
  
  $categories = $_POST['categories'];

  $restaurant_categories = array();

  foreach ($categories as $category) {
    if (isset($category)) {
      $restaurant_categories[] = intval($category);
    }
  }


  $restaurant_address = $_POST['res-address'];
  $restaurant_coordinates = $_POST['res-coords'];

  $db = get_db();

  if (!valid_restaurant_name($restaurant_name)) {
    echo 'Invalid restaurant name';
    die();
  }

  if (!valid_address($restaurant_address)) {
    echo 'Invalid address';
    die();
  }

  if (!valid_coordinates($restaurant_coordinates)) {
    echo 'Invalid coordinates';
    die();
  }

  Restaurant::add_restaurant(
    $db, $owner_id, $restaurant_name, $restaurant_categories, $restaurant_address, $restaurant_coordinates
  );

  $stmt = $db->prepare('SELECT id FROM Restaurant WHERE owner_id = ? AND res_name = ?');
  $stmt->execute(array($owner_id, $restaurant_name));
  $restaurant_id = intval($stmt->fetch()['id']);

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
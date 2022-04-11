<?php
  function getDatabaseConnection() {
    $db = new PDO('sqlite:restaurant.db');
    
    return $db;
  }
?>
<?php
  declare(strict_types = 1);

  session_start();


  /* validates the input for user credentials */

  function valid_username(string $username) : int {
    return preg_match("/^[a-zA-Z0-9]+$/", $username);
  }

  function valid_password(string $password) : bool {
    return preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%&])/", $password)
           && strlen($password) >= 8;
  }

  function passwords_match(string $pw1, string $pw2) : bool {
    return $pw1 === $pw2;
  }

  function valid_phone_nr(string $phone_nr) : int {
    return preg_match("/[0-9]{9}/", $phone_nr);
  }

  function valid_address(string $address) : int {
    return preg_match("/^[a-zA-Z0-9\s]+$/", $address);
  }


  /* validates the input for reviews */

  function valid_review(string $review) : int {
    return preg_match("/^[.!?()@,'\-\^a-zA-Z0-9\s]+$/", $review);
  }


  /* validates the input for restaurants */

  function valid_restaurant_name(string $name) : int {
    return preg_match("/^[a-zA-Z0-9\s]+$/", $name);
  }

  function valid_category(string $category) : int {
    return preg_match("/^[a-zA-Z\s]+$/", $category);
  }

  function valid_coordinates(string $coordinates) : int {
    return preg_match("/^[\d,.\s]+$/", $coordinates);
  }
?>
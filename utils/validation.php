<?php
  declare(strict_types = 1);

  session_start();


  /* validates the input for user credentials */

  function valid_username(string $username) : bool {
    return preg_match("/^[a-zA-Z0-9]+$/", $username);
  }

  function valid_password(string $password) : bool {
    return preg_match("/^[a-z]+[A-Z]+[0-9]+[\#]+[\$]+[\%]+/", $password)
           && strlen($password) > 8;
  }

  function passwords_match(string $pw1, string $pw2) : bool {
    return $pw1 === $pw2;
  }

  function valid_phone_nr(string $phone_nr) : bool {
    return preg_match("/[0-9]{9}/", $phone_nr);
  }

  function valid_address(string $address) : bool {
    return preg_match("/^[a-zA-Z0-9\s]+$/", $address);
  }


  /* validates the input for reviews */

  function valid_review(string $review) : bool {
    return preg_match("/^[a-zA-Z0-9\s]+$/", $review);
  }

?>
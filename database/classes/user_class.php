<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $password;
    public string $address;
    public string $phone_number;

    public function __construct(int $id, string $username, string $password, string $address, string $phone_number)
    { 
      $this->id = $id;
      $this->username = $username;
      $this->password = $password;
      $this->address = $address;
      $this->phone_number = $phone_number;
    }

    static function get_user(PDO $db, int $id) : User {
      $stmt = $db->prepare('SELECT id, username, pw, addr, phone_number FROM User WHERE id = ?');
      $stmt->execute(array($id));
      
      $user = $stmt->fetch();

      return new User(
        $user['id'],
        $user['username'],
        $user['pw'],
        $user['addr'],
        $user['phone_number']
      );
    }
    
    static function get_restaurants(PDO $db, int $id) : array {
      return array();
    }

    static function get_orders(PDO $db, int $id) : array {
      return array();
    }

    static function get_fav_dishes(PDO $db, int $id) : array {
      return array();
    }

    static function get_fav_restaurants(PDO $db, int $id) : array {
      return array();
    }

  }
?>
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

    /* returns a user with a given id */
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

    /* returns a user given a username and a password */
    static function get_user_from_credentials(PDO $db, string $username, string $password) {
      $stmt = $db->prepare(
        'SELECT id, username, pw AS password, addr AS address, phone_number
         FROM User WHERE username = ? AND password = ?');
      $stmt->execute(array($username, $password));

      if ($user = $stmt->fetch()) {
        return new User(
          intval($user['id']),
          $user['username'],
          $user['password'],
          $user['address'],
          $user['phone_number']
        );
      }

      return null;
    }
  }
?>

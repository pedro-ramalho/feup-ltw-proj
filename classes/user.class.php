<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $address;
    public string $phone_number;

    public function __construct(int $id, string $username, string $address, string $phone_number)
    { 
      $this->id = $id;
      $this->username = $username;
      $this->address = $address;
      $this->phone_number = $phone_number;
    }

    /* returns a user with a given id */
    static function get_user(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT id, username, pw, addr, phone_number FROM User WHERE id = ?
      ');
      $stmt->execute(array($id));
      
      $user = $stmt->fetch();

      return new User(
        intval($user['id']),
        $user['username'],
        $user['addr'],
        $user['phone_number']
      );
    }

    /* returns a user given a username and a password */
    static function get_user_from_credentials(PDO $db, string $username, string $password) {
      $stmt = $db->prepare('SELECT id, username, pw, addr as address, phone_number FROM User WHERE username = ?');
      $stmt->execute(array($username));

      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['pw'])) {
        return new User(
          intval($user['id']),
          $user['username'],
          $user['address'],
          $user['phone_number']
        );
      }

      return null;
    }

    static function register_user(PDO $db, string $username, string $password, string $address, string $phone_number) : void {
      $stmt = $db->prepare(
        'INSERT INTO User(username, pw, addr, phone_number) VALUES(?, ?, ?, ?)'
      );

      $opts = ['cost' => 12];

      $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $opts  ), $address, $phone_number));
    }
  }
?>

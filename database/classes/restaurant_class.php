<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public int $owner_id;
    public float $score;
    public string $res_name;
    public string $addr;
    public string $coords;

    public function __construct(int $id, int $owner_id, float $score, string $res_name, string $addr, string $coords)
    { 
      $this->id = $id;
      $this->owner_id = $owner_id;
      $this->score = $score;
      $this->res_name = $res_name;
      $this->addr = $addr;
      $this->coords = $coords;  
    }

    /* returns a restaurant with a given id */
    static function get_restaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords FROM Restaurant WHERE id = ?');
      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      return new Restaurant(
        $restaurant['id'],
        $restaurant['owner_id'],
        $restaurant['score'],
        $restaurant['res_name'],
        $restaurant['addr'],
        $restaurant['coords']
      );
    }

    /* returns an array containing the restaurants of a user with a given id */
    static function get_user_restaurants(PDO $db, int $user_id) : array {
      $stmt = $db->prepare(
        'SELECT id, owner_id, score, res_name, addr, coords FROM Restaurant WHERE owner_id = ?'
      );
      $stmt->execute(array($user_id));

      $restaurants = array();

      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['id'],
          $restaurant['owner_id'],
          $restaurant['score'],
          $restaurant['res_name'],
          $restaurant['addr'],
          $restaurant['coords']
        );
      }
      
      return $restaurants;
    }
  }
?>

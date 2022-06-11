<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public int $owner_id;
    public float $score;
    public array $categories;
    public string $res_name;
    public string $addr;
    public string $coords;

    public function __construct(int $id, int $owner_id, float $score, array $categories, string $res_name, string $addr, string $coords)
    { 
      $this->id = $id;
      $this->owner_id = $owner_id;
      $this->score = $score;
      $this->categories = $categories;
      $this->res_name = $res_name;
      $this->addr = $addr;
      $this->coords = $coords;  
    }

    /* returns a restaurant with a given id */
    static function get_restaurant(PDO $db, int $id) : Restaurant {
      $category_names = array(
        1 => 'Vegan',
        2 => 'Fast-food',
        3 => 'Vegetarian',
        4 => 'Gluten-free',
        5 => 'Lactose-free',
        6 => 'Premium',
        7 => 'Affordable',
        8 => 'Sushi',
        9 => 'Diet'
      );

      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords FROM Restaurant WHERE id = ?');
      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      $stmt = $db->prepare('SELECT restaurant, category FROM RestaurantCategory WHERE restaurant = ?');
      $stmt->execute(array($id));
      
      $categories = array();

      while ($category = $stmt->fetch())
        $categories[] = $category_names[$category['category']];

      return new Restaurant(
        intval($restaurant['id']),
        intval($restaurant['owner_id']),
        floatval($restaurant['score']),
        $categories,
        $restaurant['res_name'],
        $restaurant['addr'],
        $restaurant['coords']
      );
    }

    /* returns an array containing all restaurants in the given database */
    static function get_all_restaurants(PDO $db) : array {
      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords FROM Restaurant');
      $stmt->execute();

      $restaurants = array();
      
      while ($restaurant = $stmt->fetch())
        $restaurants[] = Restaurant::get_restaurant($db, intval($restaurant['id']));
      
      return $restaurants;
    }
    
    static function get_limited_restaurants(PDO $db, int $limit) : array {
      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords FROM Restaurant LIMIT ?');
      $stmt->execute(array($limit));

      $restaurants = array();
      
      while ($restaurant = $stmt->fetch())
      $restaurants[] = Restaurant::get_restaurant($db, intval($restaurant['id']));
    
      return $restaurants;
    }

    /* returns an array containing the favorite restaurants of a user with a given id */
    static function get_fav_restaurants(PDO $db, int $user_id) : array {
      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords 
                            FROM Restaurant, FavoriteRestaurant
                            WHERE FavoriteRestaurant.user = ? 
                            AND Restaurant.id = FavoriteRestaurant.restaurant');
      $stmt->execute(array($user_id));

      $fav_restaurants = array();

      while ($fav_restaurant = $stmt->fetch()) 
        $fav_restaurants[] = Restaurant::get_restaurant($db, intval($fav_restaurant['id']));
      
      return $fav_restaurants;
    }

    static function get_owned_restaurants(PDO $db, int $user_id) : array {
      $stmt = $db->prepare('SELECT id, owner_id, score, res_name, addr, coords
                            FROM Restaurant WHERE owner_id = ?');
      $stmt->execute(array($user_id));

      $owned_restaurants = array();
      
      while ($owned_restaurant = $stmt->fetch())
        $owned_restaurants[] = Restaurant::get_restaurant($db, intval($owned_restaurant['id']));

      return $owned_restaurants;
    }

    static function search_restaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT id FROM Restaurant WHERE res_name LIKE ? ORDER BY score DESC LIMIT ? ');
      $stmt->execute(array('%' . $search . '%', $count));
      
      $restaurants = Array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = Restaurant::get_restaurant($db, intval($restaurant['id']));
      }
      
      return $restaurants;
    }

    static function add_restaurant(PDO $db, int $owner_id, string $res_name, string $addr, string $coords) : void {
      $stmt = $db->prepare(
        'INSERT INTO Restaurant(owner_id, score, res_name, addr, coords) VALUES(?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($owner_id, 3, $res_name, $addr, $coords));
    }

    static function update_restaurant(PDO $db, int $id, string $new_name, array $new_categories, string $new_coords) : void {
      $stmt = $db->prepare('UPDATE Restaurant SET res_name = ?, coords = ? WHERE id = ?');
      $stmt->execute(array($new_name, $new_coords, $id));
    }

  }
?>

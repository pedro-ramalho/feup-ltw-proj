<?php
  declare(strict_types = 1);

  class Dish {
    public int $id;
    public int $restaurant;
    public float $price;
    public string $name;
    public array $categories;

    public function __construct(int $id, int $restaurant, float $price, string $name, array $categories) 
    {
      $this->id = $id;
      $this->restaurant = $restaurant;
      $this->price = $price;
      $this->name = $name;
      $this->categories = $categories;
    }

    /* returns a dish with a given id */
    static function get_dish(PDO $db, int $id) : Dish {
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

      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name FROM dish WHERE id = ?');
      $stmt->execute(array($id));

      $dish = $stmt->fetch();

      $stmt = $db->prepare('SELECT dish, category FROM DishCategory WHERE dish = ?');
      $stmt->execute(array($id));

      $categories = array();

      while ($category = $stmt->fetch())
        $categories[] = $category_names[$category['category']];
      
      return new Dish(
        intval($dish['id']), 
        intval($dish['restaurant']), 
        floatval($dish['price']), 
        $dish['dish_name'], 
        $categories
      );
    }

    /* returns the restaurant id to which a certain dish belongs */
    static function get_dish_restaurant(PDO $db, int $dish_id) {
      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name AS name FROM dish WHERE id = ?');
      $stmt->execute(array($dish_id));

      $restaurant = $stmt->fetch();

      return intval($restaurant['restaurant']);
    }

    static function get_all_dishes(PDO $db) : array {
      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name AS name FROM Dish');
      $stmt->execute();

      $dishes = array();

      while ($dish = $stmt->fetch())
        $dishes[] = Dish::get_dish($db, intval($dish['id']));
      
      return $dishes;
    }

    static function get_limited_dishes(PDO $db, int $limit) : array {
      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name AS name FROM Dish LIMIT ?');
      $stmt->execute(array($limit));

      $dishes = array();

      while ($dish = $stmt->fetch())
        $dishes[] = Dish::get_dish($db, intval($dish['id']));
      
      return $dishes;
    }

    /* */
    static function get_restaurant_dishes(PDO $db, int $restaurant_id) : array {
      $stmt = $db->prepare('SELECT id FROM Dish WHERE restaurant = ?');
      $stmt->execute(array($restaurant_id));
      
      $dishes = array();
      
      while ($dish = $stmt->fetch())
        $dishes[] = Dish::get_dish($db, intval($dish['id']));
      
      return $dishes;
    }


    static function get_fav_dishes(PDO $db, int $user_id) {
      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name, dish 
                            FROM Dish, FavoriteDish 
                            WHERE FavoriteDish.user = ? 
                            AND Dish.id = FavoriteDish.dish');
      $stmt->execute(array($user_id));

      $fav_dishes = array();

      while ($fav_dish = $stmt->fetch())
        $fav_dishes[] = Dish::get_dish($db, intval($fav_dish['id']));
      
      return $fav_dishes;
    }
    
    static function search_dishes(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT id FROM Dish WHERE dish_name LIKE ? LIMIT ?');
      $stmt->execute(array('%' . $search . '%', $count));
      
      $dishes = Array();
      while ($dish = $stmt->fetch()) {
        $dishes[] = Dish::get_dish($db, intval($dish['id']));
      }
      
      return $dishes;
    }

    static function add_dish(PDO $db, int $restaurant_id, string $name, float $price, array $categories) : void {
      $stmt = $db->prepare('INSERT INTO Dish(restaurant, price, dish_name) VALUES(?, ?, ?)');
      $stmt->execute(array($restaurant_id, $price, $name));

      $id = $db->lastInsertId();

      foreach ($categories as $category) {
        Dish::add_dish_category($db, intval($id), intval($category));
      }
    }

    static function get_dish_categories(PDO $db, int $dish_id) : array {
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

      $stmt = $db->prepare('SELECT dish, category FROM DishCategory WHERE dish = ?');
      $stmt->execute(array($dish_id));
      
      $categories = array();

      while ($category = $stmt->fetch())
      $categories[] = $category_names[$category['category']];

      return $categories;
    }

    static function update_dish(PDO $db, int $dish_id, string $name, float $price, array $dish_categories) : void {
      $stmt = $db->prepare('UPDATE Dish SET dish_name = ?, price = ? WHERE id = ?');
      $stmt->execute(array($name, $price, $dish_id));

      foreach ($dish_categories as $category) {
        Dish::add_dish_category($db, intval($dish_id), intval($category));
      }
    }

    static function add_dish_category(PDO $db, int $id, int $category) : void {
      $stmt = $db->prepare(
        'INSERT INTO DishCategory(dish, category) VALUES(?, ?)'
      );

      $stmt->execute(array($id, $category));
    }

    static function is_favorited(PDO $db, int $userID, int $dishID) {
      $stmt = $db->prepare('SELECT * from FavoriteDish WHERE dish = ? AND user = ?');
      $stmt->execute(array($dishID, $userID));

      $results = Array();
      $results = $stmt->fetchAll();
      if (count($results) == 0) return false;
      return true;
    }

  }   
?>

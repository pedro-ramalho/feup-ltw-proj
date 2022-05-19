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

      $stmt = $db->prepare('SELECT id, restaurant, price, dish_name AS name FROM dish WHERE id = ?');
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
        $dish['name'], 
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

  }   
?>

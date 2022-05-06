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
      
      return new Dish($dish['id'], $dish['restaurant'], $dish['price'], $dish['name'], $categories);
    }

    static function get_fav_dishes(PDO $db, int $user_id) {
      
    }
  }   
?>

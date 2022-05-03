<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public int $customer;
    public int $restaurant;
    public string $state;
    public array $dishes;


    public function __construct(int $id, int $customer, int $restaurant, string $state, array $dishes)
    {
      $this->id = $id;
      $this->customer = $customer;
      $this->restaurant = $restaurant;
      $this->state = $state;
      $this->dishes = $dishes;
    }
    
    /* returns an order with a given id */
    static function get_orders(PDO $db, int $order_id) : Order {
      $stmt = $db->prepare(
        'SELECT order_dish AS order_id, curr_state AS state, restaurant, customer, dish, quantity
           FROM Dish, OrderDish, DishQuantity 
             WHERE OrderDish.id = DishQuantity.order_dish 
                AND dish = Dish.id 
                AND order_id = ?
      ');
      $stmt->execute(array($order_id));
      
      $customer = -1;
      $restaurant = -1;
      $state = '';
      
      /* works as a hash map where each key is a dish ID and it's value is the dish's quantity */
      $dishes = array(); 
      
      /* build the array of dishes and initialize other variables */
      while ($dish = $stmt->fetch()) {
        $dishes[$dish['dish']] = $dish['quantity'];
        $customer = $dish['customer'];
        $restaurant = $dish['restaurant'];
        $state = $dish['state'];
      }

      return new Order($order_id, $customer, $restaurant, $state, $dishes);
    }

    /* returns an array containing the orders of a given restaurant */
    public function get_restaurant_orders(PDO $db, int $restaurant_id) : array {
      $stmt = $db->prepare(
        'SELECT order_dish AS order_id, curr_state AS state, restaurant, customer, dish, quantity
           FROM Dish, OrderDish, DishQuantity 
             WHERE OrderDish.id = DishQuantity.order_dish 
                AND dish = Dish.id 
                AND restaurant = ?
      ');
      $stmt->execute(array($restaurant_id));
      
      $orders = array();

      while ($order = $stmt->fetch()) 
        $orders[] = $this::get_orders($db, $order['order_id']);

      return $orders;
    }

    /* returns an array containing the orders of a given customer */
    public function get_customer_orders(PDO $db, int $customer_id) : array {
      $stmt = $db->prepare(
        'SELECT order_dish AS order_id, curr_state AS state, restaurant, customer, dish, quantity
           FROM Dish, OrderDish, DishQuantity 
             WHERE OrderDish.id = DishQuantity.order_dish 
                AND dish = Dish.id 
                AND customer = ?
      ');
      $stmt->execute(array($customer_id));
      
      $orders = array();

      while ($order = $stmt->fetch()) 
        $orders[] = $this::get_orders($db, $order['order_id']);

      return $orders;
    }
  }
?>

<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public int $customer;
    public int $restaurant;
    public int $dish;
    public string $state;

    public function __construct(int $id, int $customer, int $restaurant, int $dish, string $state)
    {
      $this->id = $id;
      $this->customer = $customer;
      $this->restaurant = $restaurant;
      $this->dish = $dish;
      $this->state = $state;
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
      
      $order = $stmt->fetch();

      return new Order(
        intval($order['order_id']),
        intval($order['customer']),
        intval($order['restaurant']),
        intval($order['dish']),
        $order['state']
      );
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

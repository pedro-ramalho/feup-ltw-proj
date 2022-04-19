<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public int $customer_id;
    public string $state;

    public function __construct(int $id, int $customer_id, string $state)
    {
      $this->id = $id;
      $this->customer_id = $customer_id;
      $this->state = $state;
    }

    static function get_order(PDO $db, int $id) : Order {
      $stmt = $db->prepare('SELECT id, customer, curr_state FROM Order WHERE id = ?');
      $stmt->execute(array($id));

      $order = $stmt->fetch();

      return new Order(
        $order['id'],
        $order['customer'],
        $order['curr_state']
      );
    }
  }
?>
<?php
  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function thereAreOrders() : bool {
      if (isset($_SESSION['orders'])) {
        return (count($_SESSION['orders']) > 0);
      }
      else {
        return false;
      }
    }

    public function logout() {
      session_destroy();
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }

    public function addMessage(string $type, string $text) {
      if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = array();
      }
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text, 'index' => count($_SESSION['messages']));
    }

    public function addOrder(int $dish_id) {
      if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = array();
        $_SESSION['orders'][] = array('dish_id' => $dish_id, 'user_id' => $_SESSION['id'], 'quantity' => 1);
        return;
      }
      
      foreach ($_SESSION['orders'] as $order) {
        if ($order['dish_id'] == $dish_id) {
          $order['quantity'] += 1;
          return;
        }
      }
      $_SESSION['orders'][] = array('dish_id' => $dish_id, 'user_id' => $_SESSION['id'], 'quantity' => 1);
    }

    public function getMessages() {
      return $this->messages;
    }

    public function getOrders() {
      return isset($_SESSION['orders']) ? $_SESSION['orders'] : array();
    }
  }
?>

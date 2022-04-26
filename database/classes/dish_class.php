<?php
  declare(strict_types = 1);

  class Dish {
    public int $id;
    public float $score;
    public string $name;

    public function __construct(int $id, float $score, string $name)
    {
      $this->id = $id;
      $this->score = $score;
      $this->name = $name;
    }
    
    /* returns a dish with a given id */
    static function get_dish(PDO $db, int $id) : Dish {
      $stmt = $db->prepare('SELECT id, score, dish_name FROM Dish WHERE id = ?');
      $stmt->execute(array($id));

      $dish = $stmt->fetch();

      return new Dish(
        $dish['id'],
        $dish['score'],
        $dish['dish_name']
      );
    }
  }
?>

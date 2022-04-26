<?php 
  declare(strict_types = 1);

  class Review {
    public int $id;
    public int $author_id;
    public int $restaurant_id;
    public float $score;
    public string $text;

    public function __construct(int $id, int $author_id, int $restaurant_id, float $score, string $text)
    {
      $this->id = $id;
      $this->author_id = $author_id;
      $this->restaurant_id = $restaurant_id;
      $this->score = $score;
      $this->text = $text;
    }

    /* returns a review with a given id */
    static function get_review(PDO $db, int $id) : Review {
      $stmt = $db->prepare('SELECT id, author, restaurant, score, txt FROM Review WHERE id = ?');
      $stmt->execute(array($id));

      $review = $stmt->fetch();

      return new Review(
        $review['id'],
        $review['author'],
        $review['restaurant'],
        $review['score'],
        $review['txt']
      );
    }

    /* returns an array containing the reviews of a restaurant with a given id */
    static function get_restaurant_reviews(PDO $db, int $restaurant_id) : array {
      $stmt = $db->prepare(
        'SELECT id, author, restaurant, score, txt FROM Review WHERE restaurant = ?'
      );
      $stmt->execute(array($restaurant_id));

      $reviews = array();
      
      while ($review = $stmt->fetch()) {
        $reviews[] = new Review(
          $review['id'],
          $review['author'],
          $review['restaurant'],
          $review['score'],
          $review['txt']
        ); 
      }

      return $reviews;
    }
  }
?>

<?php

require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../config/Database.php';

class ReviewController
{
    private $db;
    private $review;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->review = new Review($this->db);
    }

    // Método para crear una nueva reseña.
    public function create($product_id, $user_id, $rating, $comment)
    {
        try {
            $this->review->product_id = $product_id;
            $this->review->user_id = $user_id;
            $this->review->rating = $rating;
            $this->review->comment = $comment;
            $message = $this->review->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todas las reseñas.
    public function index()
    {
        try {
            $stmt = $this->review->read();
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $reviews]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una reseña por ID.
    public function show($id)
    {
        try {
            $this->review->id = $id;
            $message = $this->review->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar una reseña existente.
    public function update($id, $rating, $comment)
    {
        try {
            $this->review->id = $id;
            $this->review->rating = $rating;
            $this->review->comment = $comment;
            $message = $this->review->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una reseña existente.
    public function delete($id)
    {
        try {
            $this->review->id = $id;
            $message = $this->review->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener la URL de la imagen de un producto por ID.
    public function getImageUrlByProductId($product_id)
    {
        try {
            return $this->review->getImageUrlByProductId($product_id);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener las opiniones con un limite de 7.
    public function getRecentReviews($limit = 7)
    {
        try {
            $stmt = $this->review->read($limit);
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $reviews;
        } catch (Exception $e) {
            // Manejo del error.
        }
    }

}

?>
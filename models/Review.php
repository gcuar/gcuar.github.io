<?php

class Review
{
    private $conn;
    private $table_name = "reviews";

    public $id;
    public $product_id;
    public $user_id;
    public $rating;
    public $comment;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if ($this->product_id <= 0 || !is_int($this->product_id)) {
            throw new Exception("El product_id debe ser un entero positivo");
        }

        if ($this->user_id <= 0 || !is_int($this->user_id)) {
            throw new Exception("El user_id debe ser un entero positivo");
        }

        if ($this->rating <= 0 || $this->rating > 5 || !is_int($this->rating)) {
            throw new Exception("La calificación debe ser un entero entre 1 y 5");
        }

        if (empty($this->comment)) {
            throw new Exception("El comentario no puede estar vacío");
        }
    }

    // Método para crear una nueva reseña.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            product_id, user_id, rating, comment, created_at
        ) VALUES (
            :product_id, :user_id, :rating, :comment, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));

        // Vincular los valores.
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Reseña creada exitosamente";
        }
        throw new Exception("Error al crear la reseña: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener todas las reseñas con un límite opcional.
    public function read($limit = null)
    {
        $query = "SELECT * FROM " . $this->table_name;
        if ($limit !== null) {
            $query .= " LIMIT " . (int) $limit;
        }
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer reseñas: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una reseña por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->product_id = $row['product_id'];
                $this->user_id = $row['user_id'];
                $this->rating = $row['rating'];
                $this->comment = $row['comment'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Reseña encontrada" : "Reseña no encontrada";
        }
        throw new Exception("Error al leer la reseña: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar una reseña existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            rating = :rating,
            comment = :comment,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Reseña actualizada exitosamente";
        }
        throw new Exception("Error al actualizar la reseña: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una reseña existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Reseña eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la reseña: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener la URL de la imagen de un producto por ID.
    public function getImageUrlByProductId($product_id)
    {
        $query = "SELECT image_url FROM products WHERE id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && isset($row['image_url'])) {
                return $row['image_url'];
            }
        }
        throw new Exception("Error al obtener la URL de la imagen: " . $stmt->errorInfo()[2]);
    }
}

?>
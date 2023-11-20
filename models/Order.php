<?php

class Order
{
    private $conn;
    private $table_name = "orders";

    public $id;
    public $user_id;
    public $total_price;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if ($this->user_id <= 0 || !is_int($this->user_id)) {
            throw new Exception("El user_id debe ser un entero positivo");
        }

        if ($this->total_price < 0) {
            throw new Exception("El precio total no puede ser negativo");
        }

        if (empty($this->status)) {
            throw new Exception("El estado no puede estar vacío");
        }
    }

    // Método para obtener todas las órdenes.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer órdenes: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una orden por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->user_id = $row['user_id'];
                $this->total_price = $row['total_price'];
                $this->status = $row['status'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Orden encontrada" : "Orden no encontrada";
        }
        throw new Exception("Error al leer la orden: " . $stmt->errorInfo()[2]);
    }

    // Método para crear una nueva orden.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            user_id, total_price, status, created_at
        ) VALUES (
            :user_id, :total_price, :status, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Vincular los valores.
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Orden creada exitosamente";
        }
        throw new Exception("Error al crear la orden: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar una orden existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            user_id = :user_id,
            total_price = :total_price,
            status = :status,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Orden actualizada exitosamente";
        }
        throw new Exception("Error al actualizar la orden: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una orden existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Orden eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la orden: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar órdenes por estado.
    public function searchByStatus($status)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status LIKE :status";
        $stmt = $this->conn->prepare($query);
        $status = htmlspecialchars(strip_tags($status));
        $status = "%{$status}%";
        $stmt->bindParam(':status', $status);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error en la búsqueda: " . $stmt->errorInfo()[2]);
    }
}

?>
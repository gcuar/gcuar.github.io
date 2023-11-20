<?php

class OrderDetail
{
    private $conn;
    private $table_name = "order_details";

    public $id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $price;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if ($this->order_id <= 0 || !is_int($this->order_id)) {
            throw new Exception("El order_id debe ser un entero positivo");
        }

        if ($this->product_id <= 0 || !is_int($this->product_id)) {
            throw new Exception("El product_id debe ser un entero positivo");
        }

        if ($this->quantity <= 0 || !is_int($this->quantity)) {
            throw new Exception("La cantidad debe ser un entero positivo");
        }

        if ($this->price < 0) {
            throw new Exception("El precio no puede ser negativo");
        }
    }

    // Método para obtener todos los detalles de órdenes.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer los detalles de órdenes: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener un detalle de orden por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->order_id = $row['order_id'];
                $this->product_id = $row['product_id'];
                $this->quantity = $row['quantity'];
                $this->price = $row['price'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Detalle de orden encontrado" : "Detalle de orden no encontrado";
        }
        throw new Exception("Error al leer el detalle de orden: " . $stmt->errorInfo()[2]);
    }

    // Método para crear un nuevo detalle de orden.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            order_id, product_id, quantity, price, created_at
        ) VALUES (
            :order_id, :product_id, :quantity, :price, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Vincular los valores.
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Detalle de orden creado exitosamente";
        }
        throw new Exception("Error al crear el detalle de orden: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar un detalle de orden existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            order_id = :order_id,
            product_id = :product_id,
            quantity = :quantity,
            price = :price,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Vincular los valores.
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Detalle de orden actualizado exitosamente";
        }
        throw new Exception("Error al actualizar el detalle de orden: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar un detalle de orden existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Detalle de orden eliminado exitosamente";
        }
        throw new Exception("Error al eliminar el detalle de orden: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar detalles de orden por order_id o product_id.
    public function search($keywords)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id LIKE :keywords OR product_id LIKE :keywords";
        $stmt = $this->conn->prepare($query);
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(':keywords', $keywords);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error en la búsqueda: " . $stmt->errorInfo()[2]);
    }
}

?>
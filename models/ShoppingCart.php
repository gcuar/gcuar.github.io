<?php

class ShoppingCart
{
    private $conn;
    private $table_name = "shopping_cart";

    public $user_id;
    public $product_id;
    public $quantity;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if (empty($this->user_id) || !is_int($this->user_id)) {
            throw new Exception("El user_id debe ser un entero no vacío");
        }

        if (empty($this->product_id) || !is_int($this->product_id)) {
            throw new Exception("El product_id debe ser un entero no vacío");
        }

        if ($this->quantity <= 0 || !is_int($this->quantity)) {
            throw new Exception("La cantidad debe ser un entero positivo");
        }
    }

    // Método para obtener todos los elementos del carrito de un usuario.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer el carrito de compras: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener un elemento específico del carrito de un usuario.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->quantity = $row['quantity'];
            }
            return $row ? "Elemento encontrado en el carrito" : "Elemento no encontrado en el carrito";
        }
        throw new Exception("Error al leer el elemento del carrito: " . $stmt->errorInfo()[2]);
    }

    // Método para agregar o actualizar un elemento en el carrito de un usuario.
    public function createOrUpdate()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            user_id, product_id, quantity
        ) VALUES (
            :user_id, :product_id, :quantity
        ) ON DUPLICATE KEY UPDATE
            quantity = quantity + :quantity";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        // Vincular los valores.
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Elemento agregado o actualizado en el carrito exitosamente";
        }
        throw new Exception("Error al agregar o actualizar el elemento en el carrito: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar un elemento del carrito de un usuario.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Elemento eliminado del carrito exitosamente";
        }
        throw new Exception("Error al eliminar el elemento del carrito: " . $stmt->errorInfo()[2]);
    }
}

?>
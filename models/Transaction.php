<?php

class Transaction
{
    private $conn;
    private $table_name = "transactions";

    public $id;
    public $order_id;
    public $transaction_id;
    public $amount;
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
        if ($this->order_id <= 0 || !is_int($this->order_id)) {
            throw new Exception("El order_id debe ser un entero positivo");
        }

        if (empty($this->transaction_id)) {
            throw new Exception("El transaction_id no puede estar vacío");
        }

        if ($this->amount < 0) {
            throw new Exception("El amount no puede ser negativo");
        }

        if (empty($this->status)) {
            throw new Exception("El status no puede estar vacío");
        }
    }

    // Método para crear una nueva transacción.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            order_id, transaction_id, amount, status, created_at
        ) VALUES (
            :order_id, :transaction_id, :amount, :status, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->transaction_id = htmlspecialchars(strip_tags($this->transaction_id));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Vincular los valores.
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':transaction_id', $this->transaction_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':status', $this->status);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Transacción creada exitosamente";
        }
        throw new Exception("Error al crear la transacción: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener todas las transacciones.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer transacciones: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una transacción por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->order_id = $row['order_id'];
                $this->transaction_id = $row['transaction_id'];
                $this->amount = $row['amount'];
                $this->status = $row['status'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Transacción encontrada" : "Transacción no encontrada";
        }
        throw new Exception("Error al leer la transacción: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar una transacción existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            status = :status,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Transacción actualizada exitosamente";
        }
        throw new Exception("Error al actualizar la transacción: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una transacción existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Transacción eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la transacción: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar transacciones por status.
    public function search($status)
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
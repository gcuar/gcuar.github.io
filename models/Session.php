<?php

class Session
{
    private $conn;
    private $table_name = "sessions";

    public $id;
    public $user_id;
    public $token;
    public $expires_at;

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

        if (empty($this->token)) {
            throw new Exception("El token no puede estar vacío");
        }

        if (empty($this->expires_at)) {
            throw new Exception("El expires_at no puede estar vacío");
        }
    }

    // Método para obtener todas las sesiones.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer sesiones: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una sesión por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->user_id = $row['user_id'];
                $this->token = $row['token'];
                $this->expires_at = $row['expires_at'];
            }
            return $row ? "Sesión encontrada" : "Sesión no encontrada";
        }
        throw new Exception("Error al leer la sesión: " . $stmt->errorInfo()[2]);
    }

    // Método para crear una nueva sesión.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            user_id, token, expires_at
        ) VALUES (
            :user_id, :token, :expires_at
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->token = htmlspecialchars(strip_tags($this->token));
        $this->expires_at = htmlspecialchars(strip_tags($this->expires_at));

        // Vincular los valores.
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':expires_at', $this->expires_at);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Sesión creada exitosamente";
        }
        throw new Exception("Error al crear la sesión: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar una sesión existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            user_id = :user_id,
            token = :token,
            expires_at = :expires_at
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->token = htmlspecialchars(strip_tags($this->token));
        $this->expires_at = htmlspecialchars(strip_tags($this->expires_at));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':expires_at', $this->expires_at);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Sesión actualizada exitosamente";
        }
        throw new Exception("Error al actualizar la sesión: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una sesión existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Sesión eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la sesión: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar sesiones por token.
    public function search($token)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE token LIKE :token";
        $stmt = $this->conn->prepare($query);
        $token = htmlspecialchars(strip_tags($token));
        $token = "%{$token}%";
        $stmt->bindParam(':token', $token);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error en la búsqueda: " . $stmt->errorInfo()[2]);
    }
}

?>
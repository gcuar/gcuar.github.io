<?php

class Search
{
    private $conn;
    private $table_name = "searches";

    public $id;
    public $query;
    public $results_count;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if (empty($this->query)) {
            throw new Exception("La consulta no puede estar vacía");
        }

        if ($this->results_count < 0 || !is_int($this->results_count)) {
            throw new Exception("El conteo de resultados debe ser un entero no negativo");
        }
    }

    // Método para registrar una nueva búsqueda.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            query, results_count
        ) VALUES (
            :query, :results_count
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->query = htmlspecialchars(strip_tags($this->query));
        $this->results_count = htmlspecialchars(strip_tags($this->results_count));

        // Vincular los valores.
        $stmt->bindParam(':query', $this->query);
        $stmt->bindParam(':results_count', $this->results_count);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Búsqueda registrada exitosamente";
        }
        throw new Exception("Error al registrar la búsqueda: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener todas las búsquedas.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer búsquedas: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una búsqueda por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->query = $row['query'];
                $this->results_count = $row['results_count'];
                $this->created_at = $row['created_at'];
            }
            return $row ? "Búsqueda encontrada" : "Búsqueda no encontrada";
        }
        throw new Exception("Error al leer la búsqueda: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una búsqueda existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Búsqueda eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la búsqueda: " . $stmt->errorInfo()[2]);
    }
}

?>
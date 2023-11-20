<?php

class Category
{
    private $conn;
    private $table_name = "categories";

    public $id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para validar datos.
    private function validate()
    {
        if (empty($this->name)) {
            throw new Exception("El nombre no puede estar vacío");
        }
    }

    // Método para obtener todas las categorías.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer categorías: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener una categoría por ID.
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->name = $row['name'];
                $this->description = $row['description'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Categoría encontrada" : "Categoría no encontrada";
        }
        throw new Exception("Error al leer la categoría: " . $stmt->errorInfo()[2]);
    }

    // Método para crear una nueva categoría.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            name, description, created_at
        ) VALUES (
            :name, :description, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Categoría creada exitosamente";
        }
        throw new Exception("Error al crear la categoría: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar una categoría existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            name = :name,
            description = :description,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Categoría actualizada exitosamente";
        }
        throw new Exception("Error al actualizar la categoría: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar una categoría existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Categoría eliminada exitosamente";
        }
        throw new Exception("Error al eliminar la categoría: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar categorías por nombre.
    public function search($keywords)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE :keywords OR description LIKE :keywords";
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
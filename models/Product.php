<?php

class Product
{
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $image_url;
    public $stock;
    public $created_at;
    public $updated_at;
    public $fabricante;
    public $descrip_fabricante;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Método para validar datos.
    private function validate()
    {
        if (empty($this->name)) {
            throw new Exception("El nombre no puede estar vacío");
        }

        if (empty($this->description)) {
            throw new Exception("La descripción no puede estar vacía");
        }

        if (empty($this->fabricante)) {
            throw new Exception("El nombre del fabricante no puede estar vacío");
        }

        if (empty($this->descrip_fabricante)) {
            throw new Exception("La descripción del fabricante no puede estar vacía");
        }

        if ($this->price < 0) {
            throw new Exception("El precio no puede ser negativo");
        }

        if ($this->stock < 0 || !is_int($this->stock)) {
            throw new Exception("El stock debe ser un entero no negativo");
        }

        if ($this->category_id <= 0 || !is_int($this->category_id)) {
            throw new Exception("El category_id debe ser un entero positivo");
        }
    }

    // Método para obtener todos los productos.
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer productos: " . $stmt->errorInfo()[2]);
    }

    // Método para obtener un producto por ID.
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
                $this->fabricante = $row['fabricante'];
                $this->descrip_fabricante = $row['descrip_fabricante'];
                $this->price = $row['price'];
                $this->category_id = $row['category_id'];
                $this->image_url = $row['image_url'];
                $this->stock = $row['stock'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Producto encontrado" : "Producto no encontrado";
        }
        throw new Exception("Error al leer el producto: " . $stmt->errorInfo()[2]);
    }

    // Método para crear un nuevo producto.
    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            name, description, price, category_id, image_url, stock, created_at
        ) VALUES (
            :name, :description, :price, :category_id, :image_url, :stock, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->fabricante = htmlspecialchars(strip_tags($this->fabricante));
        $this->descrip_fabricante = htmlspecialchars(strip_tags($this->descrip_fabricante));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':name', $this->fabricante);
        $stmt->bindParam(':description', $this->descrip_fabricante);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':stock', $this->stock);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Producto creado exitosamente";
        }
        throw new Exception("Error al crear el producto: " . $stmt->errorInfo()[2]);
    }

    // Método para actualizar un producto existente.
    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            name = :name,
            description = :description,
            price = :price,
            category_id = :category_id,
            image_url = :image_url,
            stock = :stock,
            fabricante = :fabricante,
            descrip_fabricante = :descrip_fabricante,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->fabricante = htmlspecialchars(strip_tags($this->fabricante));
        $this->descrip_fabricante = htmlspecialchars(strip_tags($this->descrip_fabricante));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':name', $this->fabricante);
        $stmt->bindParam(':description', $this->descrip_fabricante);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':stock', $this->stock);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Producto actualizado exitosamente";
        }
        throw new Exception("Error al actualizar el producto: " . $stmt->errorInfo()[2]);
    }

    // Método para eliminar un producto existente.
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Producto eliminado exitosamente";
        }
        throw new Exception("Error al eliminar el producto: " . $stmt->errorInfo()[2]);
    }

    // Método para buscar productos por nombre.
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

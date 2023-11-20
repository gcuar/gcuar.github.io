<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $address;
    public $phone;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    private function validate()
    {
        if (empty($this->name)) {
            throw new Exception("El nombre no puede estar vacío");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email no es válido");
        }

        if (empty($this->password)) {
            throw new Exception("La contraseña no puede estar vacía");
        }
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        }
        throw new Exception("Error al leer usuarios: " . $stmt->errorInfo()[2]);
    }

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->name = $row['name'];
                $this->email = $row['email'];
                $this->password = $row['password'];
                $this->address = $row['address'];
                $this->created_at = $row['created_at'];
                $this->updated_at = $row['updated_at'];
            }
            return $row ? "Usuario encontrado" : "Usuario no encontrado";
        }
        throw new Exception("Error al leer el usuario: " . $stmt->errorInfo()[2]);
    }

    public function create()
    {
        $this->validate();

        $query = "INSERT INTO " . $this->table_name . " (
            name, email, password, phone, created_at
        ) VALUES (
            :name, :email, :password, :phone, NOW()
        )";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':phone', $this->phone);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Usuario creado exitosamente";
        }
        throw new Exception("Error al crear el usuario: " . $stmt->errorInfo()[2]);
    }

    public function update()
    {
        $this->validate();

        $query = "UPDATE " . $this->table_name . " SET
            name = :name,
            email = :email,
            password = :password,
            address = :address,
            updated_at = NOW()
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores.
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Usuario actualizado exitosamente";
        }
        throw new Exception("Error al actualizar el usuario: " . $stmt->errorInfo()[2]);
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta.
        if ($stmt->execute()) {
            return "Usuario eliminado exitosamente";
        }
        throw new Exception("Error al eliminar el usuario: " . $stmt->errorInfo()[2]);
    }

    public function search($keywords)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE :keywords OR email LIKE :keywords";
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

    // Método para obtener un usuario por email
    public function readByEmail()
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Limpiar el email
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Vincular el email
        $stmt->bindParam(':email', $this->email);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }
}

?>
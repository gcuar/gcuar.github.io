<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../config/Database.php';

class UsersController
{
    private $db;
    private $user;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->user = new User($this->db);
    }

    // Método para obtener todos los usuarios.
    public function index()
    {
        try {
            $stmt = $this->user->read();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $users]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener un usuario por ID.
    public function show($id)
    {
        try {
            $this->user->id = $id;
            $message = $this->user->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para crear un nuevo usuario.
    public function create($name, $email, $password, $phone)
    {
        try {
            $this->user->name = $name;
            $this->user->email = $email;
            $this->user->password = password_hash($password, PASSWORD_DEFAULT);
            $this->user->phone = $phone;
            $message = $this->user->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar un usuario existente.
    public function update($id, $name, $email, $password, $address)
    {
        try {
            $this->user->id = $id;
            $this->user->name = $name;
            $this->user->email = $email;
            $this->user->password = $password;
            $this->user->address = $address;
            $message = $this->user->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar un usuario existente.
    public function delete($id)
    {
        try {
            $this->user->id = $id;
            $message = $this->user->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar usuarios por nombre o email.
    public function search($keywords)
    {
        try {
            $stmt = $this->user->search($keywords);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $users]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para iniciar sesión
    public function login($email, $password)
    {
        try {
            // Preparar la consulta para buscar el usuario por email
            $this->user->email = $email;
            $stmt = $this->user->readByEmail();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión PHP
                session_start();
                // Almacenar el identificador del usuario y su nombre en la sesión
                $_SESSION['user_id'] = $user['id']; // Almacenar el ID del usuario
                $_SESSION['user_name'] = $user['name']; // Almacenar el nombre del usuario

                // Redirigir al usuario a la página de inicio
                header('Location: ../home.php');
                exit();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}

<?php

require_once '../models/Session.php';
require_once '../config/Database.php';

class SessionController
{
    private $db;
    private $session;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->session = new Session($this->db);
    }

    // Método para obtener todas las sesiones.
    public function index()
    {
        try {
            $stmt = $this->session->read();
            $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $sessions]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una sesión por ID.
    public function show($id)
    {
        try {
            $this->session->id = $id;
            $message = $this->session->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para crear una nueva sesión.
    public function create($user_id, $token, $expires_at)
    {
        try {
            $this->session->user_id = $user_id;
            $this->session->token = $token;
            $this->session->expires_at = $expires_at;
            $message = $this->session->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar una sesión existente.
    public function update($id, $user_id, $token, $expires_at)
    {
        try {
            $this->session->id = $id;
            $this->session->user_id = $user_id;
            $this->session->token = $token;
            $this->session->expires_at = $expires_at;
            $message = $this->session->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una sesión existente.
    public function delete($id)
    {
        try {
            $this->session->id = $id;
            $message = $this->session->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar sesiones por token.
    public function search($token)
    {
        try {
            $stmt = $this->session->search($token);
            $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $sessions]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
<?php

require_once '../models/Search.php';
require_once '../config/Database.php';

class SearchController
{
    private $db;
    private $search;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->search = new Search($this->db);
    }

    // Método para registrar una nueva búsqueda.
    public function create($query, $results_count)
    {
        try {
            $this->search->query = $query;
            $this->search->results_count = $results_count;
            $message = $this->search->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todas las búsquedas.
    public function index()
    {
        try {
            $stmt = $this->search->read();
            $searches = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $searches]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una búsqueda por ID.
    public function show($id)
    {
        try {
            $this->search->id = $id;
            $message = $this->search->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una búsqueda existente.
    public function delete($id)
    {
        try {
            $this->search->id = $id;
            $message = $this->search->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
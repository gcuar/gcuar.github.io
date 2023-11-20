<?php

require_once '../models/Category.php';
require_once '../config/Database.php';

class CategoriesController
{
    private $db;
    private $category;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->category = new Category($this->db);
    }

    // Método para crear una nueva categoría.
    public function create($name, $description)
    {
        try {
            $this->category->name = $name;
            $this->category->description = $description;
            $message = $this->category->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todas las categorías.
    public function index()
    {
        try {
            $stmt = $this->category->read();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $categories]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una categoría por ID.
    public function show($id)
    {
        try {
            $this->category->id = $id;
            $message = $this->category->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar una categoría existente.
    public function update($id, $name, $description)
    {
        try {
            $this->category->id = $id;
            $this->category->name = $name;
            $this->category->description = $description;
            $message = $this->category->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una categoría existente.
    public function delete($id)
    {
        try {
            $this->category->id = $id;
            $message = $this->category->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar categorías por nombre o descripción.
    public function search($keywords)
    {
        try {
            $stmt = $this->category->search($keywords);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $categories]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
<?php

require_once __DIR__ . '/../models/Product.php';

class ProductsController
{
    private $product;
    private $conn;

    public function __construct($db)
    {
        $this->product = new Product($db);
        $this->conn = $db;
    }

    // Método para mostrar todos los productos
    public function index()
    {
        try {
            $stmt = $this->product->read();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para mostrar un producto específico
    public function show($id)
    {
        try {
            $this->product->id = $id;
            $message = $this->product->readOne();
            return $message === "Producto encontrado" ? $this->product : ['error' => $message];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para crear un nuevo producto
    public function create($data)
    {
        try {
            $this->product->name = $data['name'];
            $this->product->description = $data['description'];
            $this->product->price = $data['price'];
            $this->product->category_id = $data['category_id'];
            $this->product->image_url = $data['image_url'];
            $this->product->stock = $data['stock'];
            $message = $this->product->create();
            return ['message' => $message];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para actualizar un producto existente
    public function update($id, $data)
    {
        try {
            $this->product->id = $id;
            $this->product->name = $data['name'];
            $this->product->description = $data['description'];
            $this->product->price = $data['price'];
            $this->product->category_id = $data['category_id'];
            $this->product->image_url = $data['image_url'];
            $this->product->stock = $data['stock'];
            $message = $this->product->update();
            return ['message' => $message];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para eliminar un producto
    public function delete($id)
    {
        try {
            $this->product->id = $id;
            $message = $this->product->delete();
            return ['message' => $message];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para buscar productos
    public function search($keywords)
    {
        try {
            $stmt = $this->product->search($keywords);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getLimitedProducts($limit)
    {
        $query = "SELECT * FROM products LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
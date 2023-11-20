<?php

require_once '../models/OrderDetail.php';
require_once '../config/Database.php';

class OrderDetailController
{
    private $db;
    private $orderDetail;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderDetail = new OrderDetail($this->db);
    }

    // Método para crear un nuevo detalle de orden.
    public function create($order_id, $product_id, $quantity, $price)
    {
        try {
            $this->orderDetail->order_id = $order_id;
            $this->orderDetail->product_id = $product_id;
            $this->orderDetail->quantity = $quantity;
            $this->orderDetail->price = $price;
            $message = $this->orderDetail->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todos los detalles de órdenes.
    public function index()
    {
        try {
            $stmt = $this->orderDetail->read();
            $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $orderDetails]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener un detalle de orden por ID.
    public function show($id)
    {
        try {
            $this->orderDetail->id = $id;
            $message = $this->orderDetail->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar un detalle de orden existente.
    public function update($id, $order_id, $product_id, $quantity, $price)
    {
        try {
            $this->orderDetail->id = $id;
            $this->orderDetail->order_id = $order_id;
            $this->orderDetail->product_id = $product_id;
            $this->orderDetail->quantity = $quantity;
            $this->orderDetail->price = $price;
            $message = $this->orderDetail->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar un detalle de orden existente.
    public function delete($id)
    {
        try {
            $this->orderDetail->id = $id;
            $message = $this->orderDetail->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar detalles de orden por order_id o product_id.
    public function search($keywords)
    {
        try {
            $stmt = $this->orderDetail->search($keywords);
            $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $orderDetails]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
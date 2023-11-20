<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../config/Database.php';

class OrdersController
{
    private $db;
    private $order;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->order = new Order($this->db);
    }

    // Método para crear una nueva orden.
    public function create($user_id, $total_price, $status)
    {
        try {
            $this->order->user_id = $user_id;
            $this->order->total_price = $total_price;
            $this->order->status = $status;
            $message = $this->order->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todas las órdenes.
    public function index()
    {
        try {
            $stmt = $this->order->read();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $orders]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una orden por ID.
    public function show($id)
    {
        try {
            $this->order->id = $id;
            $message = $this->order->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar el estado de una orden existente.
    public function update($id, $status)
    {
        try {
            $this->order->id = $id;
            $this->order->status = $status;
            $message = $this->order->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una orden existente.
    public function delete($id)
    {
        try {
            $this->order->id = $id;
            $message = $this->order->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar órdenes por estado.
    public function searchByStatus($status)
    {
        try {
            $stmt = $this->order->searchByStatus($status);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $orders]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
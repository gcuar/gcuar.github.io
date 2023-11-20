<?php

require_once '../models/Transaction.php';
require_once '../config/Database.php';

class TransactionController
{
    private $db;
    private $transaction;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->transaction = new Transaction($this->db);
    }

    // Método para crear una nueva transacción.
    public function create($order_id, $transaction_id, $amount, $status)
    {
        try {
            $this->transaction->order_id = $order_id;
            $this->transaction->transaction_id = $transaction_id;
            $this->transaction->amount = $amount;
            $this->transaction->status = $status;
            $message = $this->transaction->create();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener todas las transacciones.
    public function index()
    {
        try {
            $stmt = $this->transaction->read();
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $transactions]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener una transacción por ID.
    public function show($id)
    {
        try {
            $this->transaction->id = $id;
            $message = $this->transaction->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para actualizar el estado de una transacción existente.
    public function update($id, $status)
    {
        try {
            $this->transaction->id = $id;
            $this->transaction->status = $status;
            $message = $this->transaction->update();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar una transacción existente.
    public function delete($id)
    {
        try {
            $this->transaction->id = $id;
            $message = $this->transaction->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para buscar transacciones por estado.
    public function search($status)
    {
        try {
            $stmt = $this->transaction->search($status);
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $transactions]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
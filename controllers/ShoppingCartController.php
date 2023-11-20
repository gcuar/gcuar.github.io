<?php

 require_once __DIR__ . '/../models/ShoppingCart.php';
 require_once __DIR__ . '/../config/Database.php';


class ShoppingCartController
{
    private $db;
    private $shoppingCart;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->shoppingCart = new ShoppingCart($this->db);
    }

    // Método para obtener todos los elementos del carrito de un usuario.
    public function index($user_id)
    {
        try {
            $this->shoppingCart->user_id = $user_id;
            $stmt = $this->shoppingCart->read();
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(['data' => $cartItems]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para obtener un elemento específico del carrito de un usuario.
    public function show($user_id, $product_id)
    {
        try {
            $this->shoppingCart->user_id = $user_id;
            $this->shoppingCart->product_id = $product_id;
            $message = $this->shoppingCart->readOne();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para agregar o actualizar un elemento en el carrito de un usuario.
    public function createOrUpdate($user_id, $product_id, $quantity)
    {
        try {
            echo 'ESTOY DENTRO';
            $this->shoppingCart->user_id = $user_id;
            $this->shoppingCart->product_id = $product_id;
            $this->shoppingCart->quantity = $quantity;
            $message = $this->shoppingCart->createOrUpdate();
            echo $message;
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            echo $e;
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método para eliminar un elemento del carrito de un usuario.
    public function delete($user_id, $product_id)
    {
        try {
            $this->shoppingCart->user_id = $user_id;
            $this->shoppingCart->product_id = $product_id;
            $message = $this->shoppingCart->delete();
            return json_encode(['message' => $message]);
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

?>
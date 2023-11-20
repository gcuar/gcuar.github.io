<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/ShoppingCartController.php';
require_once(__DIR__ . '/../../config/Database.php');

$database = new Database();
$db = $database->getConnection();

$shoppingCartController = new ShoppingCartController($db);
$cartItems = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $shoppingCart = json_decode($shoppingCartController->index((int) $user_id))->data;

    $cartItems = count($shoppingCart);
}






?>


<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">

    <div class="container">

        <a class="navbar-brand" href="<?php echo $navLinks['home']; ?>">Magic <span>Toys</span></a>

        <div class="order-lg-last btn-group">

            <a href="<?php echo $navLinks['cart']; ?>" class="btn-cart dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span class="flaticon-shopping-bag"></span>
                <div class="d-flex justify-content-center align-items-center"><small><?php echo $cartItems ?></small></div>
            </a>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menú
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="<?php echo $navLinks['home']; ?>" class="nav-link">Inicio</a></li>
                <li class="nav-item active"><a href="<?php echo $navLinks['about']; ?>" class="nav-link">Sobre
                        nosotros</a></li>
                <li class="nav-item active"><a href="<?php echo $navLinks['catalog']; ?>" class="nav-link">Catálogo</a>
                </li>
                <li class="nav-item active"><a href="<?php echo $navLinks['contact']; ?>" class="nav-link">Contacto</a>
                </li>
            </ul>
        </div>

    </div>

</nav>
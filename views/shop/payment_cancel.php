<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/ProductsController.php';
require_once __DIR__ . '/../../controllers/ReviewController.php';
require_once(__DIR__ . '/../../config/Database.php');
require_once(__DIR__ . '/../../models/Review.php');

$db = new Database();
$dbConnection = $db->getConnection();

$productsController = new ProductsController($dbConnection);
$reviewController = new ReviewController();

$products = $productsController->index();
$reviewsJson = $reviewController->index();
$reviews = json_decode($reviewsJson, true)['data'];
$reviews = $reviewController->getRecentReviews();

$navLinks = [
    'home' => '../home.php',
    'about' => '../info/about.php',
    'catalog' => '../products/product.php',
    'offers' => 'offers.php',
    'contact' => '../info/contact.php',
    'cart' => '../shop/cart.php'
];

?>

<!DOCTYPE html>

<html lang="es">

<head>
    <title>Pago cancelado</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../assets/css/animate.css">

    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="../../assets/css/flaticon.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<?php
    include '../components/header.php';
    include '../components/navbar.php';
    ?>

    
<section class="hero-wrap hero-wrap-2" style="background-image: url('../../assets/images/bg_2.jpg');" data-stellar-background-ratio="0.5">

<div class="overlay"></div>

<div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="../home.php">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Catálogo <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Juguetes</h2>
        </div>
    </div>
</div>
</section>


<div class="container mt-3">

<div class="alert alert-success">
  <strong>¡Lo sentimos!</strong> El pago de tu pedido ha sido cancelado.
</div>
 
</div>

</body>
</html>
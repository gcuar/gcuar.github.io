<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/ProductsController.php';
require_once __DIR__ . '/../../controllers/ShoppingCartController.php';
require_once(__DIR__ . '/../../config/Database.php');

$products = false;

if (isset($_SESSION['user_id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $shoppingCartController = new ShoppingCartController($db);
    $productsController = new ProductsController($db);

    $user_id = $_SESSION['user_id'];

    $shoppingCart = json_decode($shoppingCartController->index($user_id))->data;

    $productsjson = '[';

    foreach ($shoppingCart as $item) {
        $productoObjeto = $productsController->show($item->product_id);
        $productoObjeto->quantity = $item->quantity;
        $productsjson .= json_encode($productoObjeto) . ', ';
    }
    $productsjson = substr($productsjson, 0, -2);
    $productsjson .= ']';

    $products = json_decode($productsjson);

    $cartTotal = 0;

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'deleteProduct') {
            $shoppingCartController->delete((int) $user_id, (int) $_POST['productId']);
        }
    }
}
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
<html lang="en">

<head>
    <title>Magic Toys</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

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
    include '../components/headerInfo.php';
    include '../components/navbar.php';
    ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('../../assets/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Carrito <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Mi Carrito</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section">
        <?php
        if ($products) {
            echo
            <<<HTML
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
HTML;
            foreach ($products as $product) :
                $productTotal = $product->price * $product->quantity;
                $cartTotal = $cartTotal + $productTotal;
                echo
                <<<HTML
<tr class="alert" role="alert">
	<td>
		<div class="img" style="background-image: url(../../$product->image_url);"></div>
	</td>
	<td>
		<div class="email">
			<span>$product->name</span>
			<span>$product->description</span>
		</div>
	</td>
	<td>$product->price €</td>
	<td >$product->quantity</td>
	<td> $productTotal €</td>
	<td>
		<button type="button" onclick="deleteProduct($product->id)" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true"><i class="fa fa-close"></i></span>
		</button>
	</td>
</tr>
HTML;
            endforeach;
            echo
            <<<HTML
                        </tbody>
                    </table>
                </div>
            </div>           
<div class="row justify-content-end">
    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
            <h3>Total del carrito</h3>
            <hr>
            <p class="d-flex total-price">
                <span>Total</span>
                <span>$cartTotal €</span>
            </p>
        </div>
        <p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Ir a pagar</a></p>
    </div>
</div>
HTML;
        } else {
            echo '<div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>';
        }
        ?>
        </div>
    </section>

    <?php
    include '../components/footerInfo.php';
    ?>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.easing.1.3.js"></script>
    <script src="../../assets/js/jquery.waypoints.min.js"></script>
    <script src="../../assets/js/jquery.stellar.min.js"></script>
    <script src="../../assets/js/owl.carousel.min.js"></script>
    <script src="../../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../../assets/js/jquery.animateNumber.min.js"></script>
    <script src="../../assets/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="../../assets/js/google-map.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="../../assets/js/main.js"></script>

</body>

</html>

<script>
    function deleteProduct(product_id) {
        event.preventDefault();

        $.ajax({
            url: "cart.php",
            data: {
                action: "deleteProduct",
                productId: product_id,
            }, // Cambié la forma de pasar los datos
            method: "POST" // Agregué el método HTTP
        }).done(function() {}).fail(function() {});
    }
</script>
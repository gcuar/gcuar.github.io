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

    $totalAmount = 0;

    foreach ($products as $product) {
        $productTotal = $product->price * $product->quantity;
        $totalAmount = $totalAmount + $productTotal;
    }
}

$i = 0;

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
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Pago <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Pago</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="#" class="billing-form">
                        <h3 class="mb-4 billing-heading">Detalles de la compra</h3>
                        <div class="row row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Nombre</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Apellidos</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">País</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="" class="form-control">
                                            <option value="">Francia</option>
                                            <option value="">Italia</option>
                                            <option value="">Filipinas</option>
                                            <option value="">Korea del sur</option>
                                            <option value="">Hongkong</option>
                                            <option value="">Japon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Dirección</label>
                                    <input type="text" class="form-control" placeholder="Calle y portal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apartamento (opcional)">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Ciudad</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Código postal*</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                        </div>
                    </form>
                    <form action="https://www.sandbox.paypal.com/es/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="upload" value="1">
                        <input type="hidden" name="business" value='sb-43z7ea27906156@business.example.com'>
                        <input type="hidden" name="currency_code" value="EUR">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Articulos de la cesta</h3>
                                <hr>

                                <?php foreach ($products as $product) :
                                    $i = $i + 1;
                                    $itemName = "item_name_" . $i;
                                    $itemAmount = "amount_" . $i;
                                    $itemQuantity = "quantity_" . $i;
                                    echo
                                    <<<HTML
                                    <p class="d-flex total-price">
                                        <span class="mr-2" name="$itemQuantity">$product->quantity</span>
                                        <span class="mr-2" name="$itemName">$product->name<span>
                                        <span class="mr-2" name="$itemAmount">$product->price<span>
                                        
                                    </p>
                                    <input type="hidden" name="$itemName" value="$product->name">
                                    <input type="hidden" name="$itemQuantity" value="$product->quantity">
                                    <input type="hidden" name="$itemAmount" value="$product->price">
                                HTML;
                                endforeach; ?>
                            </div>
                        </div>


                        <div class="row mt-5 pt-3 d-flex">
                            <div class="col-md-6 d-flex">
                                <div class="cart-detail cart-total p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Total del carrito</h3>
                                    <hr>
                                    <p class="d-flex total-price">
                                        <span>Total</span>
                                        <span><?php echo $totalAmount; ?> €</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cart-detail p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Método de pago</h3>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" class="mr-2" checked> Paypal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="" class="mr-2"> He leído y acepto las
                                                    condiciones</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p><input type='submit' class="btn btn-primary py-3 px-4" value="Realizar pedido"></p>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div> <!-- .col-md-8 -->
        </div>
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
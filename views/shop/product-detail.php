<?php
// Página que muestra información detallada de un producto específico seleccionado, incluyendo imágenes, descripción, precio, y opción para añadir al carrito.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/ProductsController.php';
require_once __DIR__ . '/../../controllers/ShoppingCartController.php';
require_once(__DIR__ . '/../../config/Database.php');

$database = new Database();
$db = $database->getConnection();
$shoppingCartController = new ShoppingCartController($db);




$productsController = new ProductsController($db);

$product_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Producto no encontrado.');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'addToCart') {
            $shoppingCartController->createOrUpdate((int) $user_id, (int) $product_id, (int) $_POST['cantidad']);
        }
    }
}


$product_data = $productsController->show($product_id);

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
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Inicio <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Productos
                                <i class="fa fa-chevron-right"></i></a></span> <span>Detalles de producto <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Detalles de producto</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="../../assets/images/prod-<?php echo $product_id; ?>.jpg" class="image-popup prod-img-bg">
                        <img src="../../assets/images/prod-<?php echo $product_id; ?>.jpg" class="img-fluid" alt="Colorlib Template"></a>
                </div>

                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>
                        <?php echo $product_data->name ?>
                    </h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <!-- <a href="#" class="mr-2">5.0</a> -->
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <!-- <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p> -->
                    </div>
                    <p class="price"><span>
                            <?php echo $product_data->price ?> €
                        </span></p>
                    <p>
                        <?php echo $product_data->description ?>
                    </p>
                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;"><?php echo $product_data->stock ?> disponibles en stock</p>
                        </div>
                    </div>
                    <p><a onclick="addToCart()" class="btn btn-primary py-3 px-5 mr-2">Añadir al carrito</a><a href="cart.php" class="btn btn-primary py-3 px-5">Comprar ahora</a></p>
                    <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">

                        <input type="hidden" name="business" value="sb-43z7ea27906156@business.example.com">
                        <input type="hidden" name="item_name" value="<?php echo $product_data->name;?>">
                        <input type="hidden" name="item_number" value="<?php echo $product_data->id;?>">
                        <input type="hidden" name="amount" value="<?php echo $product_data->price;?>">
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="no_shipping" value="1">
                        <input type="hidden" name="cmd" value="_xclick">

                        <!Si pones los directorios como "../../views/paypal/success.php" te redirige a paypalobjects, por eso he puesto la dirección completa>
                        <input type="hidden" name="return" value="http://magictoys2/views/shop/payment_success.php">
                        <input type="hidden" name="cancel_return" value="http://magictoys2/views/shop/payment_cancel.php">

                        <button type="submit">
                            <img src="../../assets/images/paypal.png" />
                        </button>

                    </form> 
                </div>
            </div>




            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Descripción</a>

                        <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Fabricante</a>

                        <!-- <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Reseñas</a> -->

                    </div>
                </div>
                <div class="col-md-12 tab-wrap">

                    <div class="tab-content bg-light" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4">
                                    <?php echo $product_data->name ?>
                                </h3>
                                <p>
                                    <?php echo $product_data->description ?>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">
                                    <?php echo $product_data->fabricante ?>
                                </h3>
                                <p>
                                    <?php echo $product_data->descrip_fabricante ?>
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                            <div class="p-4">
                                <h3 class="mb-4">
                                    <?php echo $product_data->name ?>
                                </h3>
                                <p>
                                    <?php echo $product_data->description ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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

    <script>
        $(document).ready(function() {
            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });
        });

        function addToCart() {
            event.preventDefault();
            var quantity = $('#quantity').val();
            $.ajax({
                url: "product-detail.php?id=" + <?php echo $product_id; ?>,
                data: {
                    action: "addToCart",
                    cantidad: quantity,
                }, // Cambié la forma de pasar los datos
                method: "POST" // Agregué el método HTTP
            }).done(function() {
                window.location.href = '../products/product.php';
            }).fail(function() {

            });

        }
    </script>

</body>

</html>
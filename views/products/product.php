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
    'catalog' => 'product.php',
    'offers' => 'offers.php',
    'contact' => '../info/contact.php',
    'cart' => '../shop/cart.php'
];

?>

<!DOCTYPE html>

<html lang="es">

<head>
    <title>Catálogo de juguetes</title>
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
    include '../components/headerInfo.php';
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

    <section class="ftco-section">

        <div class="container">

            <div class="row">

                <div class="col-md-9">

                    <!-- <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h4 class="product-select">Seleccione un juguete para filtrar:</h4>
                            <select class="selectpicker" multiple data-none-selected-text="Sin selección">
                                <option>Osito de peluche</option>
                                <option>Piano de juguete</option>
                                <option>Tren de juguete</option>
                                <option>Juego de mesa</option>
                                <option>Nave espacial</option>
                                <option>Muñeca de peluche</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="row">

                        <?php foreach ($products as $product) : ?>
                            <div class="col-md-4 d-flex">
                                <div class="product ftco-animate">
                                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(<?php echo '../../' . $product['image_url']; ?>);">
                                        <div class="desc">
                                            <p class="meta-prod d-flex">
                                                <a href="../shop/product-detail.php?id=<?php echo $product['id']; ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text text-center">
                                        <span class="category" style="font-size: 26px;">
                                            <?php echo $product['name']; ?>
                                        </span>
                                        <br>
                                        <?php echo $product['description']; ?>
                                        <br>
                                        <span class="price">
                                            <?php echo $product['price']; ?>
                                        </span>€
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <h3>Opiniones recientes</h3>
                        <?php
                        foreach ($reviews as $review) :
                            $imageUrl = $reviewController->getImageUrlByProductId($review['product_id']);
                        ?>
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" style="background-image: url(<?php echo '../../' . $imageUrl; ?>);"></a>
                                <div class="text">
                                    <h3 class="heading">
                                        <?php echo htmlspecialchars($review['comment']); ?>
                                    </h3>
                                    <div class="meta">
                                        <div><span class="fa fa-calendar"></span>
                                            <?php echo $review['created_at']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php include '../components/footerInfo.php'; ?>

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="../../assets/js/google-map.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="../../assets/js/main.js"></script>

</body>

</html>
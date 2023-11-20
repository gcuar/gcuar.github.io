<?php

// Iniciar sesión si no hay ninguna activa
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Requerir los archivos necesarios
require_once __DIR__ . '../../controllers/ProductsController.php';
require_once __DIR__ . '../../config/database.php';

// Configuración de la base de datos y obtener productos
$db = new Database();
$dbConnection = $db->getConnection();
$productsController = new ProductsController($dbConnection);
$products = $productsController->getLimitedProducts(6);

// Configuración de los enlaces de navegaci贸n
$navLinks = [
	'home' => 'home.php',
	'about' => 'info/about.php',
	'catalog' => 'products/product.php',
	'offers' => 'products/offers.php',
	'contact' => 'info/contact.php',
	'cart' => 'shop/cart.php'
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

	<link rel="stylesheet" href="../assets/css/animate.css">

	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">

	<link rel="stylesheet" href="../assets/css/flaticon.css">
	<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

	<?php include 'components/header.php'; ?>
	<?php include 'components/navbar.php'; ?>

	<div class="hero-wrap" style="background-image: url('../assets/images/background.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-8 ftco-animate d-flex align-items-end">
					<div class="text w-100 text-center">
						<h1 class="mb-4">Grandes <span>Juguetes</span> para Grandes <span>Sueños</span>.</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-no-pb">
		<div class="container">
			<div class="row">
				<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(../assets/images/town.jpg);">
				</div>
				<div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
					<div class="heading-section">
						<span class="subheading">Desde 1985</span>
						<h2 class="mb-4">Un Sueño Convertido en Símbolo </h2>

						<p>En el tranquilo enclave de un pequeño pueblo escocés, dos hermanos, Liam y Ewan, fundaron
							Magic Toys,
							una tienda de juguetes que nació de la necesidad y el amor por la infancia. La lejanía del
							pueblo hacía
							difícil que los juguetes llegaran a manos de los niños, y, recordando sus propios días de
							anhelo, los hermanos
							decidieron que ningún niño debería quedarse sin la magia de un juguete nuevo. Con ahorros y
							una visión, establecieron
							un lugar donde los sueños infantiles podrían tomar forma tangible, brindando alegría y
							creatividad a la comunidad que tanto amaban.</p>
						<p>Magic Toys pronto se convirtió en más que una tienda; se transformó en un símbolo de alegría
							y en la realización de un sueño compartido.
							Cada juguete en los estantes representaba un mundo de imaginación y aventuras, y la
							felicidad de los niños que entraban por la puerta
							era el testimonio de una misión cumplida. </p>
						<p class="year">
							<strong class="number" data-number="38">0</strong>
							<span>Años creando sonrisas con nuestros juguetes.</span>
						</p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- JUGUETES DETACADOS -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center pb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<h2>¡Juguetes Destacados!</h2>
				</div>
			</div>
			<div class="row">
				<?php foreach ($products as $product) : ?>
					<div class="col-md-4 d-flex">
						<div class="product ftco-animate">
							<div class="img d-flex align-items-center justify-content-center" style="background-image: url(<?php echo '../' . $product['image_url']; ?>);">
								<div class="desc">
									<p class="meta-prod d-flex">
										<a href="shop/product-detail.php?id=<?php echo $product['id']; ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
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

			<div class="row justify-content-center">
				<div class="col-md-4">
					<a href="../views/products/product.php" class="btn btn-primary d-block"> CATÁLOGO <span class="fa fa-long-arrow-right"></span></a>
				</div>
			</div>
		</div>
	</section>

	<!-- FIN JUGUETES DESTACADOS -->

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<h2>Tu opinion nos importa</h2>
				</div>
			</div>

			<?php
			require_once '../config/database.php';

			$database = new Database();
			$db = $database->getConnection();

			// Consulta para obtener las reviews con rating 5, ordenadas por fecha de actualización, y hacer JOIN con las tablas users y products para obtener el nombre del usuario y la imagen del producto
			$query = "SELECT reviews.*, users.name as username, products.image_url as product_image 
						FROM reviews 
						JOIN users ON reviews.user_id = users.id 
						JOIN products ON reviews.product_id = products.id
						WHERE rating = 5 
						ORDER BY reviews.updated_at DESC 
						LIMIT 2";
			$stmt = $db->prepare($query);
			$stmt->execute();

			$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($reviews as $review) {
			?>
				<div class="row d-flex">
					<div class="col-lg-6 d-flex align-items-stretch ftco-animate">
						<div class="blog-entry d-flex">
							<a class="block-20 img" style="background-image: url('<?php echo '../' . $review['product_image']; ?>');">
							</a>
							<div class="text p-4 bg-light">
								<div class="meta">
									<p><span class="fa fa-calendar"></span>
										<?php echo date('d F Y', strtotime($review['updated_at'])); ?>
									</p>
								</div>
								<h3 class="heading mb-3"><a>
										<?php echo $review['username']; ?>
									</a></h3>
								<p>
									<?php echo $review['comment']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>

		</div>
	</section>

	<?php include 'components/footer.php'; ?>

	<!-- INCLUIR EL LOADER -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.easing.1.3.js"></script>
	<script src="../assets/js/jquery.waypoints.min.js"></script>
	<script src="../assets/js/jquery.stellar.min.js"></script>
	<script src="../assets/js/owl.carousel.min.js"></script>
	<script src="../assets/js/jquery.magnific-popup.min.js"></script>
	<script src="../assets/js/jquery.animateNumber.min.js"></script>
	<script src="../assets/js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="../assets/js/google-map.js"></script>
	<script src="../assets/js/main.js"></script>

</body>

</html>
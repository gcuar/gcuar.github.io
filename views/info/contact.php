<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
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

	<link rel="stylesheet" href="../../assets/css/flaticon.css">
	<link rel="stylesheet" href="../../assets/css/style.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


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
					<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Contacto <i class="fa fa-chevron-right"></i></span></p>
					<h2 class="mb-0 bread">Contáctanos</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper px-md-4">
						<div class="row mb-5">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="text">
										<p><span>Dirección:</span> Magic Toys Headquarters, 17 Enchantment Lane,
											Stirling, FK8 2AB, Escocia, Reino Unido</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-phone"></span>
									</div>
									<div class="text">
										<p><span>Teléfono:</span> <a href="tel://1234567920">+34 912 345 678</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-paper-plane"></span>
									</div>
									<div class="text">
										<p><span>Email:</span> <a href="mailto:info@yoursite.com">contacto@magictoys.es</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-globe"></span>
									</div>
									<div class="text">
										<p><span>Website</span> <a href="#">magictoys.com</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="row no-gutters">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Ponte en Contacto</h3>
									<form method="POST" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Nombre Completo</label>
													<input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="email">Correo Electrónico</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject">Caso de Discusión</label>
													<input type="text" class="form-control" name="subject" id="subject" placeholder="...">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#">Mensaje</label>
													<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="..."></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<a href="../home.php" class="btn btn-primary"> Enviar Mensaje </a>
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-5 order-md-first d-flex align-items-stretch">
								<div id="map" class="map"></div>
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
	<!-- <script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
	<script type="text/javascript">
		var map = L.map('map').setView([55.858492, -4.246875], 13); // Coordenadas de Stirling, Escocia

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);
	</script>
	<script type="text/javascript">
		// ... tu código anterior para inicializar el mapa ...

		var marker = L.marker([55.858492, -4.246875]).addTo(map);
		marker.bindPopup("<b>Magic Toys Headquarters</b><br>17 Enchantment Lane, Stirling, FK8 2AB, Escocia, Reino Unido").openPopup();
	</script>
	<script src="../../assets/js/google-map.js"></script>
	<script src="../../assets/js/main.js"></script>

</body>

</html>
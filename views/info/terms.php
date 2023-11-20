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
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Mis Derechos <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Terminos y Condiciones de Uso</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="text">
                            <h2>Asitencia Online 24/7</h2>
                            <p>Nuestros compañeros están para ayudarte en todo lo necesario.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-cashback"></span>
                        </div>
                        <div class="text">
                            <h2>Tu dinero está asegurado</h2>
                            <p>Hasta que no recibas tu preciado juguete no te lo cobraremos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Envíos y Devoluciones Gratuitos</h2>
                            <p>No tendras ningún inconveniente con la recepción o devolución de tu pedido.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <h2 class="mb-4">Terminos y Condiciones de Uso</h2>
                        <h5> En MagicToys, ubicados en el vibrante corazón de Escocia, te brindamos un mundo de diversión y creatividad cuando visitas nuestra tienda online, utilizas nuestros dispositivos, productos o servicios, o cuando empleas aplicaciones móviles o software relacionado con MagicToys (colectivamente, "Servicios de MagicToys"). Consulta nuestra Política de Privacidad, nuestro Aviso de Cookies y nuestro Aviso sobre Publicidad Basada en Intereses del Usuario. Te ofrecemos los Servicios de MagicToys bajo los términos presentados en esta página.

                            Condiciones de Uso

                            Condiciones de Venta

                            Te invitamos a leer detenidamente estas condiciones antes de utilizar los Servicios de MagicToys. Al hacer uso de ellos, aceptas estas condiciones. Nuestros servicios son variados y a veces se aplican términos adicionales. Al utilizar cualquier Servicio de MagicToys, también estarás sujeto a los términos y condiciones generales aplicables a dichos servicios ("Condiciones Generales de los Servicios"). En caso de discrepancias, las Condiciones Generales de los Servicios prevalecerán sobre estas Condiciones de Uso.

                            Comunicaciones Electrónicas
                            Al usar los Servicios de MagicToys o al comunicarte con nosotros electrónicamente, estás interactuando con nosotros de manera electrónica. Nosotros nos comunicaremos contigo por diversos medios electrónicos, como email, mensajes de texto, o publicaciones en nuestro sitio web o a través de otros Servicios de MagicToys. Aceptas que todas las comunicaciones electrónicas cumplen con cualquier requisito legal de ser escritas.

                            Recomendaciones y Personalización
                            Como parte de los Servicios de MagicToys, te ofreceremos recomendaciones, productos y servicios, incluso anuncios de terceros, basados en tus preferencias para personalizar tu experiencia. Para más información, visita nuestro sitio web.

                            Derechos de Autor y Propiedad Intelectual
                            Todo el contenido en los Servicios de MagicToys, como textos, gráficos, logos, imágenes y recopilaciones de datos, es propiedad de MagicToys o sus proveedores de contenido y está protegido por derechos de autor y leyes de propiedad intelectual. No se permite la extracción o reutilización de ninguna parte del contenido de los Servicios de MagicToys sin nuestro consentimiento expreso por escrito.

                            Marcas Registradas
                            Los gráficos, logotipos y nombres de servicio en los Servicios de MagicToys son marcas registradas o representan la imagen comercial de MagicToys. No se pueden usar en relación con productos o servicios que no sean de MagicToys.

                            Licencia y Acceso
                            Te otorgamos una licencia limitada para acceder y utilizar los Servicios de MagicToys para fines personales no comerciales. Esta licencia no incluye reventa, uso comercial, ni extracción de datos.

                            Tu Cuenta
                            Eres responsable de mantener la confidencialidad de tu cuenta y contraseña en MagicToys. Debes tomar medidas para asegurar tu contraseña e informarnos de inmediato si hay uso no autorizado. No podrás usar los Servicios de MagicToys para actividades dañinas, fraudulentas o ilegales. Nos reservamos el derecho de cancelar tu acceso si incumples con estas condiciones.

                            Estos términos son parte de nuestro compromiso para brindarte una experiencia mágica y segura en MagicToys. ¡Esperamos que disfrutes de cada momento en nuestro mundo de juguetes y creatividad!</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>¿Quién está detrás de Magic-Toys?</h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/liam.jpg);"></div>
                        <h3>Sr. Liam Stewart</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/javier.jpg);"></div>
                        <h3>Javier Sánchez</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/sofía.jpg);"></div>
                        <h3>Sofía González</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/carla.jpg);"></div>
                        <h3>Carla Herrera</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/marta.jpg);"></div>
                        <h3>Marta López</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(../../assets/images/ewan.jpg);"></div>
                        <h3>Sr. Ewan McGregor</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img bg-light" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="3257">0</strong>
                            <span>Clientes Satisfechos</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="38">0</strong>
                            <span>Años de Experiencia</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="22">0</strong>
                            <span>Premios</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 py-4 mb-4">
                        <div class="text align-items-center">
                            <strong class="number" data-number="40">0</strong>
                            <span>Marcas</span>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="../../assets/js/google-map.js"></script>
    <script src="../../assets/js/main.js"></script>

</body>

</html>
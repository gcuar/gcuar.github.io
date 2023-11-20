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
                    <h2 class="mb-0 bread">Mis Derechos</h2>
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
            <div class="row">
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <h2 class="mb-4">Derechos del Cliente</h2>
                        <h5> Nos esforzamos por garantizar que cada compra
                            que realices sea una experiencia mágica y satisfactoria. Somos conscientes de que, en ocasiones, puedes
                            desear devolver un producto. La razón de la devolución influirá en el plazo que tienes para realizarla.
                            Si no estás completamente satisfecho con tu compra, te ofrecemos un plazo de 30 días para devolver el producto.
                            En caso de que el producto tenga defectos o daños, tienes derecho a presentar una reclamación. Para productos entregados después
                            de enero de 2022, el plazo para manifestar una falta de conformidad es de tres años, mientras que para los entregados antes de esa fecha,
                            el plazo es de dos años. En nuestra tienda de juguetes, donde la creatividad y la innovación son la esencia de nuestra filosofía,
                            nos comprometemos a asegurar tu plena satisfacción y a abordar cualquier inconveniente con la mayor eficacia.</h5>
                    </div>
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <h2 class="mb-4">Política de Devolución</h2>
                        <h5> En el caso de que no estés completamente contento con tu compra, te ofrecemos la posibilidad de devolver el producto
                            acogiéndote a nuestra política de devoluciones de 30 días, contados desde la fecha en que recibiste el producto.</h5>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <h2 class="mb-4">Derechos de Desistimiento</h2>
                        <h5> Los clientes residentes en la Unión Europea tienen además garantizado por ley el derecho a desistir del contrato de compra de un producto durante 14 días naturales desde el día en que tú o un tercero que hayas indicado (distinto del transportista), recibas el producto comprado o desde que recibas el último artículo, en caso de entrega de un mismo pedido en varios envíos, o del último componente o pieza en caso de entrega de un bien compuesto por múltiples componentes o piezas. Este derecho es aplicable a todos nuestros productos, a excepción de los productos digitales (por ejemplo, MP3), si hubieras consentido la ejecución en el momento de la entrega, así como tampoco podemos aceptar desistimientos de compras de vídeos, DVD, audio, videojuegos, productos sexuales y eróticos, y productos de software cuyos precintos hayan sido abiertos (para más excepciones, consulta la sección Excepciones de nuestras Condiciones de Uso y Venta.

                            Para cancelar una compra durante el periodo de reflexión de 14 días, visita nuestro Centro de devoluciones online e imprime una etiqueta de devolución personalizada para tu producto, indicando el motivo de la devolución, como por ejemplo "ya no lo quiero/necesito". También puedes desistir mediante otros medios; para obtener más información, visita la página Condiciones de Uso y Venta. Empaqueta el producto en cuestión de forma segura y envíanoslo utilizando la etiqueta de devolución personalizada en los 30 días siguientes a la fecha de entrega del producto.

                            Te informamos de que no podemos aceptar devoluciones si nos entregas el producto en mano.

                            Para tu seguridad, te recomendamos que utilices un servicio de envío certificado, en caso de que el importe de devolución sea superior a 75 €.

                            Ten en cuenta que los costes de devolución corren de tu cuenta a menos que el producto no sea conforme y esté cubierto por la garantía legal porque, por ejemplo, te hubiésemos enviado el producto por error, o en caso de que el producto estuviese dañado o defectuoso.

                            Además, una vez comenzado el proceso de envío, ya no podrás cancelar otros servicios adicionales contratados con nosotros (por ejemplo, el envoltorio de regalo).

                            En cuanto recibamos el aviso de cancelación de tu pedido, te reembolsaremos el precio de compra del producto junto con los gastos de envío habituales para ese producto, correspondiente a la opción de envío más barata que ofrezcamos. No podemos reembolsar ningún coste adicional de los gastos de envío por servicio express, prioritario o de mensajería.

                            Para más información sobre tu derecho de desistimiento de la compra dentro del período de reflexión de 14 días, visita la página web oficial del Observatorio de Internet de la Agencia Española de Consumo, Seguridad Alimentaria y Nutrición (AECOSAN) o el sitio web oficial de las Autoridades en materia de consumo de tu Comunidad Autónoma.</h5>
                    </div>
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <h2 class="mb-4">Garantía legal</h2>
                        <h5> Los productos ofrecidos están cubiertos por la garantía legal de tres años para productos entregados después de enero del 2022 y 2 años para productos entregados antes de enero del 2022 a cargo del vendedor, conforme a lo previsto en la normativa de consumidores y usuarios.</h5>
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
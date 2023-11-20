<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <p class="mb-0 phone pl-md-2">
                    <a class="mr-2"> <span class="fa fa-phone mr-1"></span> +34 912 345 678 </a>
                    <a> <span class="fa fa-paper-plane mr-1"></span> contacto@magictoys.es </a>
                </p>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="social-media mr-4">
                    <p class="mb-0 d-flex">
                        <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                    </p>
                </div>
                <div class="reg">
                    <?php if (isset($_SESSION['user_name'])) : ?>
                        <p class="mb-0">
                            <a class="mr-2" style="pointer-events: none; cursor: default;">¡Hola,
                                <?= htmlspecialchars($_SESSION['user_name']); ?>!
                            </a>
                            <a href='../user/logout.php'>Cerrar sesión</a>
                        </p>
                    <?php else : ?>
                        <p class="mb-0">
                            <a href='../user/login_register.php' class="mr-2">Registrarse</a>
                            <a href='../user/login_register.php'>Iniciar sesión</a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
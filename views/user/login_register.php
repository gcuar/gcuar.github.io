<!doctype html>
<html lang="es">

<head>
    <title>¡Bienvenido/a!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/login-register.css">
</head>

<body>
    <?php
    session_start(); // Inicia una nueva sesión o reanuda una sesión existente
    require_once __DIR__ . '/../../controllers/UsersController.php';
    $usersController = new UsersController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'login') {
            // Log in logic
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $usersController->login($email, $password);
            if (!$user) {
                $_SESSION['message'] = 'Email y/o contraseña incorrectos.';
            }
        } elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
            // Registration logic
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $usersController->create($name, $email, $password, $phone);
            $_SESSION['message'] = '¡Te has registrado correctamente!';
        }
    }
    ?>

    <div class="section">
        <div class="container">
            <?php if (isset($_SESSION['message'])): ?>
                <div id="message" class="alert alert-info" role="alert">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']); // Elimina el mensaje de la sesión después de mostrarlo
                    ?>
                </div>
            <?php endif; ?>
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Iniciar sesión </span><span>Registrarse</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Iniciar sesión</h4>
                                            <form method="post">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Correo electrónico">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Contraseña">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <input type="hidden" name="action" value="login">
                                                <button type="submit" class="btn mt-4">Iniciar sesión</button>
                                            </form>
                                            <p class="mb-0 mt-4 text-center"><a href="#" class="link">¿Olvidaste tu
                                                    contraseña?</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-3 pb-3">Registrarse</h4>
                                            <form method="post">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-style"
                                                        placeholder="Nombre completo">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="tel" name="phone" class="form-style"
                                                        placeholder="Número de teléfono">
                                                    <i class="input-icon uil uil-phone"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Correo electrónico">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Contraseña">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <input type="hidden" name="action" value="register">
                                                <button type="submit" class="btn mt-4">Registrarse</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            var element = document.getElementById('message');
            if (element) {
                element.style.display = 'none';
            }
        }, 5000);  
    </script>
</body>

</html>
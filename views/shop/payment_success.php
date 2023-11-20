<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/ProductsController.php';
require_once(__DIR__ . '/../../config/Database.php');

$db = new Database();
$dbConnection = $db->getConnection();

$productsController = new ProductsController($dbConnection);

$products = $productsController->index();

$navLinks = [
  'home' => '../home.php',
  'about' => '../info/about.php',
  'catalog' => '../products/product.php',
  'offers' => 'offers.php',
  'contact' => '../info/contact.php',
  'cart' => '../shop/cart.php'
];



if(!empty($_GET))
{
	$_SESSION['product'] = $_GET['item_name'];  
    $_SESSION['txn_id'] = $_GET['tx']; 
    $_SESSION['amount'] = $_GET['amt']; 
    $_SESSION['currency'] = $_GET['cc']; 
    $_SESSION['status'] = $_GET['st']; 
	$_SESSION['payer_id'] = $_GET['payer_id']; 
	$_SESSION['payer_email'] = $_GET['payer_email']; 
	$_SESSION['payer_name'] = $_GET['first_name'].' '.$_GET['last_name'];
	
	date_default_timezone_set('Europe/Madrid');
	
    $connx = mysqli_connect('localhost', 'root', '', 'magic_toys_db');
	$sql="insert into payments (payment_id,payer_id,payer_name,payer_email,item_id,item_name,currency,amount,status,created_at) values ('".$_SESSION['txn_id']."','".$_SESSION['payer_id']."','".$_SESSION['payer_name']."','".$_SESSION['payer_email']."','','".$_SESSION['product']."','".$_SESSION['currency']."','".$_SESSION['amount']."','". $_SESSION['status']."','".date('y-m-d h:i:s')."')";
	
	$result=mysqli_query($connx,$sql);
	
	
  if($result)
  {
  header('location:payment_success.php');
  }
  else 
  {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
}



?>

<!DOCTYPE html>

<html lang="es">

<head>
    <title>Gracias por tu pedido</title>
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
    include '../components/header.php';
    include '../components/navbar.php';
    ?>


<section class="hero-wrap hero-wrap-2" style="background-image: url('../../assets/images/bg_2.jpg');" data-stellar-background-ratio="0.5">

<div class="overlay"></div>

<div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
        
    </div>
</div>
</section>


<div class="container mt-3">

<div class="alert alert-success">
  <strong>¡Gracias por tu compra!</strong> Hemos recibido tu pedido.
</div>
          
  <table class="table table-bordered">
    <tbody>
      <tr>
        <td>ID del pedido</td>
        <td><?php echo $_SESSION['txn_id'];?></td>
      </tr>
      <tr>
        <td>Producto</td>
        <td><?php echo $_SESSION['product'];?></td>
      </tr>
      <tr>
        <td>Precio Total</td>
        <td><?php echo $_SESSION['amount'];?></td>
      </tr>
	  
	    <tr>
        <td>Estado del Pago</td>
        <td><?php echo $_SESSION['status'];?></td>
      </tr>
	  
    </tbody>
  </table>
</div>

</body>
</html>
<?php 
session_start();

require 'database.php';

if(isset($_SESSION['user_id'])){ 
    $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
    $records ->bindParam(':id', $_SESSION['user_id']);
    $records -> execute();
    $results = $records -> fetch (PDO::FETCH_ASSOC);


   $user = null;

    if(count($results) > 0) {
        $user = $results;

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a tu App</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="">
    <link rel="stylesheet" href="assets/css/style.css" >
</head>
<body>


<?php require 'partials/header.php' ?> 

<?php  if (!empty($user)):?>
    <br>Bienvenid@,  <?= $user['email']?>
    <br>Tu estas Logeado 
     <a href="logout.php">Cerrar sesión </a>
     <?php else: ?>

     <h1>Inicia Sesion o Registrate</h1>

     <a href="login.php">Iniciar sesion </a> o 
     <a href="signup.php">Registrate</a>

     <?php endif; ?>

     <?php require 'partials/footer.php' ?>
</body>
</html>
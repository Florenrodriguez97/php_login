<?php
require 'database.php';

$message='';


if(!empty($_POST['email']) && !empty($_POST['password'])){
$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
$stmt = $conn->prepare($sql);
$stmt -> bindParam(':email',$_POST['email']); 
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt ->bindParam(':password',$password);

if($stmt -> execute()){
    $message = "Se ha creado un nuevo usuario";
}else{
    $message = "Ha ocurrido un error al crear su contraseña";
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrate</title>
    <link rel="stylesheet" href="assets/css/style.css" >


</head>

<body>

<?php require 'partials/header.php' ?> 

<?php if(!empty($message)): ?>
    <p> <?= $message?></p>   
    <?php  endif; ?>




    <h1>Registrate</h1>
 <span> o <a href="login.php">Inicia sesion</a></span>

 <form action="signup.php" method="post">
        <input type="text" name="email" value="" placeholder="Ingrese su email">
        <input type="password" name="password" value="" placeholder="Ingrese su contraseña">
        <input type="password" name="confirm_password" value="" placeholder="Confirme su contraseña">

        <input type="submit" value="Registrarse">

    </form>
    <?php require 'partials/footer.php' ?>
</body>
</html>
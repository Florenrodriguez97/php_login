<?php 

session_start();

if(isset($_SESSION['user_id'])){
    header('Location: /php-login');
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password']))  {
     $records = $conn -> prepare('SELECT id, email, password FROM users WHERE email =:email');
     $records->bindParam(':email', $_POST['email']);
     $records ->execute();
     $results = $records -> fetch(PDO::FETCH_ASSOC);


     $message = '';

     if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
       $_SESSION['user_id'] = $results['id'];
       header('Location:/php-login');
     }else{
         $message = "Lo siento, estas credenciales no coinciden";
     }

     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css" >
    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="">

</head>
<body>

<?php require 'partials/header.php' ?> 

<h1>Iniciar Sesion</h1>
<span>o <a href="signup.php">Registrate</a></span>

<?php if (!empty($message)): ?>
<p><?=$message?> </p>
<?php  endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="email" value="" placeholder="Ingrese su email">
        <input type="password" name="password" value="" placeholder="Ingrese su contraseña">
        <input type="submit" value="Iniciar sesion">

    </form>
    <?php require 'partials/footer.php' ?>
</body>
</html>
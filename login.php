<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: /phplogin/principal.php");
    }
    require 'database.php';

    if (!empty($_POST['email']) & !empty($_POST['password'])) {
        $sql = "SELECT id,nombre,email,username,contraseña FROM usuario WHERE email=:email or username=:email";
        $sen = $con->prepare($sql);
        $sen->bindParam(':email',$_POST['email']);
        
        $sen->execute();
        $results = $sen->fetch(PDO::FETCH_ASSOC);

        $message = ""; 
        if (count($results)>0 && password_verify($_POST['password'], $results['contraseña'])) {
            $_SESSION['user_id'] = $results['id'];
            header("Location: /phplogin/principal.php");

        }else {
            $message = "Usuario o contraseña incorrectos";
           
        }
    }else {
        $message ="Llena todos los campos";
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autla Virtual</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="container">
                
        <div id="cabecera">
            <h2>Incio de sesión</h2>
           
        </div>
        <div>
             <span id="tagline"><a style="padding-right: 10px;" href="index.php">Home</a>
             
            <a  href="registro.php">Registrate</a></span><br>

            <?php if(!empty($message)): ?>
                <p id = "mensaje"> <?= $message ?></p>
                <?php endif; ?>


        </div>
        <div id="formulario">
            
             <form action="login.php" method="post">
                <label for="">E-mail o Username:</label><br>
                <input type="text" name="email" id="frm"><br>

                <label for="">Contraseña:</label><br>
                <input type="password" name="password" id="frm"><br>

                <input type="submit" value="Ingresar" id="boton">

             </form>
        </div>
    </div>
</body>
</html>

<script>
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>
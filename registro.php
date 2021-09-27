<?php
    require 'database.php';

    if (!empty($_POST['nombre']) & !empty($_POST['email']) & !empty($_POST['password'])) {
        $sql = "INSERT INTO usuario (nombre,username,email,contraseña) values (:nombre, :usuario,:email,:password)";
        $sen = $con->prepare($sql);
        $sen->bindParam(':nombre',$_POST['nombre']);
        $sen->bindParam(':usuario',$_POST['usuario']);
        $sen->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sen->bindParam(':password',$password);

        //verificando si el email esta registrado anteriormente
        $sql2 = "SELECT COUNT(*) FROM usuario WHERE email=:email";
        $sen2 = $con->prepare($sql2);
        $sen2->bindParam(':email',$_POST['email']);
        $sen2->execute();
        $results2 = $sen2->fetch(PDO::FETCH_ASSOC);

        //verificando si el nombre de usuario esta ocupado
        $sql3 = "SELECT COUNT(*) FROM usuario WHERE username=:usuario";
        $sen3 = $con->prepare($sql3);
        $sen3->bindParam(':usuario',$_POST['usuario']);
        $sen3->execute();
        $results3 = $sen3->fetch(PDO::FETCH_ASSOC);

        $message = "";
        
        if ($results2['COUNT(*)']>0) {
            $message = "El correo se registro anteriormente, puedes utilizarlo en 'Iniciar sesión'";
            
            
        }elseif ($results3['COUNT(*)']>0) {
            $message = "El usuario no esta disponible, intenta con otro nombre de usuario";
        } else if ($sen->execute()) {
            $message = "El usuario se creo correctamente, Inicia sesion.";
        }
            
        
    
    
  } else {
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
            <h2>Registro de nuevo usuario</h2>
           
        </div>
        <div>
             <span id="tagline"><a style="padding-right: 10px;" href="index.php">Home</a>
             
            <a  href="login.php">Incia sesión</a></span><br>

                <?php if(!empty($message)): ?>
                <p id = "mensaje"> <?= $message ?></p>
                <?php endif; ?>
        </div>
        <div id="formulario">
            
             <form action="registro.php" method="post">
                <label for="">Nombre y Apellido:</label><br>
                <input type="text" name="nombre" id="frm"><br>

                <label for="">E-mail:</label><br>
                <input type="email" name="email" id="frm"><br>

                <label for="">Usuario:</label><br>
                <input type="text" name="usuario" id="frm"><br>

                <label for="">Contraseña:</label><br>
                <input type="password" name="password" id="frm"><br>

                <input type="submit" value="Registrar" id="boton">

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
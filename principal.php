<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $sql = "SELECT id,nombre,email,username,contraseña,imagen FROM usuario WHERE id = :id";
        $sen = $con->prepare($sql);
        $sen ->bindParam(':id', $_SESSION['user_id']);
        
        $sen->execute();
        $results = $sen->fetch(PDO::FETCH_ASSOC);
        $user = null;
  
      if (count($results) > 0) {
        $user = $results;
      }

      if (!empty($results['imagen'])) {
         
      }

     
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
            <h2>Bienvenido al Aula virtual</h2>
         
        </div>
        <div id="cuerpo">
                <?php if(isset($_SESSION['user_id'])): ?>

                    <h3>Haz iniciado sesion correctamente</h3> <br>
                    <div id="datos">
                       
                        <table align="center" cellspacing="10">
                            <td>
                                <tr align="center">
                                    <p id="cabecera_datos">Datos del usuario:</p> 
                                </tr>
                            </td>
                        <?php if(!empty($results['imagen'])): ?>
                            <td>
                                <tr align="center">
                                <img src="/phplogin/imagen/".<?php $results['imagen'] ?>. width="100" height="100"/>
                                </tr>
                            </td>
                            <?php endif; ?>
                            <tr>
                                <td align="right">
                                    <label id="viñeta_datos">Nombre:</label>
                                </td>
                                <td align="left">
                                    <?= $user['nombre']; ?>
                                </td>
                               
                                    
                                
                            </tr>
                            <tr>
                                <td align="right">
                                    <label id="viñeta_datos">E-mail:</label>
                                </td>
                                <td align="left">
                                    <?= $user['email']; ?>
                                </td>

                            </tr>
                            <tr>
                                <td align="right">
                                    <label id="viñeta_datos">Usuario:</label>
                                </td>
                                <td align="left">
                                     <?= $user['username']; ?>
                                </td>
                               
                            </tr>
                        </table>
                   
                   <p></p> 
                   <p></p> 
                   <p> </p> 
                   </div>
                    <a href="logout.php">Cerrar sesion</a>
                    
                    <?php else: header("Location: /phplogin/index.php"); ?>
                        
                    <?php endif; ?>
        </div>
    </div>
    <div>
        <a href="imagen.php">Añadir imagen de perfil</a>
    </div>
</body>
</html>
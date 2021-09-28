<?php
    session_start();
    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $sql = "UPDATE usuario set imagen='imagen".$_FILES['imagen']['name']."' WHERE id = :id";
        
        $sen = $con->prepare($sql);
        $sen ->bindParam(':id', $_SESSION['user_id']);
        
        $sen->execute();    
    }

    $nombre_img = $_FILES['imagen']['name'];
    $tipo_img = $_FILES['imagen']['type'];
    $tamaño_img = $_FILES['imagen']['size'];

    if ($tamaño_img<2000000) {
        if ($tipo_img=="image/jpeg" || $tipo_img=="image/jpg" || $tipo_img=="image/png") {
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/phplogin/imagen/imagen';
            move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombre_img);
            header("Location: /phplogin/principal.php");
        }else {
            echo 'El formato de la imagen no es permitido';
        }
        
    }else {
        echo 'El tamaño de la imagen es muy grande';
    }
    

?>
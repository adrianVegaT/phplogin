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
            <h2>Sube tu foto de perfil</h2>
            
        </div>
        <div id="cuerpo">
           <form action="imagen2.php" method="post" enctype="multipart/form-data">
                <label for="">Imagen:</label>
                <input type="file" name="imagen" id=""/>
                <input type="submit" value="Subir imagen"/>
           </form>
        </div>
    </div>
</body>
</html>
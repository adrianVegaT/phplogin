<?php
define ('host', 'localhost');
define ('user', 'root');
define ('password', '');
define ('database', 'phplogin');

try {
    $con = new PDO ("mysql:host=".host.";dbname=".database,user,password);
} catch (PDOException $th) {
    die($th);
}


?>
<?php

session_start();

if(isset($_SESSION['usuario'])){
    header('Location: ./php/contenido.php');
} else {
    header('Location: ./php/registro.php');
}

?>
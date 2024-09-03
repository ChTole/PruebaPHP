<?php

session_start();

require 'visitas.php';

if(isset($_SESSION['usuario'])){
    require '../views/contenido.view.php';
} else {
    header('Location: ../php/ingreso.php');
}

?>
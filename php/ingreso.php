<?php

session_start();

if(isset($_SESSION['usuario'])){
    header('Location: index.php');
} 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $clave = $_POST['clave'];
    $clave = hash('sha256', $clave);

    // echo "$correo - $clave";

    $errores = '';

    if(empty($correo) or empty($clave)){
        $errores .= '<li>Por favor completá los datos correctamente.</li>';
    } else {
        try{
            $conexion = new PDO('mysql:host=127.0.0.1:3306; dbname=tutophp', 'dba', '#adminRoot');
        } catch(PDOExcepcion $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $consulta = $conexion->prepare('
                    SELECT * FROM cuenta 
                    WHERE correo = :cuenta AND clave = :clave;');
        $consulta->execute(array(
            ':cuenta' => $correo,
            ':clave' => $clave
        ));
        
        $registro = $consulta->fetch();

        // var_dump($registro);

        if($registro != false){
            $_SESSION['usuario'] = $correo;
            header('Location: ../index.php');
        } else {
            $errores .= '<li>Datos incorrectos</li>';
        }
    }
}

require '../views/ingreso.view.php';

?>
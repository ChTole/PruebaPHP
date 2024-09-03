<?php

session_start();

if(isset($_SESSION['usuario'])){
    header('Location: index.php');
} 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $clave1 = filter_var($_POST['clave1'], FILTER_SANITIZE_STRING);
    $clave2 = filter_var($_POST['clave2'], FILTER_SANITIZE_STRING);

    // echo "$correo . $clave1 . $clave2";

    $errores = '';

    if(empty($correo) or empty($clave1) or empty($clave1)){
        $errores .= '<li>Por favor completá los datos correctamente.</li>';
    } else {
        try{
            $conexion = new PDO('mysql:host=127.0.0.1:3306; dbname=tutophp', 'dba', '#adminRoot');
        } catch(PDOExcepcion $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $consulta = $conexion->prepare('SELECT * FROM cuenta WHERE correo = :cuenta LIMIT 1;');
        $consulta->execute(array(':cuenta' => $correo));
        $registro = $consulta->fetch();

        if($registro != false){
            $errores .= '<li>El correo ya se encuentra registrado.</li>';
        }

        // Hash de clave
        $clave1 = hash('sha256', $clave1);
        $clave2 = hash('sha256', $clave2);

        if($clave1 != $clave2){
            $errores .= '<li>Las contraseñas no coinciden.</li>';
        }
    }

    if($errores == ''){
        $consulta = $conexion->prepare("INSERT INTO cuenta (correo, clave) VALUES (:correo, :clave);");
        $consulta->execute(array(
            ':correo' => $correo,
            ':clave' => $clave1
        ));

        header('Location: ../ingreso.php');
    }

}

require '../views/registro.view.php';

?>
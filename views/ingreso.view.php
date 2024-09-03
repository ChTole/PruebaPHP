<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fuentes.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Inicio de sesión</title>
</head>
<body class="poppins-regular">
    <header>
        <h1>Ingresá a tu cuenta</h1>
    </header>
    <main>
        <h2>Ingreso</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="login">
            <div>
                <input type="email" name="correo" placeholder="Correo">
            </div>    
            <div>
                <input type="password" name="clave" placeholder="Contraseña">
            </div>
            <div>
                <input type="submit" name="crearuser" value="Ingresar">
            </div>

            <?php if(!empty($errores)): ?>
                <div class="error">
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </form>
    </main>
    <footer>
        <div>
            <p>¿Todavía no tenés cuenta?</p>
            <a href="../php/registro.php">Crear cuenta</a>
        </div>
    </footer>
</body>
</html>
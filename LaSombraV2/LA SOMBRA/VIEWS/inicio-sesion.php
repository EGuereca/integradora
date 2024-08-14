<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Sombra - Inicio de Sesión</title>
    <link rel="stylesheet" href="../CSS/inicio-sesion.css">
</head>
<body>
<div class="outer-container">
    <div class="container">
        <img src="../IMG/sombra-logo.jpg" alt="La Sombra Ozuna TRC">
        <h2>Inicia sesión</h2>
        <form method="post" action="">
            <label for="user">Ingresa tu nombre de usuario:</label><br>
            <input type="text" id="user" placeholder="Ingresa tu nombre de usuario aquí" name="usuario"><br>
            <label for="password">Ingresa tu contraseña:</label><br>
            <input type="password" id="password" placeholder="Ingresa tu contraseña aquí" name="password"><br>
            <?php 
            include '../SCRIPTS/login-script.php';
            ?>
            <button type="submit"  name="btningreso" value="INICIAR SESION">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="../VIEWS/crear-cuenta.php" class="create-account"><p id="texto">Crear cuenta</p></a></p>
        <p class="p-back"><a href="../VIEWS/iniciov2.php" class="back"><p id="texto">Regresar a inicio</p></a></p>
    </div>
</div>
</body>
</html>
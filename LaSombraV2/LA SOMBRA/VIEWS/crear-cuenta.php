<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Sombra - Crear Cuenta</title>
    <link rel="stylesheet" href="../CSS/crear-cuenta.css">
</head>
<body>
    <div class="container">
        <img src="../IMG/sombra-logo.jpg" alt="La Sombra">
        <h2>Crea tu cuenta</h2>
        <form>
            <div class="form-group">
                <label for="username">Ingresa tu nombre de usuario:</label><br>
                <input type="text" id="username" placeholder="Ingresa tu nombre de usuario aquí">
            </div>
            <div class="form-group">
                <label for="email">Ingresa tu correo:</label><br>
                <input type="email" id="email" placeholder="ejemplo@mail.com">
            </div>
            <div class="form-group">
                <label for="password">Ingresa tu contraseña:</label><br>
                <input type="password" id="password" placeholder="Ingresa tu contraseña aquí">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmar contraseña:</label><br>
                <input type="password" id="confirm-password" placeholder="Ingresa tu contraseña aquí">
            </div>
            <button type="submit" class="btn btn-green">Crear cuenta</button>
            O
            <button type="button" onclick="irAOtraPagina()" class="btn btn-grey">Inicia sesión</button>
        </form>
        
        <p class="p-back"><a href="../VIEWS/iniciov2.php" class="back">Regresar a inicio</a></p>
    </div>
    <script>
        function irAOtraPagina() {
          // Redireccionar a otra página
        window.location.href = '../VIEWS/inicio-sesion.php';
        }
    </script>
</body>
</html>

<?php

session_start();

try {
    $conexion = new PDO("mysql:host=localhost;dbname=la_sombra", "root", "Mysql123");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conexion->prepare("SELECT nombre_usuario, id_usuario FROM usuarios WHERE nombre_usuario = :usuario AND AES_DECRYPT(password, 'clave_segura') = :password");

if (isset($_POST["btningreso"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["id"] = $row['id_usuario'];
            $_SESSION["nombre"] = $row['nombres'];
            header("location: inicio.php");
            exit();
        } else {
            echo "<p style='color: red;'>Contraseña o nombre de usuario incorrectos.</p>";
        }
    } else {
        echo "Ingrese todos los datos";
    }
}





?>

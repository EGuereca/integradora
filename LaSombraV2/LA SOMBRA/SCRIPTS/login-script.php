
<?php

session_start();

try {
    $conexion = new PDO("mysql:host=3.144.20.56;dbname=la_sombra", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conexion->prepare("SELECT nombre_usuario, id_usuario, rol
FROM usuarios JOIN rol_usuario ON usuarios.id_usuario = rol_usuario.usuario
WHERE nombre_usuario = :usuario AND AES_DECRYPT(password, 'clave_segura') = :password");

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
            $_SESSION["nombre"] = $row['nombre'];
            $_SESSION["rol"] = $row['rol'];
            if ($_SESSION["rol"] == 3) {
                header("location: ../VIEWS/iniciov2.php");
                exit();
            }
            else {
                header("location: ../VIEWS/dashboard.php");
                exit();
            }
        } else {
            echo "<p style='color: red;'>Contraseña o nombre de usuario incorrectos.</p>";
        }
    } else {
        echo "Ingrese todos los datos";
    }
}





?>

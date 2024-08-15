<?php

session_start();

include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$sql = "SELECT u.nombre_usuario, u.id_usuario, ru.rol 
        FROM usuarios u
        JOIN rol_usuario ru ON u.id_usuario = ru.usuario 
        WHERE u.nombre_usuario = :usuario 
        AND u.password = AES_ENCRYPT(:password, 'clave_segura')";

$stmt = $conexion->prepare($sql);

if (isset($_POST["btningreso"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombre_usuario'];
            $_SESSION['rol'] = $row['rol'];

            if ($_SESSION["rol"] == 3) {
                header("location: ../VIEWS/iniciov2.php");
                exit();
            } else {
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


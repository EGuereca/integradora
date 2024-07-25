<?php

session_start();

try {
    $conexion = new PDO("mysql:host=localhost;dbname=la_sombra", "root", "Mysql123");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conexion->prepare("CALL REGISTRO_CLIENTES(?,?,?,?)");

if (isset($_POST["btncrearclient"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["telefono"])) {
        $pass1 = $_POST['password'];
        $pass2 = $_POST['pass'];

        if ($pass1 === $pass2) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];

            $stmt->bindParam(1, $usuario, PDO::PARAM_STR);
            $stmt->bindParam(2, $password, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
            $stmt->execute();
            
            echo "<p style='color: green;'>Usuario registrado exitosamente.</p>";
            header("refresh:3  ; ../VIEWS/inicio-sesion.php");
        } else {
            echo "<p style='color: red;'>Las contraseñas son diferentes.</p>";
        }
    } else {
        echo "Ingrese todos los datos";
    }
}

?>
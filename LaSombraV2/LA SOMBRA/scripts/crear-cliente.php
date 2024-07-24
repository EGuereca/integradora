<?php
session_start();

try {
    $conexion = new PDO("mysql:host=localhost;dbname=la_sombra", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conexion->prepare("CALL REGISTRO_CLIENTES(?,?,?)");

if (isset($_POST["btncrearclient"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        $pass1 = $_POST['password'];
        $pass2 = $_POST['pass'];

        if ($pass1 === $pass2) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $stmt->bindParam(1, $usuario, PDO::PARAM_STR);
            $stmt->bindParam(2, $password, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->execute();

        } else {
            echo "<p style='color: red;'>Las contraseñas son diferentes.</p>";
        }

        
    } else {
        echo "Ingrese todos los datos";
    }
}
?>
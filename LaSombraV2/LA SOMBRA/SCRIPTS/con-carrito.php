<?php
try {
    $conexion = new PDO("mysql:host=3.144.20.56;dbname=la_sombra", "guereca", "123");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


$stm = $pdo->prepare("CALL R(?,?,?)");

if (isset($_POST['btncarrito'])) {
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];
    $venta = $_SESSION['id'];
    
    $stm->bindParam(1, $producto, PDO::PARAM_STR);
    $stm->bindParam(2, $cantidad, PDO::PARAM_STR);
    $stm->bindParam(3, $cliente, PDO::PARAM_STR);
    $stm->execute();
}

?>
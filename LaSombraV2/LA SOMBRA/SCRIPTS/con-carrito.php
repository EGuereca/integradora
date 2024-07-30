<?php
if (!defined('SESSION_STARTED')) {
    session_start();
  }

try {
    $conexion = new PDO("mysql:host=localhost;dbname=la_sombra", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stm = $conexion->prepare("CALL LLENAR_VENTA(?,?,?)");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (isset($_POST['btncarrito'])) {
    if (!isset($_SESSION['id'])) {
        echo "Seleccione una sucursal";   
    } else {        
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $venta = $_SESSION['id'];    
        $stm->bindParam(1, $id, PDO::PARAM_INT);
        $stm->bindParam(2, $cantidad, PDO::PARAM_INT);
        $stm->bindParam(3, $venta, PDO::PARAM_INT);
        $stm->execute();

        header("refresh:3; url=../VIEWS/productos.php");
    }
}
?>

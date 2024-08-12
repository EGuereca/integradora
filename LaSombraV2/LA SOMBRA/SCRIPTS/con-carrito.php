<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$venta = $_SESSION['id'];
$stm = $conexion->prepare("CALL LLENAR_VENTA(?,?,?)");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';


if (isset($_POST['btncarrito'])) {
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;    
        $stm->bindParam(1, $id, PDO::PARAM_INT);
        $stm->bindParam(2, $cantidad, PDO::PARAM_INT);
        $stm->bindParam(3, $venta, PDO::PARAM_INT);
        $stm->execute();

        header("refresh:3; url=../VIEWS/carrito.php");    
}
?>

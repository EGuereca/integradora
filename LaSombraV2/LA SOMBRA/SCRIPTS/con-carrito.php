<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();    

}

if (isset($_SESSION['id'])) {
    $venta = $_SESSION['id'];    
}
else{
    $venta = '';
}
if (isset($_SESSION['sucursal'])) {
    $suc = $_SESSION['sucursal'];    
}
else{
    $suc = '';
}    


include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

if ($venta) {
    $consulta = $conexion->prepare("SELECT v.id_venta as id from venta as v join cliente as c on v.id_cliente = c.id_cliente
    join persona as p on c.persona = p.id_persona join usuarios as u on p.usuario
    = u.id_usuario where u.id_usuario = $venta and v.estado = 'CARRITO'");
    $consulta->execute();

    $id_v = $consulta->fetch(PDO::FETCH_ASSOC)['id'];
    $update = $conexion->prepare("UPDATE venta SET sucursal = ? WHERE id_venta = ?");
    $stm = $conexion->prepare("CALL LLENAR_VENTA(?,?,?)");
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

}



if (isset($_POST['btncarrito'])) {
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;    
        $stm->bindParam(1, $id, PDO::PARAM_INT);
        $stm->bindParam(2, $cantidad, PDO::PARAM_INT);
        $stm->bindParam(3, $venta, PDO::PARAM_INT);
        $stm->execute();

        $update->bindParam(1, $suc, PDO::PARAM_INT);
        $update->bindParam(2, $id_v, PDO::PARAM_INT);
        $update->execute();

        header("refresh:3; url=../VIEWS/carrito.php");    
}
?>

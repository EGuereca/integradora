<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$suc = $_SESSION['sucursal'];
$usuario = $_SESSION['id'];
$id = isset($_POST["id"]) ? $_POST["id"] : '';
$pago = isset($_POST["pago"]) ? $_POST["pago"] : '';
$cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '';
$control = isset($_SESSION['control']) ? $_SESSION['control'] : 1;
$venta = isset($_SESSION['venta']) ? $_SESSION['venta'] : null;


include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$consulta = $conexion->prepare("SELECT id_empleado FROM empleado
        JOIN persona ON empleado.persona = persona.id_persona
        JOIN usuarios ON persona.usuario = usuarios.id_usuario
        WHERE id_usuario = $usuario");

$consulta->execute();
$emp = $consulta->fetch(PDO::FETCH_ASSOC)['id_empleado'];


if ($_SESSION['sucursal'] == null) {
    $sql = $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos WHERE stock > 0";
    $stmt = $conexion->prepare($sql);
}
else{
if ($_SESSION['sucursal'] == '2') {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos_nazas WHERE stock > 0";
    $stmt = $conexion->prepare($sql);
}
if ($_SESSION['sucursal'] == '1') {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos_matamoros WHERE stock > 0";
    $stmt = $conexion->prepare($sql);
}
}    


$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$llenado = $conexion->prepare("INSERT INTO detalle_venta(venta,producto,cantidad) 
VALUES(?,?,?)");



$registrar = $conexion->prepare("UPDATE venta SET estado = 'COMPLETADA', tipo_pago = ? WHERE id_venta = ?");

if (isset($_POST['btn-reg'])) {
    if ($control == 1) {    
        $insert = $conexion->prepare("INSERT INTO venta(id_empleado,estado,tipo_venta,sucursal)
        VALUES(?,'CARRITO','FISICA',?)");   
        $insert->bindParam(1, $emp, PDO::PARAM_INT); 
        $insert->bindParam(2, $suc, PDO::PARAM_INT); 
        $insert->execute();

        $venta_consulta = $conexion->prepare("SELECT id_venta FROM venta ORDER BY id_venta DESC LIMIT 1");
        $venta_consulta->execute();
        $venta = $venta_consulta->fetch(PDO::FETCH_ASSOC)['id_venta'];

        $_SESSION['control'] = 2;
        $_SESSION['venta'] = $venta;
    }

    if (isset($venta)) {
        $llenado->bindParam(1, $venta, PDO::PARAM_INT);
        $llenado->bindParam(2, $id, PDO::PARAM_INT);
        $llenado->bindParam(3, $cantidad, PDO::PARAM_INT);
        $llenado->execute();
    }
}    

if (isset($_POST['registrar_venta'])) {
    if (isset($venta)) {
        $registrar->bindParam(2,$venta,PDO::PARAM_INT);
        $registrar->bindParam(1,$pago,PDO::PARAM_STR);
        $registrar->execute();


        $_SESSION['control'] = 1;
        unset($_SESSION['venta']);
    }

    header("Location: ../VIEWS/dash-ventas.php");
}

$pdo = null; 


?>
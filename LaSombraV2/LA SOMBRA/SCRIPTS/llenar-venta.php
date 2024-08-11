<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$suc = $_SESSION['sucursal'];
$usuario = $_SESSION['id'];
$id = isset($_POST["id"]) ? $_POST["id"] : '';
$pago = isset($_POST["pago"]) ? $_POST["pago"] : '';
$cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '';
$venta;
$control = 1;

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


$productos_por_pagina = 9;

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = $pagina > 0 ? $pagina : 1;

$inicio = ($pagina - 1) * $productos_por_pagina;

if ($_SESSION['sucursal'] == null) {
    $sql = $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos WHERE stock > 0
    LIMIT $inicio, $productos_por_pagina";
    $stmt = $conexion->prepare($sql);
    $total_sql = "SELECT COUNT(*) FROM productos";
}
else{
if ($_SESSION['sucursal'] == '1') {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos_nazas WHERE stock > 0
    LIMIT $inicio, $productos_por_pagina";
    $stmt = $conexion->prepare($sql);
    $total_sql = "SELECT COUNT(*) FROM productos_nazas WHERE stock > 0";
}
if ($_SESSION['sucursal'] == '2') {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos WHERE stock > 0
    LIMIT $inicio, $productos_por_pagina";
    $stmt = $conexion->prepare($sql);
    $total_sql = "SELECT COUNT(*) FROM productos WHERE stock > 0";
}
if ($_SESSION['sucursal'] == '3') {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos_matamoros WHERE stock > 0
    LIMIT $inicio, $productos_por_pagina";
    $stmt = $conexion->prepare($sql);
    $total_sql = "SELECT COUNT(*) FROM productos_matamoros WHERE stock > 0";
}
}    


$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_stmt = $conexion->prepare($total_sql);
$total_stmt->execute();
$total_productos = $total_stmt->fetchColumn();
$total_paginas = ceil($total_productos / $productos_por_pagina);

$llenado = $conexion->prepare("INSERT INTO detalle_venta(venta,producto,cantidad) 
VALUES(?,?,?)");

$insert = $conexion->prepare("INSERT INTO venta(id_empleado,estado,tipo_venta,sucursal)
VALUES($emp,'CARRITO','FISICA',$suc)");

if (isset($_POST['btn-reg'])) {

    if ($control == 1) {        
        $insert->execute();

        $venta_consulta = $conexion->prepare("SELECT id_venta FROM venta ORDER BY id_venta DESC LIMIT 1");
        $venta_consulta->execute();
        $venta = $venta_consulta->fetch(PDO::FETCH_ASSOC)['id_venta'];

        $control ++;
    }
    if (isset($venta)) {
        $llenado->bindParam(1, $venta, PDO::PARAM_INT);
        $llenado->bindParam(2, $id, PDO::PARAM_INT);
        $llenado->bindParam(3, $cantidad, PDO::PARAM_INT);
        $llenado->execute();
    }
}    



if (isset($_POST['registrar_venta'])) {
    $registrar = $conexion->prepare("UPDATE venta SET estado = 'COMPLETADA', tipo_pago = :tpago WHERE id_venta = :venta");
    $registrar->bindParam(':venta',$venta,PDO::PARAM_INT);
    $registrar->bindParam(':tpago',$pago,PDO::PARAM_STR);
    $registrar->execute();
    $control = true;

    header("Location: ../VIEWS/dash-ventas.php");
}

$pdo = null; 

?>
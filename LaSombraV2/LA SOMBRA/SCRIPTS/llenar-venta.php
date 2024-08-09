<?php
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$suc = $_SESSION['sucursal'];
$usuario = $_SESSION['id'];
$id = isset($_POST["id"]) ? $_POST["id"] : '';
$pago = isset($_POST["pago"]) ? $_POST["pago"] : '';
$cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nazas'])) {
    $_SESSION['sucursal'] = '1'; 
    $suc = $_SESSION['sucursal'] = '1';   
    header("Location: ../VIEWS/llenar-venta.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo'])) {
    $_SESSION['sucursal'] = '2';
    
    header("Location: ../VIEWS/llenar-venta.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matamoros'])) {
    $_SESSION['sucursal'] = '3';
    $suc = $_SESSION['sucursal'] = '3';
    header("Location: ../VIEWS/llenar-venta.php");
    exit();
}

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

$producto = array(
    "id" => $id,
    "cantidad" => $cantidad    
);

$_SESSION['carrito'][] = $producto;

if (isset($_POST['registrar_venta'])) {

    $crear_venta = $conexion->prepare("INSERT INTO venta(id_empleado,tipo_venta,tipo_pago,sucursal)
     VALUES('$emp','FISICA','$pago','$suc')");
    $crear_venta->execute();

    $ns = $conexion->prepare("SELECT id_venta FROM venta ORDER BY id_venta DESC LIMIT 1");
    $ns->execute();
    $id_v = $ns->fetch(PDO::FETCH_ASSOC)['id_venta'];

    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $id_producto = $producto['id'];
            $cantidad_producto = $producto['cantidad'];
    
            $insert = $conexion->prepare("INSERT INTO detalle_venta(venta,producto,cantidad) 
            VALUES (?, ?, ?)");
            $insert->bindParam(1,$id_v, PDO::PARAM_INT);
            $insert->bindParam(2,$id_producto, PDO::PARAM_INT);
            $insert->bindParam(3,$cantidad_producto, PDO::PARAM_INT);
            $insert->execute();
        }
    
        $_SESSION['carrito'] = array();
    }
}

$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_stmt = $conexion->prepare($total_sql);
$total_stmt->execute();
$total_productos = $total_stmt->fetchColumn();
$total_paginas = ceil($total_productos / $productos_por_pagina);

$pdo = null; 

?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {    
    header("location: ../VIEWS/inicio-sesion.php");
    exit();
}

if($id == '1'){
    header("location: ../VIEWS/iniciov2.php");
    exit();
}

include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$id_dv =  isset($_POST["dv"]) ? $_POST["dv"] : '';

$queryCliente = "SELECT c.id_cliente AS id 
    FROM cliente AS c 
    JOIN persona AS p ON c.persona = p.id_persona
    JOIN usuarios AS u ON p.usuario = u.id_usuario
    WHERE id_usuario = :id
";
$stmtCliente = $conexion->prepare($queryCliente);
$stmtCliente->bindParam(':id', $id, PDO::PARAM_INT);
$stmtCliente->execute();

$idCliente = $stmtCliente->fetch(PDO::FETCH_ASSOC)['id'];

$venta = $conexion->prepare("SELECT id_venta FROM venta WHERE id_cliente = $idCliente
AND estado = 'CARRITO'");
$venta->execute();
$id_venta = $venta->fetch(PDO::FETCH_ASSOC)['id_venta'];

$sucursal = $conexion->prepare("SELECT sucursal FROM venta WHERE id_venta = $id_venta");
$sucursal->execute();
$sucu = $sucursal->fetch(PDO::FETCH_ASSOC)['sucursal'];

if ($idCliente === null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();
}

// Consulta para verificar si hay algún pedido pendiente
$queryPedidoPendiente = "SELECT COUNT(*) AS pendientes 
    FROM venta 
    WHERE id_cliente = :idCliente 
    AND estado = 'PENDIENTE'
";
$stmtPendiente = $conexion->prepare($queryPedidoPendiente);
$stmtPendiente->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$stmtPendiente->execute();
$pedidoPendiente = $stmtPendiente->fetch(PDO::FETCH_ASSOC)['pendientes'];

$q_productos = "SELECT SUM(dv.cantidad) AS cantidad, p.nombre AS nombre, p.url AS url ,p.precio AS precio,
						ins.cantidad AS stock, dv.producto AS id_prod, dv.id_detalle AS id
						FROM detalle_venta AS dv 
						JOIN productos AS p ON dv.producto = p.id_producto
						JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto
						WHERE dv.venta = :venta
						AND ins.id_sucursal = :sucursal GROUP BY 
                        dv.producto, p.nombre, p.url, p.precio, ins.cantidad ORDER BY dv.producto";

$insert = " INSERT INTO venta(id_cliente, estado, tipo_venta) 
    VALUES(?, 'CARRITO', 'LINEA')
";

$stmtProductos = $conexion->prepare($q_productos);
$stmtProductos->bindParam(':venta', $id_venta, PDO::PARAM_INT);
$stmtProductos->bindParam(':sucursal', $sucu, PDO::PARAM_INT);
$stmtProductos->execute();
$update = $conexion->prepare("UPDATE venta SET estado = 'PENDIENTE' WHERE id_cliente = $idCliente
AND estado = 'CARRITO'");

$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn'])) { 
    $update->execute();   
    $stmtInsert = $conexion->prepare($insert);
    $stmtInsert->bindParam(1, $idCliente, PDO::PARAM_INT);
    $stmtInsert->execute();    
    #HACER UNA PAGINA CON EL ID DEL PEDIDO, Y DE QUE ESTA EXITOSO
    header("location: ../VIEWS/iniciov2.php");
    exit();
}

$eliminar = $conexion->prepare("DELETE FROM detalle_venta WHERE id_detalle = ?");

if (isset($_POST['eliminar'])) {
    $eliminar->bindParam(1, $id_dv, PDO::PARAM_INT);
    $eliminar->execute();    
    header("location: ../VIEWS/carrito.php");
    exit();
}

?>

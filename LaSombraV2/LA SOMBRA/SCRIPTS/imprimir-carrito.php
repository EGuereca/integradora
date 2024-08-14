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

$q_productos = "SELECT dv.cantidad AS cantidad, p.nombre AS nombre, p.url AS url ,(p.precio * dv.cantidad) AS precio
    FROM detalle_venta AS dv
    JOIN productos AS p ON dv.producto = p.id_producto
    WHERE dv.venta = (
        SELECT id_venta  
        FROM venta 
        WHERE id_cliente = :idCliente 
        AND estado = 'CARRITO'
    )
";

$insert = " INSERT INTO venta(id_cliente, estado, tipo_venta) 
    VALUES(?, 'CARRITO', 'LINEA')
";

$stmtProductos = $conexion->prepare($q_productos);
$stmtProductos->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
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

?>

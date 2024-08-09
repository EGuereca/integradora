<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {    
    header("location: ../VIEWS/iniciov2.php");
    exit();
}


include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$queryCliente = "
    SELECT c.id_cliente AS id 
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
    echo "Cliente no encontrado.";
    exit();
}

$q_productos = "
    SELECT dv.cantidad AS cantidad, p.nombre AS nombre, p.precio AS precio
    FROM detalle_venta AS dv
    JOIN productos AS p ON dv.producto = p.id_producto
    WHERE dv.venta = (
        SELECT id_venta  
        FROM venta 
        WHERE id_cliente = :idCliente 
        AND estado = 'CARRITO'
    )
";

$update = "
    UPDATE venta 
    SET estado = 'PENDIENTE' 
    WHERE id_venta = (
        SELECT id_venta  
        FROM venta 
        WHERE id_cliente = :idCliente 
        AND estado = 'CARRITO'
    )
";

$insert = " 
    INSERT INTO venta(id_cliente, estado, tipo_venta) 
    VALUES(:idCliente, 'CARRITO', 'LINEA')
";

$stmtProductos = $conexion->prepare($q_productos);
$stmtProductos->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$stmtProductos->execute();

$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn'])) {    
    $stmtUpdate = $conexion->prepare($update);
    $stmtUpdate->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
    $stmtUpdate->execute();

    $stmtInsert = $conexion->prepare($insert);
    $stmtInsert->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
    $stmtInsert->execute();

    #HACER UNA PAGINA CON EL ID DEL PEDIDO, Y DE QUE ESTA EXITOSO
    header("location: ../VIEWS/iniciov2.php");
    exit();
}

?>

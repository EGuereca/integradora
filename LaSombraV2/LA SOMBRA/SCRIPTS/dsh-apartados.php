<?php
$ventas = [];
$detalles = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../CLASS/database.php";
    $db = new Database();
    $db->conectarBD();
    $conexion = $db->getPDO();

    $numero_pedido = $_POST['numero_pedido'];
    $estado = $_POST['estado'];

    $sql = "SELECT v.id_venta, u.nombre_usuario, v.estado, v.tipo_venta, v.monto_total, s.nombre AS sucursal
            FROM venta v
            JOIN cliente c ON v.id_cliente = c.id_cliente
            LEFT JOIN persona p ON c.persona = p.id_persona
            LEFT JOIN usuarios u ON p.usuario = u.id_usuario
            LEFT JOIN sucursales s ON v.sucursal = s.id_sucursal
            WHERE v.id_venta = :numero_pedido AND v.estado = :estado ";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':numero_pedido', $numero_pedido);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($ventas) {
        $stmt_detalles = $conexion->prepare("SELECT p.nombre, p.precio, dv.cantidad
            FROM detalle_venta dv
            JOIN productos p ON dv.producto = p.id_producto
            WHERE dv.venta = :idVenta;
        ");
        $stmt_detalles->bindParam(':idVenta', $numero_pedido, PDO::PARAM_INT);
        $stmt_detalles->execute();
        $detalles = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

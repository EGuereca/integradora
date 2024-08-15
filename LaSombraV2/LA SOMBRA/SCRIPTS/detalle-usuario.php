<?php

include "../CLASS/database.php";

$db = new Database();
$db->conectarBD();
session_start();
$iduser =  $_SESSION["id"];

$user = null;
$completadas = [];
$detalles = [];

if ($iduser) {
    try {
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM usuarios u WHERE u.id_usuario = :id");
        $stmt->bindParam(':id', $iduser, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt_ventas = $pdo->prepare("SELECT v.id_venta as ID, v.fecha_venta as fecha_venta, v.monto_total as monto_total, v.estado as estado, s.nombre as sucursal
                FROM venta v 
                JOIN cliente c ON v.id_cliente = c.id_cliente
                JOIN persona p ON c.persona = p.id_persona
                JOIN usuarios u  ON p.usuario = u.id_usuario
                JOIN sucursales s ON v.sucursal = s.id_sucursal
                WHERE u.id_usuario = :id AND v.estado = 'COMPLETADA'");
    
        $stmt_ventas->bindParam(':id', $iduser, PDO::PARAM_INT);
        $stmt_ventas->execute();

        $completadas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);

        $stmt_pendientes = $pdo->prepare("SELECT v.id_venta as ID, v.fecha_venta as fecha_venta, v.monto_total as monto_total, v.estado as estado, s.nombre as sucursal
                FROM venta v 
                JOIN cliente c ON v.id_cliente = c.id_cliente
                JOIN persona p ON c.persona = p.id_persona
                JOIN usuarios u  ON p.usuario = u.id_usuario
                JOIN sucursales s ON v.sucursal = s.id_sucursal
                WHERE u.id_usuario = :id AND v.estado = 'PENDIENTE'");
        
        $stmt_pendientes->bindParam(':id', $iduser, PDO::PARAM_INT);
        $stmt_pendientes->execute();

        $pendientes = $stmt_pendientes->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['ver_detalles'])) {
            $idVenta = $_POST['venta_id'];
            $stmt_detalles = $pdo->prepare("
                SELECT p.nombre, p.precio, dv.cantidad
                FROM detalle_venta dv
                JOIN productos p ON dv.producto = p.id_producto
                WHERE dv.venta = :idVenta;
            ");
            $stmt_detalles->bindParam(':idVenta', $idVenta, PDO::PARAM_INT);
            $stmt_detalles->execute();
            $detalles = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);
        }

        if (isset($_POST['cancelar_pedido'])) {
            $idVenta = $_POST['venta_id'];
        
            try {
                $pdo = $db->getPDO();
                // Actualiza el estado de la venta a "CANCELADA"
                $stmt_cancelar = $pdo->prepare("UPDATE venta SET estado = 'CANCELADA' WHERE id_venta = :idVenta AND estado = 'PENDIENTE'");
                $stmt_cancelar->bindParam(':idVenta', $idVenta, PDO::PARAM_INT);
                $stmt_cancelar->execute();
        
                // Verifica si se actualizó alguna fila
                if ($stmt_cancelar->rowCount() > 0) {
                    header("Location: detalle-cuenta.php");
                    exit();
                } else {
                    echo "<p>No se pudo cancelar el pedido. Es posible que ya esté procesado.</p>";
                }
        
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } 
        }
       

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $db->desconectarBD();
    }

} else {
    echo "No se encontró el ID del usuario en la sesión.";
}
?>



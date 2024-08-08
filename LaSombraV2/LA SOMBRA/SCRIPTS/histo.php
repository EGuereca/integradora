<?php
include "../CLASS/database.php";

$db = new Database();
$db->conectarBD();

session_start();
$iduser = $_SESSION["id"];

$user = null;        // Inicializamos la variable $user
$completadas = [];   // Inicializamos la variable $completadas

if ($iduser) {
    try {
        $pdo = $db->getPDO();

        // Consulta para obtener las ventas completadas

        $query_ventas = "SELECT v.id_venta, v.fecha_venta as fecha_venta, v.monto_total as monto_total, v.estado as estado, u.nombre_usuario AS nombre_usuario, s.nombre as sucursal
            FROM venta u 
            JOIN cliente c ON v.id_cliente = c.id_cliente
            JOIN persona p ON c.persona = p.id_persona
            JOIN usuarios u  ON p.usuario = u.id_usuario
            JOIN sucursales s ON v.sucursal = s.id_sucursal
            WHERE u.id_usuario = :id AND v.estado = 'COMPLETADA'";
        
        $stmt_ventas = $pdo->prepare($query_ventas);
        $stmt_ventas->bindParam(':id', $iduser, PDO::PARAM_INT);
        $stmt_ventas->execute();
        
        $completadas = $stmt_ventas->fetchAll(PDO::FETCH_ASSOC);

        // Consulta para obtener los datos del usuario
        $query_usuario = "SELECT * FROM usuarios u WHERE u.id_usuario = :id";
        
        $stmt_usuario = $pdo->prepare($query_usuario);
        $stmt_usuario->bindParam(':id', $iduser, PDO::PARAM_INT);
        $stmt_usuario->execute();

        $user = $stmt_usuario->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $db->desconectarBD();
    }
} else {
    echo "No se encontró el ID del usuario en la sesión.";
}
?>
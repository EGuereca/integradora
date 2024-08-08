<?php

include "../CLASS/database.php";

$db = new Database();
$db->conectarBD();

session_start();
$iduser = $_SESSION["id"];

try {
    $pdo = $db->getPDO();
    
    $query = "
        SELECT v.id_venta as id_venta, v.fecha_venta as fecha_venta, v.monto_total as monto_total, v.estado as estado, u.nombre AS nombre_usuario, s.nombre as sucursal
        FROM ventas v
        JOIN clientes c ON v.id_cliente = c.id_cliente
        JOIN personas p ON c.id_persona = p.id_persona
        JOIN usuarios u ON p.id_persona = u.id_persona
        JOIN sucursales s ON v.id_sucursal s.id_sucursal
        WHERE u.id_usuario = :id AND v.estado = 'COMPLETADA'
        "   
        ;
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $iduser, PDO::PARAM_INT);
    $stmt->execute();
    
    $completadasa = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $db->desconectarBD();
}

?>
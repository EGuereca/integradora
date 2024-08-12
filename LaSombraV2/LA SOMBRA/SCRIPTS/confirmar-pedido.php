<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../CLASS/database.php";
    $db = new Database();
    $db->conectarBD();
    $conexion = $db->getPDO();

    $id_venta = $_POST['id_venta'];

    $sql = "UPDATE venta SET estado = 'COMPLETADA' WHERE id_venta = :id_venta";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_venta', $id_venta);

    if ($stmt->execute()) {
        echo "Pedido confirmado exitosamente.";
    } else {
        echo "Error al confirmar el pedido.";
    }

    header("Location: ../VIEWS/dash-apartados.php");
    exit;
}
?>

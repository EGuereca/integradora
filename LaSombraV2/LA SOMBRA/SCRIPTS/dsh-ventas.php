<?php

include "../CLASS/database.php";

$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$prod = "SELECT id_producto, nombre, descripcion, precio, stock, url 
        FROM productos";
$cat = $conexion->prepare($prod);
$cat->execute();
$c = $cat->fetchAll(PDO::FETCH_ASSOC);

$hoy = date('Y-m-d');

$date = isset($_POST["fecha"]) ? $_POST["fecha"] : '';

$sql = "SELECT DISTINCT v.id_venta AS id, r.monto_total AS total,
e.nombres AS vendedor FROM venta AS v LEFT JOIN empleado AS e 
ON v.id_empleado = e.id_empleado JOIN reporte_ventas AS r
ON v.id_venta = r.venta
WHERE v.estado = 'COMPLETADA'";

if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy();  
    header("Location: ../VIEWS/iniciov2.php");      
    exit();
}

if (isset($_POST['btnfecha'])) {
    if ($date == null) {
        $sql .= "AND v.fecha_venta LIKE '$hoy%'";
    } else {
        $sql .= "AND v.fecha_venta LIKE '$date%'";
    }
} else {
    $sql .= "AND v.fecha_venta LIKE '$hoy%'";
}

$stmt = $conexion->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resultCount = $stmt->rowCount();

if (isset($_GET['id'])) {
    $idVenta = $_GET['id'];
    $venta = obtenerDetallesVenta($idVenta);

    $idVenta = isset($venta['id_venta']) ? $venta['id_venta'] : 'N/A';
    $fechaVenta = isset($venta['fecha_venta']) ? $venta['fecha_venta'] : 'N/A';
    $vendedor = isset($venta['id_empleado']) ? obtenerNombreEmpleado($venta['id_empleado']) : 'N/A';
    $totalVenta = isset($venta['monto_total']) ? $venta['monto_total'] : 'N/A';

}

function obtenerDetallesVenta($idVenta) {
    global $conexion;
    $query = $conexion->prepare("SELECT * FROM venta WHERE id_venta = :id");
    $query->bindParam(':id', $idVenta, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function obtenerProductosVenta($idVenta) {
    global $conexion;
    $query = $conexion->prepare("SELECT dv.cantidad, p.nombre, (p.precio * dv.cantidad) AS subtotal
                                 FROM detalle_venta AS dv
                                 JOIN productos AS p ON dv.producto = p.id_producto
                                 WHERE dv.venta = :id");
    $query->bindParam(':id', $idVenta, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerNombreEmpleado($idEmpleado) {
    global $conexion;
    $query = $conexion->prepare("SELECT CONCAT(nombres, ' ', ap_paterno, ' ', ap_materno) AS nombre FROM empleado WHERE id_empleado = :id");
    $query->bindParam(':id', $idEmpleado, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchColumn();
}

?>

<?php
/*
$hostname = "localhost";
$user = "root";
$password = "";
$database = "la_sombra";
$charset = "utf8";
$dsn = "mysql:host=$hostname;dbname=$database;charset=$charset";


try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit; 
}
*/
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
ON v.id_empleado = e.id_empleado JOIN repore_ventas AS r
ON v.id_venta = r.venta
WHERE v.estado = 'COMPLETADA'";

if (isset($_POST['btnfecha'])) {
    if ($date == null) {
        $sql .= "AND v.fecha_venta LIKE '$hoy%'";
    }
    else{
    $sql .= "AND v.fecha_venta LIKE '$date%'";
    }
}
else {
    $sql .= "AND v.fecha_venta LIKE '$hoy%'";
}

$stmt = $conexion->prepare($sql);
$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resultCount = $stmt->rowCount();
?>
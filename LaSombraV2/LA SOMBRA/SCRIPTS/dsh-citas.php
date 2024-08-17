<?php


include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"] : '';
$perforador = isset($_POST["perforador"]) ? $_POST["perforador"] : '';
$date = isset($_POST["fecha"]) ? $_POST["fecha"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
$empleado = isset($_POST["empleado"]) ? $_POST["empleado"] : '';
$fecha_hora = isset($_POST["datetime"]) ? $_POST["datetime"] : '';
$comentarios = isset($_POST["coments"]) ? $_POST["coments"] : '';
$costo = isset($_POST["costo"]) ? $_POST["costo"] : '';

$tipo_perforacion = '';
if (isset($_POST["perfo"])) {
    if ($_POST["perfo"] == 'otro') {
        $tipo_perforacion = $_POST["extra"];
    } else {
        $tipo_perforacion = $_POST["perfo"];
    }
}
if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy();  

    header("Location: ../VIEWS/iniciov2.php");      
    exit();
}

$con = "SELECT e.nombres AS perforadores, e.id_empleado AS id 
FROM empleado AS e 
JOIN persona AS p ON e.persona = p.id_persona 
JOIN usuarios AS u ON p.usuario = u.id_usuario 
JOIN rol_usuario AS ru ON u.id_usuario = ru.usuario
WHERE ru.rol = 4;";

$sql = "SELECT c.id_cita AS id, e.nombres AS perforador, c.nombre_cliente AS cliente, 
c.tipo_perforacion AS perforacion, c.fecha_hora AS fecha,
s.nombre AS sucursal, c.telefono AS telefono
FROM empleado AS e
JOIN citas AS c ON e.id_empleado = c.empleado
JOIN sucursales AS s ON c.sucursal = s.id_sucursal
WHERE 1=1";

$params = [];

if ($sucursal) {
    $sql .= " AND c.sucursal = :sucursal";
    $params[':sucursal'] = $sucursal;
}

if ($date) {
    $sql .= " AND c.fecha_hora LIKE :date";
    $params[':date'] = $date . '%';
}

if ($perforador) {
    $sql .= " AND c.empleado = :perforador";
    $params[':perforador'] = $perforador;
}

$stmt = $conexion->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$perf = $conexion->prepare($con);
$perf->execute();
$pe = $perf->fetchAll(PDO::FETCH_ASSOC);

$insert = $conexion->prepare("INSERT INTO citas(nombre_cliente,empleado,tipo_perforacion,fecha_hora,sucursal,comentarios,telefono,costo)
VALUES(?,?,?,?,?,?,?,?)");
if (isset($_POST['btnreg'])) {
    $insert->bindParam(1, $nombre, PDO::PARAM_STR);
    $insert->bindParam(2, $empleado, PDO::PARAM_INT);
    $insert->bindParam(3, $tipo_perforacion, PDO::PARAM_STR);
    $insert->bindParam(4, $fecha_hora, PDO::PARAM_STR);
    $insert->bindParam(5, $sucursal, PDO::PARAM_INT);
    $insert->bindParam(6, $comentarios, PDO::PARAM_STR);
    $insert->bindParam(7, $telefono, PDO::PARAM_STR);
    $insert->bindParam(8, $costo, PDO::PARAM_STR);

    $insert->execute();
}
?>
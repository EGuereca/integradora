<?php
if (!defined('SESSION_STARTED')) {
    session_start();
}


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $_SESSION['id'] = null;
}

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


if ($_SESSION['id'] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit(); 
}
else {
$sql = "SELECT dv.cantidad AS cantidad, p.nombre AS nombre,
    p.precio AS precio
    FROM detalle_venta AS dv
    JOIN productos AS p ON dv.producto = p.id_producto
    WHERE dv.venta = (SELECT 	id_venta  FROM
    venta WHERE id_cliente = (SELECT c.id_cliente FROM cliente
    AS c JOIN persona AS p ON c.persona = p.id_persona
    JOIN usuarios AS u ON p.usuario = u.id_usuario
    WHERE id_usuario = :usuario
    ) AND estado = 'CARRITO')";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':usuario', $id, PDO::PARAM_STR);

    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "sombra";
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

$productos_por_pagina = 9;

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

$inicio = ($pagina - 1) * $productos_por_pagina;

$sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos LIMIT :inicio, :productos_por_pagina";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':productos_por_pagina', $productos_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_sql = "SELECT COUNT(*) FROM productos";
$total_stmt = $pdo->query($total_sql);
$total_productos = $total_stmt->fetchColumn();
$total_paginas = ceil($total_productos / $productos_por_pagina);

$pdo = null; 


?>

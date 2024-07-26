<?php
if (!defined('SESSION_STARTED')) {
    session_start();
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

$productos_por_pagina = 9;

$marca = isset($_SESSION['marca']) ? $_SESSION['marca'] : null;

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = $pagina > 0 ? $pagina : 1;

$inicio = ($pagina - 1) * $productos_por_pagina;

if ($marca !== null) {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos WHERE marca = :marca LIMIT $inicio, $productos_por_pagina";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
    $total_sql = "SELECT COUNT(*) FROM productos WHERE marca = :marca";
} else {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos LIMIT $inicio, $productos_por_pagina";
    $stmt = $pdo->prepare($sql);
    $total_sql = "SELECT COUNT(*) FROM productos";
}

$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_stmt = $pdo->prepare($total_sql);
if ($marca !== null) {
    $total_stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
}
$total_stmt->execute();
$total_productos = $total_stmt->fetchColumn();
$total_paginas = ceil($total_productos / $productos_por_pagina);

$pdo = null; 

?>

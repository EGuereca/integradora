<?php

  
define('SESSION_STARTED', true);
session_start();

$_SESSION['marca'] = null;
if (isset($_SESSION['sucursal'])) {
    $sucursal = $_SESSION['sucursal'];
} else {
    $_SESSION['sucursal'] = null;
}
include "../CLASS/database.php";
require '../SCRIPTS/config-prod.php';

//sucursales
$sucursales = array(
    '1' => 'Nazas',
    '2' => 'Matamoros'
);
if (isset($_POST['sucursal'])) {
    $_SESSION['sucursal'] = $_POST['sucursal'];
}

$sucursal = isset($_SESSION['sucursal']) ? $_SESSION['sucursal'] : 1;
$_SESSION['sucursal'] = $sucursal;


$db = new Database();
$db->conectarBD();
$conexion = $db->getPDO();

/*
$nm_prod = isset($_POST["nm_prod"]) ? $_POST["nm_prod"] : '';
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : '';
*/
$nm_prod = isset($_GET["nm_prod"]) ? $_GET["nm_prod"] : '';
$categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : '';
$productos_por_pagina = 18;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = $pagina > 0 ? $pagina : 1;
$inicio = ($pagina - 1) * $productos_por_pagina;

$sql = "SELECT DISTINCT p.id_producto AS id_producto, p.nombre AS nombre, 
        p.precio AS precio, ins.cantidad AS stock, c.nombre AS categoria, p.url
        FROM productos AS p
        JOIN producto_categoria AS pc ON p.id_producto = pc.producto
        JOIN categorias AS c ON pc.categoria = c.id_categoria
        JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto 
        WHERE 1=1";

// Filtrar por sucursal
if ($sucursal !== null) {
    $sql .= " AND ins.id_sucursal = :sucursal";
}

// Filtrar por nombre de producto
if ($nm_prod) {
    $sql .= " AND p.nombre LIKE :nm_prod";
}

// Filtrar por categoría
if ($categoria) {
    $sql .= " AND c.id_categoria = :categoria";
}

// Paginación
$sql .= " LIMIT :inicio, :productos_por_pagina";

$stmt = $conexion->prepare($sql);

if ($nm_prod) {
    $stmt->bindValue(':nm_prod', '%' . $nm_prod . '%');
}
if ($sucursal !== null) {
    $stmt->bindValue(':sucursal', $sucursal, PDO::PARAM_INT);
}
if ($categoria) {
    $stmt->bindValue(':categoria', $categoria, PDO::PARAM_INT);
}
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':productos_por_pagina', $productos_por_pagina, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_sql = "SELECT COUNT(DISTINCT p.id_producto)
            FROM productos AS p
            JOIN producto_categoria AS pc ON p.id_producto = pc.producto
            JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto
            JOIN categorias AS c ON pc.categoria = c.id_categoria
            WHERE 1=1";

if ($sucursal !== null) {
    $total_sql .= " AND ins.id_sucursal = :sucursal";
}
if ($nm_prod) {
    $total_sql .= " AND p.nombre LIKE :nm_prod";
}
if ($categoria) {
    $total_sql .= " AND c.id_categoria = :categoria";
}

$total_stmt = $conexion->prepare($total_sql);
if ($nm_prod) {
    $total_stmt->bindValue(':nm_prod', '%' . $nm_prod . '%');
}
if ($sucursal !== null) {
    $total_stmt->bindValue(':sucursal', $sucursal, PDO::PARAM_INT);
}
if ($categoria) {
    $total_stmt->bindValue(':categoria', $categoria, PDO::PARAM_INT);
}
$total_stmt->execute();
$total_productos = $total_stmt->fetchColumn();
$total_paginas = ceil($total_productos / $productos_por_pagina);

$pdo = null;
?>

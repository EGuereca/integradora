<?php
if (!defined('SESSION_STARTED')) {
    session_start();
}


if (isset($_SESSION['sucursal'])) {
    $sucursal = $_SESSION['sucursal'];
} else {
    $_SESSION['sucursal'] = null;
}

$hostname = "3.144.20.56";
$user = "guereca";
$password = "123";
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nazas'])) {
    $_SESSION['sucursal'] = '1';
    
    header("Location: ../VIEWS/productos.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo'])) {
    $_SESSION['sucursal'] = '2';
    
    header("Location: ../VIEWS/productos.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matamoros'])) {
    $_SESSION['sucursal'] = '3';
    
    header("Location: ../VIEWS/productos.php");
    exit();
}

if ($marca !== null) {
    if ($_SESSION['sucursal'] == null) {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos WHERE marca = :marca LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
        $total_sql = "SELECT COUNT(*) FROM productos WHERE marca = :marca";
    }
    else{
    if ($_SESSION['sucursal'] == '1') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos_nazas WHERE marca = :marca AND stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
        $total_sql = "SELECT COUNT(*) FROM productos_nazas WHERE marca = :marca 
        AND stock > 0";
    }
    if ($_SESSION['sucursal'] == '2') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos WHERE marca = :marca AND stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
        $total_sql = "SELECT COUNT(*) FROM productos WHERE marca = :marca
        AND stock > 0";
    }
    if ($_SESSION['sucursal'] == '3') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos_matamoros WHERE marca = :marca AND stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':marca', $marca, PDO::PARAM_STR);
        $total_sql = "SELECT COUNT(*) FROM productos_matamoros WHERE marca = :marca
        AND stock > 0";
    }    
    }
} else {
    if ($_SESSION['sucursal'] == null) {
        $sql = $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos WHERE stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $total_sql = "SELECT COUNT(*) FROM productos";
    }
    else{
    if ($_SESSION['sucursal'] == '1') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos_nazas WHERE stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $total_sql = "SELECT COUNT(*) FROM productos_nazas WHERE stock > 0";
    }
    if ($_SESSION['sucursal'] == '2') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos WHERE stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $total_sql = "SELECT COUNT(*) FROM productos WHERE stock > 0";
    }
    if ($_SESSION['sucursal'] == '3') {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
        FROM productos_matamoros WHERE stock > 0
        LIMIT $inicio, $productos_por_pagina";
        $stmt = $pdo->prepare($sql);
        $total_sql = "SELECT COUNT(*) FROM productos_matamoros WHERE stock > 0";
    }
    }    
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

<?php
session_start();

if ($_SESSION['rol'] == 3) {
    if (isset($_GET['marca'])) {    
        $_SESSION['marca'] = $_GET['marca'];    
    }
    header("Location: ../VIEWS/catalogo-marcas.php");
    exit();
}

if ($_SESSION['rol'] != 3) {
    if (isset($_GET['sucursal'])) {    
        $_SESSION['sucursal'] = $_GET['sucursal'];    
    }
    header("Location: ../VIEWS/dash-ventas.php");
    exit();
}


?>

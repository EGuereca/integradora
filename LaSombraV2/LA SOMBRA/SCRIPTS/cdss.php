<?php
session_start();

if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == null) {
    if (isset($_GET['marca'])) {    
        $_SESSION['marca'] = $_GET['marca'];    
    }
    header("Location: ../VIEWS/catalogo-marcas.php");
    exit();
}




?>

<?php
session_start();

if (isset($_GET['marca'])) {    
    $_SESSION['marca'] = $_GET['marca'];    
}

header("Location: ../VIEWS/catalogo-marcas.php");
exit();
?>

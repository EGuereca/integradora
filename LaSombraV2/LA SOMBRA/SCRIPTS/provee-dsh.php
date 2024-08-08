<?php

    include "../CLASS/database.php";
    $db = new Database();
    $db->conectarBD();
    
    $conexion = $db->getPDO();

$sql = "SELECT id_proveedor AS id ,nombre, telefono, pagina FROM proveedores";
$stm = $conexion->prepare($sql);
$stm->execute();

$insert = $conexion->prepare("INSERT INTO proveedores(nombre,telefono,pagina) 
VALUES(?,?,?)");

$results = $stm->fetchAll(PDO::FETCH_ASSOC);

$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
$url = isset($_POST["url"]) ? $_POST["url"] : '';

if (isset($_POST['btnreg'])) {
    $insert->bindParam(1, $nombre, PDO::PARAM_STR);
    $insert->bindParam(2, $telefono, PDO::PARAM_STR);
    $insert->bindParam(3, $url, PDO::PARAM_STR);
    $insert->execute();
}

?>
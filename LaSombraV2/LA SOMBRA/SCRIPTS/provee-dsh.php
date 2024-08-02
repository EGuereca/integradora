<?php
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

$sql = "SELECT id_proveedor AS id ,nombre, telefono, pagina FROM proveedores";
$stm = $pdo->prepare($sql);
$stm->execute();

$insert = $pdo->prepare("INSERT INTO proveedores(nombre,telefono,pagina) 
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
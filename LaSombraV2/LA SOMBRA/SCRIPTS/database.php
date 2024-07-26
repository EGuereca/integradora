<?php
require '../SCRIPTS/config-prod.php';

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
  
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
      # HACER UNA PAGINA DE PRODUCTO NO ENCONTRADO
      echo "ERROR llll";
      exit;
}
else {
      $token_tmp = hash_hmac('sha256',$id,K_TOKEN);
      if ($token == $token_tmp) {
          $sql = $pdo->prepare("SELECT COUNT(id_producto) FROM productos
          WHERE id_producto = ?");
          $sql->execute([$id]);
          if ($sql->fetchColumn() > 0) {
            $sql = $pdo->prepare("SELECT nombre, marca, descripcion, precio, material FROM productos
            WHERE id_producto = ?");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $marca = $row['marca'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];

            $sql2= $pdo->prepare("SELECT id_producto ,nombre, marca, descripcion, precio, material, stock FROM productos
            WHERE marca = ? LIMIT 3");
            $sql2->execute([$marca]);
            $row2 = $sql2->fetchAll(PDO::FETCH_ASSOC);             
          }        
      }
      else {
        echo "ERROR";
          exit;
      }
}



?>
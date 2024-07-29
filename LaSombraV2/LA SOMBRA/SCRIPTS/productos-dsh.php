<?php  
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

$nm_prod = isset($_POST["nm_prod"]) ? $_POST["nm_prod"] : '';
$id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : '';
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : '';
$sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"] : '';



$sql = "SELECT DISTINCT p.id_producto AS id_producto, p.nombre AS nombre, 
        p.precio AS precio, p.stock AS stock, c.nombre AS categoria
        FROM productos AS p
        JOIN producto_categoria AS pc ON p.id_producto = pc.producto
        JOIN categorias AS c ON pc.categoria = c.id_categoria
        JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto 
        WHERE 1=1";
        
if ($sucursal) {
    if ($sucursal != '3') {
        $sql = "SELECT DISTINCT p.id_producto AS id_producto, p.nombre AS nombre, 
        p.precio AS precio, ins.cantidad AS stock, c.nombre AS categoria
        FROM productos AS p
        JOIN producto_categoria AS pc ON p.id_producto = pc.producto
        JOIN categorias AS c ON pc.categoria = c.id_categoria
        JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto 
        WHERE 1=1";
        $sql .= " AND ins.id_sucursal = :sucursal";
    }
    
}
if ($nm_prod) {
    $sql .= " AND p.nombre LIKE :nm_prod";
}
if ($id_prod) {
    $sql .= " AND p.id_producto = :id_prod";
}
if ($categoria) {
    $sql .= " AND c.id_categoria = :categoria";
}


$stmt = $pdo->prepare($sql);

if ($nm_prod) {
    $stmt->bindValue(':nm_prod', '%' . $nm_prod . '%');
}
if ($id_prod) {
    $stmt->bindValue(':id_prod', $id_prod);
}
if ($categoria) {
    $stmt->bindValue(':categoria', $categoria);            
}
if ($sucursal) {
    if ($sucursal != '3') {
        $stmt->bindValue(':sucursal', $sucursal);
    }                
}

$stmt->execute();

echo "Número de resultados: " . $stmt->rowCount();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php  

include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

$nm_prod = isset($_POST["nm_prod"]) ? $_POST["nm_prod"] : '';
$id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : '';
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : '';
$sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"] : '';

$des = isset($_POST["desc"]) ? $_POST["desc"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$marca = '';
if (isset($_POST["contact"])) {
    if ($_POST["contact"] == 'otro') {
        $marca = $_POST["extra"];
    }
    else  {
        $marca = isset($_POST["contact"]);
    }
}


$precio = isset($_POST["precio"]) ? $_POST["precio"] : '';
$catego = isset($_POST["cate"]) ? $_POST["cate"] : '';
$provee = isset($_POST["proveedores"]) ? $_POST["proveedores"] : '';
$material = isset($_POST["material"]) ? $_POST["material"] : '';


$proveedores = "SELECT nombre, id_proveedor AS id FROM proveedores";
$cate = "SELECT nombre, id_categoria AS id FROM categorias";

$st = $conexion->prepare($proveedores);
$s = $conexion->prepare($cate);

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


$stmt = $conexion->prepare($sql);

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
$st->execute();
$s->execute();

echo "Número de resultados: " . $stmt->rowCount();

$cat = $s->fetchAll(PDO::FETCH_ASSOC);
$prov = $st->fetchAll(PDO::FETCH_ASSOC);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pral = $conexion->prepare("INSERT INTO productos(nombre,marca,precio,stock,material,descripcion,url) VALUES(?,?,?,0,?,?,?)");
if (isset($_POST['btnreg'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES['img']['name'];
            $temporal = $_FILES['img']['tmp_name'];
            $carpeta = '../IMG';
    
            $url = $carpeta . '/' . $nombreArchivo;
    
            if (move_uploaded_file($temporal, $url)) {
                echo "La imagen se ha subido correctamente. Puedes verla <a href='$url'>aquí</a>.";
            } else {
                echo "Hubo un error al subir la imagen.";
            }
        } else {
            echo "No se ha seleccionado ningún archivo o hubo un error en la subida.";
        }
    }

    $pral->bindParam(1, $nombre, PDO::PARAM_STR);
    $pral->bindParam(2, $marca, PDO::PARAM_STR);
    $pral->bindParam(3, $precio, PDO::PARAM_STR);
    $pral->bindParam(4, $material, PDO::PARAM_STR);
    $pral->bindParam(5, $des, PDO::PARAM_STR);
    $pral->bindParam(6, $url, PDO::PARAM_STR);

    $pral->execute();

    $ns = $conexion->prepare("SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1");
    $ns->execute();
    $id_p = $ns->fetch(PDO::FETCH_ASSOC)['id_producto'];
    
    $ll_cat = $conexion->prepare("INSERT INTO producto_categoria (producto,categoria) VALUES (:id,:cat)");
    foreach ($catego as $opcion) {
        $ll_cat->bindParam(':id', $id_p, PDO::PARAM_INT);
        $ll_cat->bindParam(':cat', $opcion, PDO::PARAM_STR);
        $ll_cat->execute(); 
    }
    
    $ll_prpro = $pdo->prepare("INSERT INTO proveedor_producto (proveedor,producto,precio_unitario_proveedor) VALUES (:prove,:id,0)");
    foreach ($provee as $opcion) {
        $opcion_int = intval($opcion);
        $ll_prpro->bindParam(':prove', $opcion_int, PDO::PARAM_INT);
        $ll_prpro->bindParam(':id', $id_p, PDO::PARAM_INT);
        $ll_prpro->execute(); 
    }
    
    header("refresh:3  ; ../VIEWS/dashboard.php");
}

?>

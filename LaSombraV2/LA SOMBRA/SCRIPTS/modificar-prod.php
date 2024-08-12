<?php
require_once "../CLASS/database.php";
$db = new Database();
$db->conectarBD();
$PDOLOCAL = $db->getPDO();


function get_selected_categories($producto_id, $PDOLOCAL) {
    $selected_categories = [];

    
    $stmt = $PDOLOCAL->prepare("SELECT categoria FROM producto_categoria WHERE producto = :producto_id");
    $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();

    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected_categories[] = $row['categoria'];
    }
    return $selected_categories;
}
function get_selected_providers($producto_id, $PDOLOCAL) {
    $selected_providers = [];

    $stmt = $PDOLOCAL->prepare("SELECT proveedor FROM proveedor_producto WHERE producto = :producto_id");
    $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected_providers[] = $row['proveedor'];
    }

    return $selected_providers;
}
?>

<?php
if (!empty($_POST["btnreg"])) {
    if (
        !empty($_POST["nombre"]) && 
        !empty($_POST["marca"]) && 
        !empty($_POST["cate"]) && 
        !empty($_POST["proveedores"]) && 
        !empty($_POST["precio"]) && 
        !empty($_POST["material"]) && 
        !empty($_POST["desc"])
    ) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $marca = $_POST["marca"];
        $categorias = $_POST["cate"]; 
        $proveedores = $_POST["proveedores"]; 
        $precio = $_POST["precio"];
        $material = $_POST["material"];
        $descripcion = $_POST["desc"];

        // Usar prepare y execute para la consulta de actualización
        $stmt = $PDOLOCAL->prepare("UPDATE productos SET nombre=:nombre, marca=:marca, 
            precio=:precio, material=:material, descripcion=:descripcion WHERE id_producto=:id");
        
        // Vincular los parámetros con las variables
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':material', $material);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: ../VIEWS/dashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>No se pudo actualizar el producto.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Campos vacíos</div>";
    }
}

?>

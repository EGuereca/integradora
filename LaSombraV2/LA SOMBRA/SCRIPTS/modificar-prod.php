<?php
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
    $stmt = $PDOLOCAL->query("UPDATE productos SET nombre='$nombre', marca='$marca', 
            precio='$precio', material='$material', descripcion='$descripcion' WHERE id_producto='$id'");

        if ($stmt) {
            echo "ANIMOOO";
        } else {
            echo "No se pudo actualizar el producto";
        }
    } else {
        echo "<div class='alert alert-warning'>Campos vacíos</div>";
    }
}
?>

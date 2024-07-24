<?php
    require '../scripts/database.php';
    $db = new Database();
    $con = $db->conectarBD();

    $sql = $con->prepare("SELECT id_producto, nombre, descripcion, precio FROM productos");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - La Sombra</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/productos.css">
</head>
<body>
    <header id="inicio" class="row header">
        <div class="user-cart col-lg-4 col-sm-6">
            <a href="../HTML/inicio-sesion.html"><img src="../ICONS/user.png" alt="user"></a>
            <a href="../index.html"><img src="../ICONS/cart.png" alt="cart"></a>
        </div>
        <div class="logo col-lg-4 col-sm-6"><a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a></div>
        <nav class="nav col-lg-4 col-sm-12">
            <a style="color: green;" href="#in">Productos</a>
            <a href="../HTML/perforaciones.html">Perforaciones</a>
            <a href="#suc">Sucursales</a>
        </nav>
    </header>
    <div class="container" id="#in">
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Buscar artículo...">
        </div>
        <div  class="row">
            <?php foreach ($resultado as $row) {?>
        
            <div class="col-md-4">
                <div class="product">
                    <?php 
                        $id = $row['id_producto'];
                        $imagen = "../img-productos/".$id;

                        if (!file_exists($imagen)) {
                            $imagen = "../img-productos/no-dispo.png";
                        }
                    ?>
                    <img src="<?php echo $imagen; ?>" alt="Product Image">
                    <h5><?php echo $row['nombre']; ?></h5>
                    <p><?php echo $row['descripcion']; ?></p>
                    <p>$ <?php echo $row['precio']; ?></p>
                </div>
            </div>
            <?php } ?>            
        </div>
    </div>
</body>
</html>
<?php
    define('SESSION_STARTED', true);
    session_start();

    $_SESSION['marca'] = null;
    if (isset($_SESSION['sucursal'])) {
        $sucursal = $_SESSION['sucursal'];
    } else {
        $_SESSION['sucursal'] = null;
    }
    include "../CLASS/database.php";
    require '../SCRIPTS/config-prod.php';

    //sucursales
    if (isset($_POST['todo'])) {
        $_SESSION['sucursal'] = 3; // all products 
    } elseif (isset($_POST['nazas'])) {
        $_SESSION['sucursal'] = 1; // Nazas
    } elseif (isset($_POST['matamoros'])) {
        $_SESSION['sucursal'] = 2; // Matamoros
    }

    $sucursal = isset($_SESSION['sucursal']) ? $_SESSION['sucursal'] : 3;

    $db = new Database();
    $db->conectarBD();
    $conexion = $db->getPDO();

    $nm_prod = isset($_POST["nm_prod"]) ? $_POST["nm_prod"] : '';
    $productos_por_pagina = 9;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $pagina = $pagina > 0 ? $pagina : 1;
    $inicio = ($pagina - 1) * $productos_por_pagina;

    $sql = "SELECT DISTINCT p.id_producto AS id_producto, p.nombre AS nombre, 
            p.precio AS precio, ins.cantidad AS stock, c.nombre AS categoria, p.url
            FROM productos AS p
            JOIN producto_categoria AS pc ON p.id_producto = pc.producto
            JOIN categorias AS c ON pc.categoria = c.id_categoria
            JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto 
            WHERE 1=1";

    // Filtrar por sucursal
    if ($sucursal !== 3) {
        $sql .= " AND ins.id_sucursal = :sucursal";
    }

    // Filtrar por nombre de producto
    if ($nm_prod) {
        $sql .= " AND p.nombre LIKE :nm_prod";
    }

    // Paginación
    $sql .= " LIMIT :inicio, :productos_por_pagina";

    $stmt = $conexion->prepare($sql);

    if ($nm_prod) {
        $stmt->bindValue(':nm_prod', '%' . $nm_prod . '%');
    }
    if ($sucursal !== 3) {
        $stmt->bindValue(':sucursal', $sucursal, PDO::PARAM_INT);
    }
    $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
    $stmt->bindValue(':productos_por_pagina', $productos_por_pagina, PDO::PARAM_INT);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_sql = "SELECT COUNT(DISTINCT p.id_producto)
                    FROM productos AS p
                    JOIN producto_categoria AS pc ON p.id_producto = pc.producto
                    JOIN inventario_sucursal AS ins ON p.id_producto = ins.id_producto
                    ";
    if ($sucursal !== 3) {
        $total_sql .= " AND ins.id_sucursal = :sucursal";
    }
    if ($nm_prod) {
        $total_sql .= " AND p.nombre LIKE :nm_prod";
    }

    $total_stmt = $conexion->prepare($total_sql);
    if ($nm_prod) {
        $total_stmt->bindValue(':nm_prod', '%' . $nm_prod . '%');
    }
    if ($sucursal !== 3) {
        $total_stmt->bindValue(':sucursal', $sucursal, PDO::PARAM_INT);
    }
    $total_stmt->execute();
    $total_productos = $total_stmt->fetchColumn();
    $total_paginas = ceil($total_productos / $productos_por_pagina);

    $pdo = null;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - La Sombra</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/productos.css">

</head>
<body>
    

<header>
<nav id="contenedor-todo" class="navbar navbar-dark  fixed-top">
    <div  class="container">
    <div class="row align-items-center">
    

    <div class="col-md-3 d-none d-lg-flex justify-content-start">
            <div class="user-cart dropdown">
                <?php
                    if(isset($_SESSION["id"])) 
                    { ?>
                    
                    <a href='../VIEWS/detalle-cuenta.php'><img src='../ICONS/user.png' alt='cart'></a>
                    <?php }

                    else{ ?>
                    <a href='../VIEWS/inicio-sesion.php'><img src='../ICONS/user.png' alt='cart'></a>
                    
                    <?php } ?>
                    
                    <a href="../VIEWS/carrito.php"><img src="../ICONS/cart.png" alt="cart"></a>
            </div>
        </div>


    <div id="logo" class="col-6 col-lg-4 order-1 order-lg-3 text-start text-lg-end logo">
        <a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a>
    </div>

    <div class="col-6 col-lg-4 text-end order-2 order-lg-4">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <div class="logo">
                <a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div  id="body-burger"   class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../VIEWS/iniciov2.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/productos.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/perforaciones.php">PERFORACIONES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/carrito.php">CARRITO</a>
                    </li>
                    
                    <?php
                    if(isset($_SESSION["id"])) 
                    { ?>
                    
                        <li class='nav-item'>
                        <a class='nav-link' href='../VIEWS/detalle-cuenta.php'>CUENTA</a>
                        </li>

                        <li class='nav-item'>

                        <a class='nav-link' href='../SCRIPTS/cerrarsesion.php'>
                            <button id="cerrar" class="btn btn-danger"> CERRAR SESION</button>
                        </a>
                        </li>
                    <?php }

                    else{ ?>
                        <li class='nav-item'>
                        <a class='nav-link' href='../VIEWS/inicio-sesion.php'>CUENTA</a>
                        </li>
                    <?php } ?>
                    
                    
                    <div  class="admin">
                    
                    <?php  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {?>
                            <li id="panel" class='nav-item'>
                                    <a class='nav-link' href='../VIEWS/dash-ventas.php'>PANEL DE ADMINISTRADOR</a>
                            </li>
                    <?php } ?>
            
                    
                    </div>

                    <div class="contacto">
                        <p>Whatsapp: 8715066383</P>
                        <p>Correo: lasombratrc@hotmail.com</P>
                    </div>
                    

                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </nav>
</header>

    <div class="container" id="in">
        <div class="search-bar mb-3">
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Buscar artículo..." name="nm_prod" value="<?php echo htmlspecialchars($nm_prod); ?>">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                </div>
            </div>
        </form>
        </div>
        <?php
            if($_SESSION['sucursal'] == null){
                
        ?>
        <div class="container">
            <div id="seleccionar" class="col-12">
            <h2>Seleccione una sucursal para visualizar los productos de la seleccionada:</h2> <br>
            <form method="post" action="">
                <button type="submit" class="btn btn-outline-primary" name="todo">Todo</button>
                <button type="submit" class="btn btn-outline-secondary" name="nazas">Nazas</button>
                <button type="submit" class="btn btn-outline-success" name="matamoros">Matamoros</button>
            </form>
            </div>
        </div>
        <?php } 
                else{        
        ?>
        <div class="row">      
        <?php
        if (!empty($results)) {
            foreach ($results as $row) { ?>

                <div class="col-lg-4 col-sm-12">
                <div class="card mb-4">
                <a href="../VIEWS/detalle_producto.php?id=<?php echo $row['id_producto'];?>&token=<?php 
                echo hash_hmac('sha256',$row['id_producto'],K_TOKEN);?>">
                    <div class="card-img-container">                 
                    <img src="<?php echo $row['url'] ?? '../IMG/PRODUCTOS/notfound.png'; ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" class="card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                        <p class="card-text">$ <?php echo $row['precio']; ?></p>
                        <p class="card-text"><?php echo $row['stock']; ?> piezas disponibles</p>
                    </div>
                    </a>
                </div>
            </div>          
        <?php
            }
        } else {
            echo "No hay productos disponibles";
        }
        ?>           
            </div>

            <div class="paginacion">
            <?php
            $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            for ($i = 1; $i <= $total_paginas; $i++) {
                $active_class = $i == $pagina_actual ? 'active' : '';
                echo "<a href='?pagina=" . $i . "' class='" . $active_class . "'>" . $i . "</a> ";
            }
            ?>
            </div>
        <?php } ?>
    </div>
        <footer class="footer row">
            <div class="offset-lg-1 col-lg-9 text">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1 rs"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
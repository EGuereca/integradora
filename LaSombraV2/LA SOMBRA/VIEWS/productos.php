<?php
    include '../SCRIPTS/conf-catalogo.php';
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
<header id="inicio" class="row header">
        <div class="user-cart col-lg-4 col-sm-4">
            <a href="../VIEWS/inicio-sesion.html"><img src="../ICONS/user.png" alt="user"></a>
            <a href="../index.html"><img src="../ICONS/cart.png" alt="cart"></a>
        </div>
        <div class="logo col-lg-4 col-sm-4"><a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a></div>
        <nav class="navbar navbar-expand-lg col-lg-4 col-sm-4">
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/iniciov2.php">Inicio</a>
                    </li>
                    <li class="nav-item active">
                        <a style="color: green;" class="nav-link" href="#in">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/perforaciones.php">Perforaciones</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container" id="in">
        <div class="search-bar mb-3">
            <input type="text" class="form-control" placeholder="Buscar artículo...">
        </div>
        <div class="row">      
        <?php
        if (!empty($productos)) {
            foreach ($productos as $row) { ?>

                <div class="col-lg-4 col-sm-12">
                <div class="card mb-4">
                <a href="../HTML/detalle_producto.php">
                    <div class="card-img-container">
                        <img src="../IMG/blazy-susan.svg" alt="<?php echo $row['nombre']; ?>" class="card-img-top">
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
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
                }
            ?>
            </div>
    </div>
        <footer class="footer row">
            <div class="offset-1 col-lg-9 text">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1 rs"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
        </footer>
    </div>
</body>
</html>
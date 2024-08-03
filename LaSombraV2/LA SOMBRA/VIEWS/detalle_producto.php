<?php
    require '../SCRIPTS/detalle-prod.php';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - La Sombra</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/detalle_producto.css">
</head>
<body>
<!--
<header id="inicio" class="row header">
        <div class="user-cart col-lg-4 col-sm-4">
            <a href="../VIEWS/inicio-sesion.php"><img src="../ICONS/user.png" alt="user"></a>
            <a href="../index.html"><img src="../ICONS/cart.png" alt="cart"></a>
        </div>
        <div class="logo col-lg-4 col-sm-4"><a href="../VIEWS/iniciov2.php"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a></div>
        <nav class="navbar navbar-expand-lg col-lg-4 col-sm-4">
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/iniciov2.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/perforaciones.php">Perforaciones</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
-->
<header>
<nav id="contenedor-todo" class="navbar navbar-dark  fixed-top">
    <div  class="container">
    <div class="row align-items-center">
    


    <div class="col-md-3 d-none d-lg-flex justify-content-start">
            <div class="user-cart">
                <a href="../VIEWS/inicio-sesion.php"><img src="../ICONS/user.png" alt="user"></a>
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
                <!-- <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">LA SOMBRA</h5> -->
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

                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/inicio-sesion.php">CUENTA</a>
                    </li>
                    
                    <li class="nav-item">
                    <form class=" d-flex mt-3 " role="search">
                        <input id="buscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                        <button id="btn-nav" class="btn btn-success" type="submit">Buscar</button>
                    </form>
                    </li>

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
        <div class="row" style="padding-top: 150px;">
            <div class="col-lg-6 col-sm-12">
                <img src="../IMG/blazy-susann.jpg" alt="<?php echo $nombre;?>" class="img-fluid">
            </div>
            <div class="col-lg-6 col-sm-12">
                <h1><?php echo $nombre;?></h1>
                <h2>$ <?php echo $precio;?></h2>
                <p><strong>Cantidad disponible:</strong> <?php echo $stock;?> piezas</p>
                <form action="" method="post">
                <select class="form-control" name="cantidad">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
                <button name="btncarrito" type="submit" class="btn btn-pink btn-lg <?php if ($stock < 0) {
                    echo "disabled";
                }?>">AGREGAR A CARRITO</button>
                </form>
                
            </div>
        </div>
        <h2 class="mt-5">Productos relacionados:</h2>
        <div class="row">
            <?php 
            
            foreach($row2 as $row) {?>

        <div class="col-lg-4 col-sm-12">
                <div class="card mb-4">
                    <a href="../VIEWS/detalle_producto.php?id=<?php echo $row['id_producto'];?>&token=<?php 
                echo hash_hmac('sha256',$row['id_producto'],K_TOKEN);?>">
                    <div class="card-img-container">
                        <img src="../IMG/bicho.jpg" alt="<?php echo $row['nombre']; ?>" class="card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                        <p class="card-text">$ <?php echo $row['precio']; ?></p>
                        <p class="card-text"><?php echo $row['stock']; ?> piezas disponibles</p>
                    </div>
                    </a>
                </div>
            </div>
            <?php } ?>            
        </div>
        <footer class="footer row">
            <div class="col-lg-11 text">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1 rs"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

</body>
</html>
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
<header id="inicio" class="row header">
        <div class="user-cart col-lg-4 col-sm-4">
            <a href="../HTML/inicio-sesion.html"><img src="../ICONS/user.png" alt="user"></a>
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
                <select class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
                <button type="submit" class="btn btn-pink btn-lg <?php if ($stock < 0) {
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
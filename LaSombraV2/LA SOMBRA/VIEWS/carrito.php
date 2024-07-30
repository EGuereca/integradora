<?php
    include '../SCRIPTS/imprimir-carrito.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/carrito.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#in">Perforaciones</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
<div class="container cart-container">
<?php
        $total = 0;
        if (!empty($productos)) {
            foreach ($productos as $row) { 
             $total = $total + $row['precio'];   ?>
    <div class="row cart-item">
        <div class="col-md-3">
            <img src="../IMG/bicho.jpg" class="img-fluid" alt="Producto 1">
        </div>
        <div class="cart-item-details col-md-4">
            <p><?php echo $row['nombre'] ?></p>
        </div>
        <div class="col-md-2">
            <p>$ <?php echo $row['precio'] ?></p>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-dark" type="button">-</button>
                </div>
                <input type="text" class="form-control text-center" value="1">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
        } else {
            echo "No hay productos en el carrito";
        }
        ?>
    <div class="row cart-total">
        <div>
            <p>Subtotal: $<?php echo $total ?></p>
            <p>Dirección de recolección: Sucursal Nazas</p>
            <button class="btn btn-success">Confirmar pedido</button>
        </div>
    </div>
</div>
    <footer class="footer row">
            <div class=" offset-1 col-lg-9 text">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1 rs"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
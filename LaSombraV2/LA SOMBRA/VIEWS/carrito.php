<?php
/*
if ($_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
elseif ($_SESSION['rol'] != 3) {
    header("location: ../VIEWS/dashboard.php");
    exit();
}
*/

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
<header>
<nav id="contenedor-todo" class="navbar navbar-dark fixed-top">
    <div class="" id="conteiner">
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
                    {
                    
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='../VIEWS/detalle-cuenta.php'>CUENTA</a>
                        </li>";

                    ECHO "<li class='nav-item'>
                        <a class='nav-link' href='../SCRIPTS/cerrarsesion.php'>CERRAR SESION</a>
                        </li>";
                    }

                    else{
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='../VIEWS/inicio-sesion.php'>CUENTA</a>
                        </li>";
                    }
                    ?>
                    
                    
                    <li class="nav-item">
                    <form class=" d-flex mt-3 " role="search">
                        <input id="buscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                        <button id="btn-nav" class="btn btn-success" type="submit">Buscar</button>
                    </form>
                    </li>
                    
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
            <form action="" method="post">
                <button type="submit" name="btn" class="btn btn-success">Confirmar pedido</button>
            </form>
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
<script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
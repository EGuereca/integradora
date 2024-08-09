<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LA SOMBRA - OZUNA TRC</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/perforaciones.css">
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

    <div class="container">
            <div id="in" class="titulo row">
                <h1>PERFORACIONES</h1>
            </div>
            <div class="content row">
                <div class="about-text col-lg-6 col-sm-12">
                    <h3>Info de perforador</h3>
                    <p>Subheading for description or instructions</p>
                    <p>Body text for your whole article or post. We'll put in some lorem ipsum to show how a filled-out page might look.</p>
                    <p>Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation exquisite perfect nostrud nisi intricate Content. Qui international first-class nulla ut.</p>
                </div>
                <div class="about-img col-lg-6 col-sm-12">
                    <img src="../IMG/bicho.jpg" alt="Perforador">
                </div>
            </div>
            <div class="perforaciones">
                <h2>Tipos de perforaciones</h2>
                <div class="perforaciones-grid row">
                    <div class="col-lg-3 col-sm-6">
                        <img src="https://via.placeholder.com/100" alt="Perforación 1">
                        <p>Description of featured product</p>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <img src="https://via.placeholder.com/100" alt="Perforación 2">
                        <p>Description of featured product</p>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <img src="https://via.placeholder.com/100" alt="Perforación 3">
                        <p>Description of featured product</p>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <img src="https://via.placeholder.com/100" alt="Perforación 4">
                        <p>Description of featured product</p>
                    </div>
                </div>
                <div id="btn-wha" class="btn">
                    <a target="_blank" href="https://wa.me/+528712340008" class="cta-button">Genera tu cita!</a>
                </div>
            </div>
        </div>
        <footer class="footer row">
            <div class="  col-lg-9 text col-sm-12 ">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1  col-sm-12 text-lg-end"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LA SOMBRA - OZUNA TRC</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/iniciov2.css">
</head>
<body>
    <!--
    <header id="inicio" class="row header">
        <div class="user-cart col-lg-4 col-sm-4 hide-on-md-sm">
            <a href="../VIEWS/inicio-sesion.php"><img src="../ICONS/user.png" alt="user"></a>
            <a href=".."><img src="../ICONS/cart.png" alt="cart"></a>
        </div>
        <div class="logo col-lg-4 col-sm-4"><a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a></div>

        <nav class="navbar navbar-expand-lg col-lg-4 col-sm-4">
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a style="color: green;" class="nav-link" href="#in">Inicio</a>
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
    
    <!--
    <header id="inicio" class="header row">
    <div class="col-4 user-cart hide-on-md-sm">
        <a href="../VIEWS/inicio-sesion.php"><img src="../ICONS/user.png" alt="user"></a>
        <a href=".."><img src="../ICONS/cart.png" alt="cart"></a>
    </div>
    <div class="col-4 logo text-center">
        <a href="#in"><img src="../IMG/sombra-logo.jpg" alt="La Sombra"></a>
    </div>
    <div class="col-4 text-end">

    
        
        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBurger" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="burger">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a style="color: green;" class="nav-link" href="../VIEWS/iniciov2.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="../VIEWS/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/perforaciones.php">Perforaciones</a>
                    </li>
                </ul>
            </div>

            
            <!--LO DE LA BURGER
            
        </nav>

    </div>
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




    <div id="in" class="container">
        <div class="content row">
            <div class="about-text col-lg-6 col-sm-12">
                <h2>Acerca</h2>
                <p>¿Quiénes somos?</p>
                <p>Somos una empresa nacional con siete años de trayectoria en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
                <p>Actualmente, estamos presentes en dos puntos de venta físicos estratégicamente ubicados y contamos con una plataforma de comercio electrónico. Esta plataforma no solo te permite explorar y adquirir nuestros productos desde la comodidad de tu hogar, sino que también ofrece la opción de apartarlos para recogerlos posteriormente en cualquiera de nuestras tiendas físicas. Así, aseguramos una experiencia de compra flexible y conveniente para todos nuestros clientes.</p>
            </div>
            <div class="about-img col-lg-6 col-sm-12"><img src="../IMG/img-inicio.jpg" alt="img descriptiva"></div>
        </div>
        <div class="brands">
            <div class="row">
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Blazy%20Susan"><img src="../IMG/blazy-susann.jpg" alt="blazy-susan"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Raw"><img src="../IMG/raww.jpg" alt="raw"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=OCB"><img src="../IMG/ocbb.jpg" alt="ocb"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Rolling%20Circus"><img src="../IMG/lion-rolling-circuss.jpg" alt="lion-rolling-circus"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Hornet"><img src="../IMG/hornett.jpg" alt="hornet"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Cookies"><img src="../IMG/cookiess.jpg" alt="cookies"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=Blunt%20Wrap"><img src="../IMG/blunt-wrapp.jpg" alt="blunt-wrap"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=King%20Palm"><img src="../IMG/king-palmm.jpg" alt="king-palm"></a></div>
                <div class="brand col-lg-4 col-sm-6"><a href="../SCRIPTS/cdss.php?marca=G-rollz"><img src="../IMG/g-rollzzz.jpg" alt="g-roolz"></a></div>
            </div>
        </div>
        <div class="sucursales" id="suc">
            <h2>Nuestras Sucursales</h2>
            <div class="sucursal row">
                <div class="col-lg-6 col-sm-12">
                    <h3>Sucursal Nazas</h3>
                <p>Blvrd la Libertad 415B, Amp Valles del Nazas, 27083 Torreón, Coah.</p>
                <p>Horario:</p>
                    <p> Lunes a viernes de 10am - 8pm</p>
                    <p>Domingo de 12pm - 5pm</p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <img src="../IMG/s-trc.png" alt="Sucursal Nazas">
                </div>
                <div class="map col-12 col-sm-12">
                    <a href="https://www.google.com.mx/maps/place/La+Sombra+Trc+Smoke+shop/@25.5405521,-103.3611749,17z/data=!3m1!4b1!4m6!3m5!1s0x868fc51a3f557257:0x25ad69b0f36282d9!8m2!3d25.5405473!4d-103.3586!16s%2Fg%2F11q9g5qt61?entry=ttu" target="_blank"><img src="../IMG/maps-trc.png" alt="La Sombra Nazas"></a>
                </div>
            </div>
            <div class="sucursal row">
                <div class="col-lg-6 col-sm-12">
                    <h3>Sucursal Matamoros</h3>
                    <p>C. Lerdo, Vegas de Marrufo Poniente, 27440 Matamoros, Coah.</p>
                    <p>Horario:</p>
                    <p> Lunes a viernes de 12pm - 8pm</p>
                    <p>Domingo de 12pm - 5pm</p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <img src="../IMG/s-mt.jpeg" alt="Sucursal Matamoros">
                </div>
                <div class="map col-12 col-sm-12">
                    <a href="https://www.google.com.mx/maps/place/La+Sombra+matamoros+Smoke+shop/@25.5311862,-103.2340876,17z/data=!3m1!4b1!4m6!3m5!1s0x868fc7dbb1fe0731:0xc83e6cff72866461!8m2!3d25.5311862!4d-103.2315127!16s%2Fg%2F11sbd_9b99?entry=ttu" target="_blank"><img src="../IMG/maps-mt.png" alt="La Sombra Matamoros"></a>
                </div>
            </div>
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
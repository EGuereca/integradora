<?php

include "../SCRIPTS/detalle-usuario.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de cuenta</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/detalle-cuenta.css">
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
                            <button class="btn btn-success">
                                    <a class='nav-link' href='../VIEWS/dash-ventas.php'>PANEL DE ADMINISTRADOR</a>
                                </button>
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


<div class="todo">
    <!-- DATOS DE USUARIO -->
    <div id="data" class="container data">
        <div class="detalles">
            <h1>Detalles</h1>
            <?php if ($user): ?>
                <p><strong>Nombre de usuario :</strong> <?php echo htmlspecialchars($user['nombre_usuario']); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Telefono :</strong> <?php echo htmlspecialchars($user['telefono']); ?></p>
                <br>
                <button class="btn btn-success" id="actu"><a href="updateuser.php?upd=<?=$iduser?>">Actualizar datos</a></button>
                <br><br>
                <a id="actu" class='nav-link' href='../SCRIPTS/cerrarsesion.php'>
                    <button id="cerrar" class="btn btn-danger">Cerrar Sesión</button>
                </a>
            <?php else: ?>
                <p>No se encontraron datos del usuario.</p>
            <?php endif; ?>
        </div>
        <br><br>
        <?php  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == 3) {?>
        <div class="detalles-venta">
            <?php if (isset($_POST['ver_detalles'])): ?>
            <h2>Detalles del Pedido: <?php echo htmlspecialchars($_POST['venta_id']); ?></h2>
                <?php if ($detalles && count($detalles) > 0): ?>
                            <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio del producto</th>
                                    <th>Cantidad de producto</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($detalles as  $detalle): ?>
                            <tr>
                                <td><?php  echo htmlspecialchars($detalle['nombre']); ?> </td>
                                <td><?php echo htmlspecialchars($detalle['precio']); ?></td>
                                <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            </table>
                    
                <?php else: ?>
                    <p>No se encontraron detalles para este pedido.</p>
                <?php endif; ?>
            <?php endif; ?>
</div>

        <!-- PEDIDOS EN ESPERA -->
        <div class="historial">
            <h1>Pedidos pendientes a completar:</h1>
            <?php if ($pendientes && count($pendientes) > 0): ?>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Nombre de la Sucursal</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendientes as $pen): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pen['ID']); ?></td>
                            <td><?php echo htmlspecialchars($pen['fecha_venta']); ?></td>
                            <td><?php echo htmlspecialchars($pen['monto_total']); ?></td>
                            <td><?php echo htmlspecialchars($pen['estado']); ?></td>
                            <td><?php echo htmlspecialchars($pen['sucursal']); ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="venta_id" value="<?php echo $pen['ID']; ?>">
                                    <button type="submit" name="ver_detalles" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver Detalles</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No se encontraron pedidos pendientes a recoger.</p>
            <?php endif; ?>
        </div>

        <!-- PEDIDOS COMPLETADOS -->
        <div class="historial">
            <h1>Historial de pedidos</h1>
            <?php if ($completadas && count($completadas) > 0): ?>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Nombre de la Sucursal</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completadas as $venta): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($venta['ID']); ?></td>
                            <td><?php echo htmlspecialchars($venta['fecha_venta']); ?></td>
                            <td><?php echo htmlspecialchars($venta['monto_total']); ?></td>
                            <td><?php echo htmlspecialchars($venta['estado']); ?></td>
                            <td><?php echo htmlspecialchars($venta['sucursal']); ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="venta_id" value="<?php echo $venta['ID']; ?>">
                                    <button type="submit" name="ver_detalles" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver Detalles</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No se encontraron pedidos completados.</p>
            <?php endif; ?>
        </div>
        <?php    } ?>
    </div>
</div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
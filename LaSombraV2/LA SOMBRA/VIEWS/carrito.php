<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = 0;    
}

if ($_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
elseif ($_SESSION['rol'] != 3) {
    header("location: ../VIEWS/dashboard.php");
    exit();
}


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
    <script src="https://kit.fontawesome.com/49e84e2ffb.js" crossorigin="anonymous"></script>
    
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
                    
                    <?php  if(isset($_SESSION["rol"]) && $_SESSION["rol"] !=3) {?>
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
    <div class="table">
    <table border='1' class= 'table table-striped'>
        <tr>
            <th>IMAGEN</th>
            <th>NOMBRE</th>
            <th>SUBTOTAL</th>
            <th>CANTIDAD</th>
        </tr>
    </table>
    </div>
</div>
<div class="container cart-container">
<?php
        $total = 0;

        
        if (!empty($productos)) {
            foreach ($productos as $row) {
            $subtotal =  ($row['precio'] * $row['cantidad']);
            $total = $total + $subtotal;?>
            
    <div class="row cart-item">
        <div class="col-lg-3 col-sm-12 col">
            <img src="<?php
                if ($row['url']) {
                    echo $row['url'];
                }
                else {
                    echo "../IMG/PRODUCTOS/notfound.png";
                }
            ?>" class="img-fluid" alt="Producto 1">
        </div>
        <div class="cart-item-details col-lg-4 col-sm-12">
            <p><?php echo $row['nombre'] ?></p>
        </div>
        <div class="col-lg-2 col-sm-12">
            <p class="product-price">$ <?php echo $subtotal; ?></p>
        </div>
        <div class="col-md-2">
            <input type="hidden" class="detalle-id" value="<?php echo $row['detalle_venta_id']; ?>">
            <button class="btn-decrementar" data-id="<?php echo $row['detalle_venta_id']; ?>">-</button>
            <input type="number" class="cantidad" id="cantidad-<?php echo $row['detalle_venta_id']; ?>" value="<?php echo $row['cantidad']; ?>" min="1" max="<?php echo $row['stock']; ?>" readonly>
            <?php
                echo "<button class='btn-incrementar' data-id='".$row['detalle_venta_id']."'>+</button>";
            ?>            
        </div>
        <div class="col-md-2">
    <form action="" method="post">
        <input type="hidden" name="dv" value="<?php echo $row['id']; ?>">
        <button type="submit" name="eliminar" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>   
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
            <p>TOTAL: $<?php echo $total; ?></p>
            <form action="" method="post">
            <div class="form-group">
                <?php $control = 0; $prod = "";
                if ($pedidoPendiente == 0) {
                        if (empty($productos)) {
                            echo "<button type='submit' name='btn' class='btn btn-success'  disabled>Confirmar pedido</button>";
                        }
                        else { 
                            foreach ($productos as $row) {
                                if ($row['cantidad'] > $row['stock']) {
                                    $control++;
                                    $prod = $row['nombre'];
                                }
                            }
                            ?>
                            <?php  
                                if ($control == 0) { ?>
                                    <button type="submit" name="btn" id="confirmar" class="btn btn-success">Confirmar pedido</button>                                                                  
                            <?php }
                            else {
                            ?>
                            <button type="button" class="btn btn-success" data-bs-toggle="popover" data-bs-title="ALERTA" data-bs-content="No hay stock suficiente para el producto <?php $row['nombre'] ?>, debe de eliminarlo">Confirmar pedido</button>                              
                    <?php }} 
                    }
                    else{ echo "<p>Tienes un pedido pendiente. Espera a que se confirme antes de hacer un nuevo pedido.</p>"; } ?>
            </div>      
            </form>
        </div>
    </div>
</div>
    <footer class="footer row">
            <div class=" offset-lg-1 col-lg-9 text">
                <p>Somos una empresa nacional con una trayectoria de 7 años en el mercado, especializada en ofrecer de manera responsable una amplia gama de accesorios para fumar, como pipas de cristal, bongs, bubblers y otros productos similares. Nuestro compromiso se refleja en la calidad y variedad de nuestro catálogo, diseñado para satisfacer las necesidades de nuestros clientes más exigentes.</p>
            </div>
            <div class="col-lg-1 rs"><a href="https://www.facebook.com/people/La-Sombra-trc/100072525601731/" target="_blank"><img src="../ICONS/facebookwhite.png" alt="facebook"></a></div>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
/*
$(document).ready(function() {
    $('.btn-incrementar, .btn-decrementar').on('click', function() {
        var detalleVentaId = $(this).siblings('.detalle-id').val();
        var action = $(this).hasClass('btn-incrementar') ? 'incrementar' : 'decrementar';
        var cantidadInput = $('#cantidad-' + detalleVentaId);
        var nuevaCantidad = parseInt(cantidadInput.val());

        if (action === 'incrementar') {
            nuevaCantidad += 1;
        } else if (action === 'decrementar' && nuevaCantidad > 1) {
            nuevaCantidad -= 1;
        }

        // Enviar AJAX
        $.ajax({
            url: '../SCRIPTS/actualizar-stock.php',
            type: 'POST',
            data: { detalleVentaId: detalleVentaId, cantidad: nuevaCantidad },
            success: function(response) {
                cantidadInput.val(nuevaCantidad);
                // Actualiza el subtotal si es necesario
            },
            error: function() {
                alert('Error al actualizar la cantidad. Intenta de nuevo.');
            }
        });
    });
});
*/
$(document).ready(function() {
    $('.btn-incrementar').on('click', function() {
        var detalleVentaId = $(this).siblings('.detalle-id').val();
        var cantidadInput = $('#cantidad-' + detalleVentaId);
        var nuevaCantidad = parseInt(cantidadInput.val()) + 1;

        // Sumar las cantidades actuales
        var totalCantidad = 0;
        $('.cantidad').each(function() {
            totalCantidad += parseInt($(this).val());
        });

        // Verificar si la nueva cantidad total supera 20
        if (totalCantidad + 1 > 20) {
            alert("No puedes agregar más productos. La cantidad total no puede superar 20.");
            return;
        }

        // Enviar AJAX
        $.ajax({
            url: '../SCRIPTS/actualizar-stock.php',
            type: 'POST',
            data: { detalleVentaId: detalleVentaId, cantidad: nuevaCantidad },
            success: function(response) {
                cantidadInput.val(nuevaCantidad);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en AJAX: ", textStatus, errorThrown);
                alert('Error al actualizar la cantidad. Intenta de nuevo.');
            }
        });
    });

    $('.btn-decrementar').on('click', function() {
        var detalleVentaId = $(this).siblings('.detalle-id').val();
        var cantidadInput = $('#cantidad-' + detalleVentaId);
        var nuevaCantidad = parseInt(cantidadInput.val()) - 1;

        if (nuevaCantidad < 1) {
            alert("La cantidad no puede ser menor que 1.");
            return;
        }

        // Enviar AJAX
        $.ajax({
            url: '../SCRIPTS/actualizar-stock.php',
            type: 'POST',
            data: { detalleVentaId: detalleVentaId, cantidad: nuevaCantidad },
            success: function(response) {
                cantidadInput.val(nuevaCantidad);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en AJAX: ", textStatus, errorThrown);
                alert('Error al actualizar la cantidad. Intenta de nuevo.');
            }
        });
    });
});
</script>

</body>
</html>
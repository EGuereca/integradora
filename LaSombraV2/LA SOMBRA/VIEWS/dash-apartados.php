
<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null || $_SESSION["rol"] == 4) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartados</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/dash-apartados.css">
    <script src="https://kit.fontawesome.com/49e84e2ffb.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="d-flex">
    <header>
    <nav id="contenedor-todo" class="navbar  fixed-top">
    <div  class="container">
    <div class="row align-items-center">
    <div class="col-6 col-lg-4 order-2 order-lg-4">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <div class="logo">
                <a href="#in"><img src="../IMG/sombra-logo.png" alt="La Sombra"></a>
                </div>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div  id="body-burger"   class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-ventas.php">VENTAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="background-color: limegreen;" href="#">PEDIDOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dashboard.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-citas.php">CITAS</a>
                    </li>
                    <?php 
                            if ($_SESSION["rol"] == 1 ) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-provee.php">PROVEEDOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dsh-empl.php">REGISTRAR EMPLEADO</a>
                    </li>
                    <li>
                        <a class="nav-link" href="../VIEWS/reabastecimiento.php">REABASTECIMIENTO</a>
                    </li>
                        <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/iniciov2.php">IR A LA PÁGINA PRINCIPAL</a>
                    </li>
                    <div class="usuario-info">
                  <p>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</p>
                   <a href="?logout=1" class="logout-icon">
                    <i class="fas fa-sign-out-alt"></i> 
                     </a>
                      </div>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </nav>
    </header>
        

    <?php 
    $ventas=[];
    $detalles=[];
    include "../SCRIPTS/dsh-apartados.php"
    ?>
       <!-- Main Content -->
<div id="gestion" class="container-fluid">
    <h1 class="mt-5">Gestión de pedidos</h1>
    <form action="" method="post" class="mb-5">
        <div class="form-group">
            <label for="numero_pedido">Número de Pedido:</label>
            <input type="number" name="numero_pedido" id="numero_pedido" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="PENDIENTE">Pendientes</option>
                <option value="COMPLETADA">Completadas</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Buscar</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <?php if ($ventas) { ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Venta</th>
                        <th>Nombre de Usuario</th>
                        <th>Estado</th>
                        <th>Tipo de Venta</th>
                        <th>Monto del pedido</th>
                        <th>Sucursal</th>
                        <?php if ($estado == 'PENDIENTE') { ?>
                            <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) { ?>
                        <tr>
                            <td><?php echo $venta['id_venta'] ?></td>
                            <td><?php echo $venta['nombre_usuario'] ?></td>
                            <td><?php echo $venta['estado'] ?></td>
                            <td><?php echo $venta['tipo_venta'] ?></td>
                            <td><?php echo $venta['monto_total'] ?></td>
                            <td><?php echo $venta['sucursal'] ?></td>
                            <?php if ($estado == 'PENDIENTE') { ?>
                                <td>
                                    <form action="../SCRIPTS/confirmar-pedido.php" method="post">
                                        <input type="hidden" name="id_venta" value="<?php echo $venta['id_venta'] ?>">
                                        <button type="submit" class="btn btn-success">Confirmar pedido</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning">No se encontraron ventas con el estado seleccionado.</div>
        <?php } ?>

        <div class="detalles-venta">
            <h2>Detalles del Pedido:</h2>
            <?php if ($detalles && count($detalles) > 0 && $ventas): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio del producto</th>
                            <th>Cantidad de producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $detalle): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($detalle['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($detalle['precio']); ?></td>
                                <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No se encontraron ventas con el estado seleccionado.</div>
            <?php endif; ?>
        </div>
    <?php } ?>
</div>
    

        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>

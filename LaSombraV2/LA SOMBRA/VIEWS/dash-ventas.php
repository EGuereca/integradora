<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
include '../SCRIPTS/dsh-ventas.php';



$fecha = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/dash-ventas.css">    
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <a class="nav-link" href="../VIEWS/dash-apartados.php">PEDIDOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dashboard.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="background-color: limegreen;" href="#">CITAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-provee.php">PROVEEDOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dsh-empl.php">REGISTRAR EMPLEADO</a>
                    </li>
                    <li>
                        <a class="nav-link" href="../VIEWS/reabastecimiento.php">REABASTECIMIENTO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/iniciov2.php">IR A LA PÁGINA PRINCIPAL</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </nav>
    </header>
    <div class="container-fluid">
            <div class="forms row align-items-center gy-2">
    <!-- Botón "Registrar Venta" -->
    <div class="col-12 col-md-4 col-lg-3">
        <a href="../VIEWS/llenado-venta.php">
            <button type='button' class='btn btn-primary w-100' data-bs-toggle='modal' data-bs-target='#newSaleModal'>Registrar Venta</button>
        </a>
    </div>

    <!-- Formulario de búsqueda por fecha -->
    <div class="col-12 col-md-6 col-lg-6">
        <form action="" method="post" class="d-flex flex-wrap align-items-center">
            <label class="col-auto" for="start">Fecha:</label>
            <input type="date" id="start" name="fecha" min="2024-01-01" max="<?php echo $fecha;?>" class="form-control w-auto" />
            <button type="submit" name="btnfecha" class="btn btn-primary ms-md-2 mt-2 mt-md-0">BUSCAR</button>
        </form>
    </div>

    <!-- Contador de resultados -->
    <div class="col-12 col-md-2 col-lg-3 text-md-end">
        <span class="results-count">Número de resultados: <?php echo $resultCount; ?></span>
    </div>
</div>
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-custom">
                        <div class="card-header">
                            Ventas
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Venta</th>
                                        <th>Total</th>
                                        <th>Empleado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tot = 0;
                                    foreach ($results as $row) {
                                        $empleado = $row['vendedor'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td>$ <?php echo $row['total']; ?></td>
                                        <?php
                                        if ($empleado == null) {
                                            echo '<td>Online</td>';
                                        } else {
                                            echo "<td>$empleado</td>";
                                        }
                                        $tot += $row['total'];
                                        ?>
                                        <td>
                                            <a data-bs-toggle="collapse" href="#<?php echo $row['id'];?>" role="button" aria-expanded="false" aria-controls="collapseExample">Detalles</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom">
                        <div class="card-header">
                            Monto total del día <?php 
                            if (!isset($date)) {
                                echo $fecha;
                            }
                            else{
                            echo $date; }?>
                        </div>
                        <div class="card-body">
                            <h3>$ <?php echo $tot; ?></h3>
                        </div>
                    </div>

                    <?php 
                    foreach ($results as $row) {
                        $id_v = $row['id'];
                        $pr = $conexion->prepare("SELECT dv.cantidad AS cantidad, p.nombre AS nombre, (p.precio * dv.cantidad) AS subtotal
                                            FROM detalle_venta AS dv
                                            JOIN productos AS p ON dv.producto = p.id_producto
                                            WHERE dv.venta = :id");
                        $pr->bindParam(':id', $id_v, PDO::PARAM_INT);    
                        $pr->execute();
                        
                        $ciclo = $pr->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="collapse" id="<?php echo $row['id'];?>">
                        <div class="card card-body">
                            <div class="card card-custom">
                                <div class="card-header"><?php echo $row['id'];?></div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Productos</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($ciclo as $row) {                                                                                    
                                            ?>
                                            <tr>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['cantidad']; ?></td>
                                                <td>$ <?php echo $row['subtotal']; ?></td>
                                            </tr>
                                            <?php } ?>                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>         
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Nueva Venta 
<div id="newSaleModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                    <div class="d-flex flex-wrap mb-3">
                        <input type="text" id="searchProduct" class="form-control mb-3" placeholder="Nombre o código">
                        <select id="categorySelect" class="form-control mb-3">
                            <option value="">Categoría</option>
                            <option value="categoria1">Categoría 1</option>
                            <option value="categoria2">Categoría 2</option>
                        </select>
                    </div>   
                        <div class="row" id="productList">
                            <?php
                                #foreach ($c as $row) {                                                                    
                            ?>
                            <div class="col-md-4">
                                <div class="card product-card">
                                    <?php 
                                 #       if ($row['url'] == null) { 
                                  #          echo "<img src='../IMG/sombra-logo.jpg' class='card-img-top' alt='Nombre del Producto'>";                                           
                                    #    }
                                   #     else {
                                      #      echo "<img src=".$row['url']." class='card-img-top' alt=".$row['nombre'].">";
                                     #   }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php #echo $row['nombre']; ?></h5>
                                        <p class="card-text"><?php #echo $row['stock']; ?> piezas disponibles</p>
                                        <p class="card-text text-success">$<?php #echo $row['precio']; ?></p>
                                        <select class="form-control" name="cantidad">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-add-to-cart" >Añadir</button>
                                </div>
                            </div>
                            <?php #} ?>/
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summary">
                            <div class="card-body">
                                <ul class="list-group list-group-flush" id="cartItems">
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Blazy Susan Pink Rolling
                                        <span class="badge badge-primary badge-pill">1</span>
                                        <span>$90.00</span>
                                    </li>
                            
                                </ul>
                                <div class="d-flex justify-content-between mt-3">
                                    <strong>Total</strong>
                                    <strong>$270.00</strong>
                                </div>
                                <button class="btn btn-success btn-block mt-3">Confirmar pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('newSaleBtn').addEventListener('click', function () {
        $('#newSaleModal').modal('show');
    });
</script>
</body>
</html>

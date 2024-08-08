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
    <link rel="stylesheet" href="../CSS/ventas-dash.css">    
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</head>
<body>
<div class="d-flex">
    <div class="sidebar">
        <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
        <?php 
            
            switch ($_SESSION['rol']) {
                case 1:
                    echo "<h5>Usuario: Administrador</h5>";
                    break;
                case 3:
                    "<h5>Usuario: Empleado</h5>";
                    break;
                    case 7:
                        "<h5>Usuario: Perforador</h5>";
                        break;
                default:
                    break;
            }

            ?>
        <a style="background-color: limegreen;" href="../VIEWS/dash-ventas.php">Ventas</a>
        <a href="../VIEWS/dash-apartados.php">Apartados</a>
        <a href="../VIEWS/dashboard.php">Productos</a>
        <a href="../VIEWS/dash-citas.php">Citas</a>
        <a href="../VIEWS/dash-provee.php">Proveedor</a>
        <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>
        <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
    </div>
    <div class="main-container flex-grow-1">
        <header class="header d-flex justify-content-between align-items-center w-100">
            <div>
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#newSaleModal'>Registrar Venta</button>
                <form action="" method="post" class="d-inline-block">
                    <label for="start">Fecha:</label>
                    <input type="date" id="start" name="fecha" max="<?php echo $fecha;?>" class="form-control d-inline-block w-auto" />
                    <button type="submit" name="btnfecha" class="btn btn-primary d-inline-block">BUSCAR</button>
                </form>
                <span class="results-count">Número de resultados: <?php echo $resultCount; ?></span>
            </div>
        </header>
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
                            Monto total del día <?php echo $fecha; ?>
                        </div>
                        <div class="card-body">
                            <h3>$ <?php echo $tot; ?></h3>
                        </div>
                    </div>

                    <?php 
                    foreach ($results as $row) {
                        $id_v = $row['id'];
                        $pr = $pdo->prepare("SELECT dv.cantidad AS cantidad, p.nombre AS nombre, (p.precio * dv.cantidad) AS subtotal
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

<!-- Modal para Nueva Venta -->
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
                            
                            <div class="col-md-4">
                                <div class="card product-card">
                                    <img src="../IMG/bicho.jpg" class="card-img-top" alt="Nombre del Producto">
                                    <div class="card-body">
                                        <h5 class="card-title">Blazy Susan Pink Rolling Papers</h5>
                                        <p class="card-text">18 piezas disponibles</p>
                                        <p class="card-text text-success">$49.00</p>
                                    </div>
                                    <button class="btn btn-primary btn-add-to-cart">Añadir</button>
                                </div>
                            </div>
                            
                           
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('newSaleBtn').addEventListener('click', function () {
        $('#newSaleModal').modal('show');
    });
</script>
</body>
</html>

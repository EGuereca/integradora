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
</head>
<body>
<div class="d-flex">
        <div class="sidebar">
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a style="background-color: limegreen;" href="#">Ventas</a>
            <a href="#">Apartados</a>
            <a href="../VIEWS/dashboard.php">Productos</a>
            <a href="../VIEWS/dash-citas.php">Citas</a>
            <a href="../VIEWS/dash-provee.php">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>
        <div class="content flex-grow-1">
            <div class="header">
                <div>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' 
                        data-bs-target='#exampleModal'> Registrar Venta </button>
                    <form action="" method="post">
                        <label for="start">Fecha:</label>
                        <input type="date" id="start" name="fecha"  max="<?php echo $fecha;?>" />
                        <button type="submit" name="btnfecha" class="btn btn-primary">BUSCAR</button>     
                    </form>
                </div>
            </div>
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
                                        <th>     </th>
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
                                        if ($empleado  == null) {
                                            echo '<td>Online</td>';
                                        }
                                        else {
                                            echo "<td>$empleado</td>";
                                        }
                                        $tot = $tot + $row['total'];
                                        ?>
                                        <td>
                                            <p class="d-inline-flex gap-1">
                                                <a  data-bs-toggle="collapse" href="#<?php echo $row['id'];?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    Detalles
                                                </a>
                                            </p>
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
                            Monto total del día <?php echo $date; ?>
                        </div>
                        <div class="card-body">
                            <h3>$ <?php echo $tot; ?></h3>
                        </div>
                    </div>

                    <?php 
                        foreach ($results as $row) {  
                        $id_v = $row['id']; 
                        $pr = $pdo->prepare("SELECT dv.cantidad AS cantidad, p.nombre AS nombre,
                            (p.precio * dv.cantidad) AS subtotal
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
                        <div class="card-header">
                        <?php echo $row['id'];?>
                        </div>
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
                                    <tr>
                                    <?php 
                                        foreach ($ciclo as $row) {                                                                                    
                                    ?>
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

                           <!-- MODAL PARA REGISTRAR VENTA, AÚN NO JALA -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
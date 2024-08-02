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
<script>
            function detalles() {
            var selectedOption = document.querySelector('input[name="contact"]:checked').value;
            var additionalInput = document.getElementById("otra_marca");

            if (selectedOption === "otro") {
                additionalInput.style.display = "block";
            } else {
                additionalInput.style.display = "none";
            }
          }
</script>
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
                                        <td><input type="radio" name="option" value="yes" > Detalles</td>
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
                    <div class="card card-custom">
                        <div class="card-header">
                            00001
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
                                        <td>00001</td>
                                        <td>2</td>
                                        <td>$40.36</td>
                                    </tr>
                                    <tr>
                                        <td>00011</td>
                                        <td>1</td>
                                        <td>$10.40</td>
                                    </tr>
                                    <tr>
                                        <td>00101</td>
                                        <td>1</td>
                                        <td>$49.36</td>
                                    </tr>
                                    <tr>
                                        <td>00101</td>
                                        <td>1</td>
                                        <td>$49.36</td>
                                    </tr>
                                    <tr>
                                        <td>00101</td>
                                        <td>1</td>
                                        <td>$49.36</td>
                                    </tr>
                                    <tr>
                                        <td>00101</td>
                                        <td>1</td>
                                        <td>$49.36</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                           <!-- MODAL PARA REGISTRAR VENTA, AÚN NO JALA -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">RESGISTRAR VENTA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                ...
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartados</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/ventas-dash.css">
</head>
<body>
<div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a href="../VIEWS/dash-ventas.php">Ventas</a>
            <a style="background-color: limegreen;" href="#">Apartados</a>
            <a href="../VIEWS/dashboard.php">Productos</a>
            <a href="../VIEWS/dash-citas.php">Citas</a>
            <a href="../VIEWS/dash-provee.php">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>
        <!-- Main Content -->
        
        <div class="container-fluid flex-grow-1">
        <header class="header d-flex justify-content-between align-items-center w-100">
            <div>
            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#newSaleModal'>Registrar Apartado</button>
                <form action="" method="post" class="d-inline-block">
                    <label for="id_apartado" class="me-2">ID o Nombre:</label>
                    <input type="text" id="id_apartado" name="id_apartado" class="form-control d-inline-block w-auto me-2" placeholder="ID Apartado o Nombre" />

                    <label for="start" class="me-2">Fecha:</label>
                    <input type="date" id="start" name="fecha" max="<?php echo $fecha;?>" class="form-control d-inline-block w-auto me-2" />

                    <label for="sucursal" class="me-2">Sucursal:</label>
                    <select id="sucursal" name="sucursal" class="form-control d-inline-block w-auto me-2">
                        <option value="">Selecciona Sucursal</option>
                        <option value="sucursal1">Sucursal 1</option>
                        <option value="sucursal2">Sucursal 2</option>
                        <option value="sucursal3">Sucursal 3</option>
                    </select>

                    <button type="submit" name="btnbuscar" class="btn btn-primary d-inline-block">BUSCAR</button>
                </form>
                <span class="results-count">Número de resultados: <?php echo $resultCount; ?></span>
            </div>
        </header>
                    <div class="card card-custom">
                        <div class="card-header">
                           <h3>Apartados</h3> 
                        </div>
                        <div class="card-body">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>ID Apartado</th>
                            <th>Username</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Sucursal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-warning">Pendiente</td>
                            <td>00001</td>
                            <td>juanito</td>
                            <td>$100.80</td>
                            <td>02/09/2024</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td class="text-danger">Cancelado</td>
                            <td>00001</td>
                            <td>pablito</td>
                            <td>$100.80</td>
                            <td>02/09/2024</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td class="text-success">Entregado</td>
                            <td>00001</td>
                            <td>pepe</td>
                            <td>$100.80</td>
                            <td>02/09/2024</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td class="text-success">Entregado</td>
                            <td>00001</td>
                            <td>chuyito</td>
                            <td>$100.80</td>
                            <td>02/09/2024</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
</body>
</html>

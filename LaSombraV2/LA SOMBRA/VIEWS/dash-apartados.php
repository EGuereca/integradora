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
                        <a class="nav-link" style="background-color: limegreen;" href="#">APARTADOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dashboard.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-citas.php">CITAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-provee.php">PROVEEDOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dsh-empl.php">REGISTRAR EMPLEADO</a>
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
        <!-- Sidebar
        <div class="sidebar">
        <img src="../IMG/sombra-logo.png" alt="La Sombra Logo" class="img-fluid mb-4">
        <a href="../VIEWS/dash-ventas.php">Ventas</a>
        <a style="background-color: limegreen;" href="#">Apartados</a>
        <a href="../VIEWS/dashboard.php">Productos</a>
        <a href="../VIEWS/dash-citas.php">Citas</a>
        <a href="../VIEWS/dash-provee.php">Proveedor</a>
        <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>
        <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>-->
        <!-- Main Content -->
        <div class="container-fluid">
                    <div class="card card-custom row">
                        <div class="card-header">
                           <h3>Apartados</h3> 
                        </div>
                        <div class="card-body">
                <table class="table">
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
        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>

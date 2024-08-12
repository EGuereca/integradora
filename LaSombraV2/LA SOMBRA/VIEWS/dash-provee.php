<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
include '../SCRIPTS/provee-dsh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Proveedor</title>
    <link rel="stylesheet" href="../CSS/dash-provee.css">
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
                        <a class="nav-link" href="../VIEWS/dash-apartados.php">APARTADOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dashboard.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dash-citas.php">CITAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="background-color: limegreen;" href="#">PROVEEDOR</a>
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
  <!--
<div class="sidebar">
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a href="../VIEWS/dash-ventas.php">Ventas</a>
            <a href="../VIEWS/dash-apartados.php">Apartados</a>
            <a href="../VIEWS/productos.php">Productos</a>
            <a href="../VIEWS/dash-citas.php">Citas</a>
            <a style="background-color: limegreen;" href="#">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>-->
        <div class="container-fluid">
  <?php 
    if ($_SESSION["rol"] == 1 ) { ?>
        <div class="botonprinci">
            <button id="botonprinci" type='button' class='btn' data-bs-toggle='modal' 
            data-bs-target='#exampleModal'> Registrar Proveedor </button>
        </div>
        
    <?php }
  ?>    
    <?php 
        if ($results) {
            $telefono = ""; $pagina = "";
            echo "<h2>Proveedores:</h2>";
            echo "<div class='tabla'><table border='1' class='table table-striped'>
                <tr>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>PAGINA</th>
                </tr>";
                foreach ($results as $row) {
                    if ($row['telefono'] == null) { $telefono = "-";} else{ $telefono = $row['telefono'];}
                    if ($row['pagina'] == null) { $pagina = "-";} else{ $pagina = $row['pagina'];}
                        echo "<tr>                            
                            <td>" . htmlspecialchars($row["nombre"]) . "</td>
                            <td>" . htmlspecialchars($telefono) . "</td>
                            <td>" . htmlspecialchars($pagina) . "</td>
                            </tr>";                    
        }
        echo "</table></div>";
    }
    else {
        echo "NO SE ENCONTRARON PROVEEDORES";
    }
    ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de un proveedor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <label for="nombre">Ingrese el nombre del proveedor:</label>
        <input type="text" class="form-control" name="nombre" id="nombre"> <br>        
        <label for="nombre">Ingrese el número telefonico del proveedor:</label>
        <input type="tel" class="form-control" id="phone" name="telefono"/> <br>
        <label for="url">Ingrese la pagína del proveedor:</label>
        <input type="url" class="form-control" name="url" id="url">
        <div class="boton">
            <button id="botonregis" type="submit" name="btnreg" class="btn btn-primary">Registrar Proveedor</button>
        </div>
                
        </form>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>
</div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
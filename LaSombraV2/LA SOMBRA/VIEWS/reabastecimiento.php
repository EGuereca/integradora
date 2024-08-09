<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
include '../SCRIPTS/dsh-reabas.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Productos</title>
    <link rel="stylesheet" href="../css/dashboard.css">
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
                        <a class="nav-link" href="../VIEWS/dash-provee.php">PROVEEDOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../VIEWS/dsh-empl.php">REGISTRAR EMPLEADO</a>
                    </li>
                    <li>
                      <a class="nav-link" style="background-color: limegreen;" href="#">REABASTECIMIENTO</a>
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
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a href="../VIEWS/dash-ventas.php">Ventas</a>
            <a href="../VIEWS/dash-apartados.php">Apartados</a>
            <a href="../VIEWS/dashboard.php">Productos</a>
            <a href="../VIEWS/dash-citas.php">Citas</a>
            <a href="../VIEWS/dash-provee.php">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>
            <a style="background-color: limegreen;" href="#">Reabastecimiento</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>-->
        <div class="container-fluid">
<nav class="navbar bg-body-tertiary">
    <?php
    if ($_SESSION['rol'] == 1) {          
      echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' 
        data-bs-target='#exampleModal'> Registrar </button>";
    }
    ?>
</nav>
<br>
<?php
    if ($or) {
        echo "<h2>Resultados de búsqueda:</h2>";
        echo "<table border='1' class= 'table table-striped'>
                <tr>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>FECHA</th>
                    <th>MONTO</th>
                    <th>SUCURSAL</th>
                </tr>";
        foreach ($or as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["producto"]) . "</td>
                    <td>" . htmlspecialchars($row["cantidad"]) . "</td>
                    <td>" . htmlspecialchars($row["fecha"]) . "</td>
                    <td>$" . htmlspecialchars($row["monto"]) . "</td>
                    <td>" . htmlspecialchars($row["sucursal"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron productos.</p>";
    }
?>


<!--  MODAL  
<form action="../SCRIPTS/productos-dsh.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group">
                        <label for="username">Nombre del Producto:</label><br>
                        <input type="text" id="nombre" placeholder="Ingresa el nombre del producto" name="nombre">
                    </div>                   

                    <fieldset>
                      <legend>MARCA:</legend>
                      <div>
                        <input type="radio" id="contactChoice1" name="contact" value="Raw" onclick="toggleInput()"/>
                        <label for="contactChoice1">Raw</label>

                        <input type="radio" id="contactChoice2" name="contact" value="Blazy Susan" onclick="toggleInput()"/>
                        <label for="contactChoice2">Blazy Susan</label>

                        <input type="radio" id="contactChoice3" name="contact" value="Rolling Circus" onclick="toggleInput()"/>
                        <label for="contactChoice3">Rolling Circus</label>

                        <input type="radio" id="contactChoice3" name="contact" value="OCB" onclick="toggleInput()"/>
                        <label for="contactChoice3">OCB</label>

                        <input type="radio" id="contactChoice3" name="contact" value="Kush" onclick="toggleInput()"/>
                        <label for="contactChoice3">Kush</label>

                        <input type="radio" id="contactChoice3" name="contact" value="Blunt Wrap" onclick="toggleInput()"/>
                        <label for="contactChoice3">Blunt Wrap</label>

                        <input type="radio" id="contactChoice3" name="contact" value="EYCE" onclick="toggleInput()"/>
                        <label for="contactChoice3">EYCE</label>

                        <input type="radio" id="contactChoice3" name="contact" value="otro" onclick="toggleInput()"/>
                        <label for="contactChoice3">OTRO</label>
                      </div>                
                    </fieldset>

                    <div id="otra_marca" style="display:none;">
                      <label for="extra">Ingrese el Nombre de la Marca:</label>
                      <input type="text" id="extra" name="extra">
                    </div>
                  
                    <fieldset>
                    <legend>Categoria(s)</legend>
                    <?php 
                    #foreach ($cat as $row) { ?>
                      <div>
                        <input type="checkbox" id="coding" name="cate[]" value="<?php # echo $row['id'];?>" />
                        <label for="coding"><?php # echo $row['nombre'];?></label>
                      </div>
                        <?php # } ?>
                    </fieldset>

                    <fieldset>
                    <legend>Proveedor(es)</legend>
                    <p>(EL PRECIO DE COMPRA SE REGISTRA, DESDE EL REABASTECIMIENTO)</p>
                    <?php 
                    #foreach ($prov as $row) { ?>
                      <div>
                        <input type="checkbox" id="<?php #  echo $row['id']; ?>" name="proveedores[]" value="<?php # echo $row['id'];?>" />
                        <label for="coding"><?php # echo $row['nombre'];?></label>
                      </div>
                     <?php # } ?>
                    </fieldset>

                    <div class="form-group">
                        <label for="precio">Precio al publico:</label><br>
                        <input type="text" id="nombre" placeholder="Ingresa el nombre del producto" name="precio">
                    </div>

                    <fieldset>
                      <legend>MATERIAL:</legend>
                      <div>
                        <input type="radio" id="mt1" name="material" value="ceramica"/>
                        <label for="contactChoice1">Ceramica</label>

                        <input type="radio" id="mt22" name="material" value="metal"/>
                        <label for="contactChoice2">Metal</label>

                        <input type="radio" id="mt3" name="material" value="plastico"/>
                        <label for="contactChoice3">Plastico</label>

                        <input type="radio" id="mt4" name="material" value="cristal"/>
                        <label for="contactChoice3">Cristal</label>

                        <input type="radio" id="mt5" name="material" value="madera"/>
                        <label for="contactChoice3">Madera</label> 
                        
                        <input type="radio" id="mt4" name="material" value="otro"/>
                        <label for="contactChoice3">Otro</label>
                      </div>                
                    </fieldset>

                    <label for="avatar">Seleccione una imagen del producto:</label>
                    <input type="file" id="img" name="img" required/>
                      
                    <legend>DESCRIPCIÓN:</legend>
                    <textarea name="desc" class="form-control" rows="5"></textarea><br><br>
                </div> 
                <button type="submit" name="btnreg" class="btn btn-primary">Registrar</button>     
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>

 -->

</div>
</div>
</body>
</html>
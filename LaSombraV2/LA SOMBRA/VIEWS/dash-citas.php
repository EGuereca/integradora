<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
include '../SCRIPTS/dsh-citas.php';

$hoy = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>CITAS</title>
    <link rel="stylesheet" href="../CSS/dash-citas.css">
</head>
<body>

<script>
    function toggleInput() {
            var selectedOption = document.querySelector('input[name="perfo"]:checked').value;
            var additionalInput = document.getElementById("otro");

            if (selectedOption === "otro") {
                additionalInput.style.display = "block";
            } else {
                additionalInput.style.display = "none";
            }
          }
</script>
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
                        <a class="nav-link" style="background-color: limegreen;" href="#">CITAS</a>
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
  <!--
  <div class="sidebar">
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a href="../VIEWS/dash-ventas.php">Ventas</a>
            <a href="../VIEWS/dash-apartados.php">Apartados</a>
            <a href="../VIEWS/dashboard.php">Productos</a>
            <a style="background-color: limegreen;" href="#">Citas</a>
            <a href="../VIEWS/dash-provee.php">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>
        -->
  <div class="container-fluid">
    <form method="post" class="d-flex" role="search">
      <div class="col-lg-3">
      <input type="date" id="start" name="fecha" value="" min="2024-01-01" max="<?php echo $hoy;?>" />     
      </div>
      <div class="col-lg-3">
        <select class="form-select" aria-label="Default select example" name="perforador">
            <option selected value="">Perforador</option>
            <?php 
                foreach ($pe as $row) {
                    echo "<option value=".$row['id'].">".$row['perforadores']."</option>";
                }
            ?>
            
        </select>
        </div>
        <div class="col-lg-3">
        <select class="form-select" aria-label="Default select example" name="sucursal">
            <option selected value="">Sucursal</option>
            <option value="">Todo</option>
            <option value="2">Nazas</option>
            <option value="1">Matamoros</option>
        </select>
        </div>
        <div class="col-lg-3">
      <button class="btn btn-outline-success" type="submit" name="btn-aplicar">Aplicar</button>
      </div>
    </form>

    <button type="button" class="btn btn-primary offset-4 col-4" data-bs-toggle="modal" 
    data-bs-target="#exampleModal"> Registrar Cita </button>
    <!-- Main Content -->
                <?php
$fecha = date('Y-m-d H:i:s');
$f = new DateTime();
$max_fecha = clone $f;
$max_fecha->modify('+2 month');
$fecha_max = $max_fecha->format('Y-m-d\TH:i');
$fecha_min = $f->format('Y-m-d\TH:i');

    if ($results) {
        echo "<h2>Resultados de búsqueda:</h2>";
        echo "<table border='1' class= 'table table-striped'>
                <tr>
                    <th>ESTADO</th>
                    <th>Perforador</th>
                    <th>Cliente</th>
                    <th>Perforación</th>
                    <th>Fecha y Hora</th>
                    <th>Sucursal</th>
                    <th>Telefono</th>
                </tr>";
        foreach ($results as $row) {
            if ($fecha <= $row['fecha']) {
                echo "<tr>
                    <td>PENDIENTE</td>
                    <td>" . htmlspecialchars($row["perforador"]) . "</td>
                    <td>" . htmlspecialchars($row["cliente"]) . "</td>
                    <td>" . htmlspecialchars($row["perforacion"]) . "</td>
                    <td>" . htmlspecialchars($row["fecha"]) . "</td>
                    <td>" . htmlspecialchars($row["sucursal"]) . "</td>
                    <td>" . htmlspecialchars($row["telefono"]) . "</td>
                  </tr>";
            }
            else {
                echo "<tr>
                <td>COMPLETADA</td>
                <td>" . htmlspecialchars($row["perforador"]) . "</td>
                <td>" . htmlspecialchars($row["cliente"]) . "</td>
                <td>" . htmlspecialchars($row["perforacion"]) . "</td>
                <td>" . htmlspecialchars($row["fecha"]) . "</td>
                <td>" . htmlspecialchars($row["sucursal"]) . "</td>
                <td>" . htmlspecialchars($row["telefono"]) . "</td>
              </tr>";
            }            
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron citas.</p>";
    }
?>
            </div>
            
  </div>




<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro Citas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <label for="nombre">Ingrese el nombre del cliente</label>
        <input type="text" name="nombre" id="nombre"> <br>
        <label for="costo">Ingrese el costo</label>
        <input type="text" name="costo" id="costo"> <br>
        <label for="nombre">Ingrese el número telefonico del cliente</label>
        <input type="tel" id="phone" name="telefono"/> <br>
        <label for="nombre">Seleccione un perforador</label>
        <select class="form-select" aria-label="Default select example" name="empleado">
            <option selected value="">Perforador</option>
            <?php 
                foreach ($pe as $row) {
                    echo "<option value=".$row['id'].">".$row['perforadores']."</option>";
                }
            ?>            
        </select> <br>
        <div class="tipo-perforacion">
        <fieldset>
            <legend>Tipo de perforación:</legend>
                <div>
                    <input type="radio" id="perfo1" name="perfo" value="Ceja" onclick="toggleInput()"/>
                    <label for="contactChoice1">Ceja</label>

                    <input type="radio" id="perfo2" name="perfo" value="Nostril" onclick="toggleInput()"/>
                    <label for="contactChoice2">Nostril</label>
                    
                    <input type="radio" id="perfo3" name="perfo" value="Septum" onclick="toggleInput()"/>
                    <label for="contactChoice2">Septum</label>

                    <input type="radio" id="perfo4" name="perfo" value="Ombligo" onclick="toggleInput()"/>
                    <label for="contactChoice2">Ombligo</label>

                    <input type="radio" id="perfo5" name="perfo" value="Oreja" onclick="toggleInput()"/>
                    <label for="contactChoice2">Oreja</label>

                    <input type="radio" id="perfo5" name="perfo" value="otro" onclick="toggleInput()"/>
                    <label for="contactChoice2">Otro</label>
                </div>
        </fieldset>
        </div>

                    <div id="otro" style="display:none;">
                      <label for="extra">Ingrese el tipo de perforación:</label>
                      <input type="text" id="extra" name="extra">
                    </div>
                    <select class="form-select" aria-label="Default select example" name="sucursal">
                        <option selected value="">Sucursal</option>
                        <option value="2">Nazas</option>
                        <option value="1">Matamoros</option>
                    </select>

                    <label for="meeting-time">Seleccione la fecha y hora:</label>

                    <input type="datetime-local" id="meeting-time" name="datetime" value="" min="<?php echo $fecha_min; ?>" max="<?php echo $fecha_max; ?>" />
                    <legend>Comentarios:</legend>
                    <textarea name="coments" class="form-control" rows="5"></textarea><br><br>

                <button type="submit" name="btnreg" class="btn btn-primary">Registrar Cita</button>
        </form>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
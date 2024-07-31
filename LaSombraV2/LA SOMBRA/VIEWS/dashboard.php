<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}
include '../SCRIPTS/productos-dsh.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Productos</title>
</head>

<script>
        function toggleInput() {
            var selectedOption = document.querySelector('input[name="contact"]:checked').value;
            var additionalInput = document.getElementById("otra_marca");

            if (selectedOption === "otro") {
                additionalInput.style.display = "block";
            } else {
                additionalInput.style.display = "none";
            }
          }





          <?php 
            foreach ($prov as $row) {
              ?>  

          function toggleCheck(checkid) {
            var checkbox = document.getElementById(checkid);
            var additionalInput = document.getElementById("prc");                    
            if (checkbox.checked) {
                additionalInput.style.display = "block";
            } else {
                additionalInput.style.display = "none";
            }                     
        } 
        <?php
            }
            ?>            
    </script>

<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <form method="post" class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="ID Producto" aria-label="Search" id="id_prod" name="id_prod">
      <input class="form-control me-2" type="search" placeholder="Nombre Producto" aria-label="Search" id="nm_prod" name="nm_prod">
        <select class="form-select" aria-label="Default select example" name="categoria">
            <option selected value="">Categoria</option>
            <option value="1">Pipas</option>
            <option value="2">Bongs</option>
            <option value="3">Canalas</option>
            <option value="4">Hitters</option>
            <option value="5">Electronicos</option>
            <option value="6">Ropa</option>            
            <option value="8">Blunts</option>            
            <option value="7">Accesorios</option>
        </select>
        <select class="form-select" aria-label="Default select example" name="sucursal">
            <option selected value="">Sucursal</option>
            <option value="3">Todo</option>
            <option value="2">Nazas</option>
            <option value="1">Matamoros</option>
        </select>
      <button class="btn btn-outline-success" type="submit" name="btn-aplicar">Aplicar</button>
    </form>
    <?php
    if ($_SESSION['rol'] == 1) {          
      echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' 
        data-bs-target='#exampleModal'> Registrar Producto </button>";
    }
    ?>
  </div>
</nav>
<br>
<?php
    if ($results) {
        echo "<h2>Resultados de búsqueda:</h2>";
        echo "<table border='1' class= 'table table-striped'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                </tr>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["id_producto"]) . "</td>
                    <td>" . htmlspecialchars($row["nombre"]) . "</td>
                    <td>" . htmlspecialchars($row["stock"]) . "</td>
                    <td>" . htmlspecialchars($row["precio"]) . "</td>
                    <td>" . htmlspecialchars($row["categoria"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron productos.</p>";
    }
?>

<form action="" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Empleados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post">
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
                    <legend>Proveedor(es)</legend>
                    <?php 
                    foreach ($prov as $row) { ?>
                      <div>
                        <input type="checkbox" id="<?php echo $row['id']; ?>" name="proveedores" value="<?php echo $row['id'];?>" onclick="toggleCheck('<?php echo $row['id']; ?>')" />
                        <label for="coding"><?php echo $row['nombre'];?></label>
                      </div>
                      <div id="prc" style="display:none;">
                       <label for="extra">Precio de compra:</label>
                       <input type="text" id="extra" name="extra">
                      </div>
                     <?php } ?>
                    </fieldset>

                    <fieldset>
                    <legend>Categoria(s)</legend>
                    <?php 
                    foreach ($cat as $row) { ?>
                      <div>
                        <input type="checkbox" id="coding" name="interest" value="<?php echo $row['id'];?>" />
                        <label for="coding"><?php echo $row['nombre'];?></label>
                      </div>
                        <?php } ?>
                    </fieldset>
                    <div class="form-group">
                        <label for="precio">Precio al publico:</label><br>
                        <input type="text" id="nombre" placeholder="Ingresa el nombre del producto" name="nombre">
                    </div>
                </div> 
                <button type="submit" name="btncrearemp" class="btn btn-primary">Registrar</button>     
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>
</body>
</html>
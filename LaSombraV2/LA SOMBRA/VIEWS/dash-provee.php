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
    <title>Document</title>
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <?php 
    if ($_SESSION["rol"] == 1 ) {
        echo "<button type='button' class='btn btn-outline-success' data-bs-toggle='modal' 
    data-bs-target='#exampleModal'> Registrar Producto </button>";
    }
  ?>    

  </div>
</nav>
    <?php 
        if ($results) {
            $telefono = ""; $pagina = "";
            echo "<h2>Resultados de búsqueda:</h2>";
            echo "<table border='1' class='table table-striped'>
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
    }
    else {
        echo "NO SE ENCONTRARON PROVEEDORES";
    }
    ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro Citas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <label for="nombre">Ingrese el nombre del proveedor</label>
        <input type="text" name="nombre" id="nombre"> <br>        
        <label for="nombre">Ingrese el número telefonico del proveedor</label>
        <input type="tel" id="phone" name="telefono"/> <br>
        <label for="url">Ingrese la pagína del proveedor</label>
        <input type="url" name="url" id="url">
                <button type="submit" name="btnreg" class="btn btn-primary">Registrar Proveedor</button>
        </form>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
</body>
</html>
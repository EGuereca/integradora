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
    <title>Productos</title>
</head>
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

</body>
</html>
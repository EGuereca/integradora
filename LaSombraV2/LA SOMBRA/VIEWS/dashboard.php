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
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <script src="https://kit.fontawesome.com/49e84e2ffb.js" crossorigin="anonymous"></script>
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

          function validarTamanioArchivo(input) {
            const maxSize = 2 * 1024 * 1024; // 2 MB en bytes
            const file = input.files[0];

            if (file.size > maxSize) {
                alert("El archivo es demasiado grande. El tamaño máximo permitido es de 2 MB.");
                input.value = ''; 
            }
        }

    </script>

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
                        <a class="nav-link"  href="../VIEWS/dash-apartados.php">PEDIDOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="background-color: limegreen;" href="#">PRODUCTOS</a>
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
  <!-- Sidebar
  <div class="sidebar">
            <img src="../IMG/sombra-logo.jpg" alt="La Sombra Logo" class="img-fluid mb-4">
            <a href="../VIEWS/dash-ventas.php">Ventas</a>
            <a href="../VIEWS/dash-apartados.php">Apartados</a>
            <a style="background-color: limegreen;" href="#">Productos</a>
            <a href="../VIEWS/dash-citas.php">Citas</a>
            <a href="../VIEWS/dash-provee.php">Proveedor</a>
            <a href="../VIEWS/dsh-empl.php">Registrar empleado</a>

            <a href="../VIEWS/iniciov2.php">Ir a la pagina principal</a>
        </div>-->
        <div class="container-fluid">
    <div class="forms">
        <form method="post" class="row g-3">
            <div class="col-lg-2 col-md-4 col-sm-6">
                <input class="form-control" type="search" placeholder="ID Producto" aria-label="Search" id="id_prod" name="id_prod">
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <input class="form-control" type="search" placeholder="Nombre Producto" aria-label="Search" id="nm_prod" name="nm_prod">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <select class="form-select" aria-label="Default select example" name="categoria">
                    <option selected value="">Categoria</option>
                    <option value="1">Pipas</option>
                    <option value="2">Bongs</option>
                    <!-- Agrega el resto de opciones aquí -->
                </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <select class="form-select" aria-label="Default select example" name="sucursal">
                    <option selected value="">Sucursal</option>
                    <option value="3">Todo</option>
                    <option value="2">Nazas</option>
                    <option value="1">Matamoros</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12">
                <button id="regprod" class="btn btn-primary w-100" type="submit" name="btn-aplicar">Aplicar</button>
            </div>
        </form>
        
        <?php if ($_SESSION['rol'] == 1) { ?>
            <div class="row mt-3">
                <div class="col-12">
                    <button id="regprod" type='button' class='btn btn-success w-100' data-bs-toggle='modal' data-bs-target='#exampleModal'>Registrar Producto</button>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <br>

    <?php if ($results) { ?>
        <h2>Resultados de búsqueda:</h2>
        <div class="table-responsive">
            <table class='table border='1' class='table table-striped'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id_producto"]); ?></td>
                            <td><?= htmlspecialchars($row["nombre"]); ?></td>
                            <td><?= htmlspecialchars($row["stock"]); ?></td>
                            <td><?= htmlspecialchars($row["precio"]); ?></td>
                            <td><?= htmlspecialchars($row["categoria"]); ?></td>
                            <td>
                                <a href='modificar.producto.php?id=<?= $row['id_producto']; ?>' class='btn btn-success'>
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p>No se encontraron productos.</p>
    <?php } ?>
    
    <!-- Modal de Registro de Producto -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../SCRIPTS/productos-dsh.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre del Producto:</label>
                                <input type="text" id="nombre" class="form-control" placeholder="Ingresa el nombre del producto" name="nombre">
                            </div>

                            <fieldset class="col-md-6">
                                <legend>Marca:</legend>
                                <div class="form-check">
                                    <input type="radio" id="contactChoice1" name="contact" value="Raw" class="form-check-input" onclick="toggleInput()"/>
                                    <label for="contactChoice1" class="form-check-label">Raw</label>
                                </div>
                                <!-- Agrega más opciones de marca aquí -->
                                <div class="form-check">
                                    <input type="radio" id="contactChoice7" name="contact" value="otro" class="form-check-input" onclick="toggleInput()"/>
                                    <label for="contactChoice7" class="form-check-label">OTRO</label>
                                </div>
                            </fieldset>

                            <div id="otra_marca" class="col-md-6" style="display:none;">
                                <label for="extra">Ingrese el Nombre de la Marca:</label>
                                <input type="text" id="extra" class="form-control" name="extra">
                            </div>

                            <fieldset class="col-md-6">
                                <legend>Categoria(s)</legend>
                                <?php foreach ($cat as $row) { ?>
                                    <div class="form-check">
                                        <input type="checkbox" id="coding" name="cate[]" value="<?= $row['id']; ?>" class="form-check-input" />
                                        <label for="coding" class="form-check-label"><?= $row['nombre']; ?></label>
                                    </div>
                                <?php } ?>
                            </fieldset>

                            <fieldset class="col-md-6">
                                <legend>Proveedor(es)</legend>
                                <p>(EL PRECIO DE COMPRA SE REGISTRA, DESDE EL REABASTECIMIENTO)</p>
                                <?php foreach ($prov as $row) { ?>
                                    <div class="form-check">
                                        <input type="checkbox" id="<?= $row['id']; ?>" name="proveedores[]" value="<?= $row['id'];?>" class="form-check-input" />
                                        <label for="<?= $row['id']; ?>" class="form-check-label"><?= $row['nombre']; ?></label>
                                    </div>
                                <?php } ?>
                            </fieldset>

                            <div class="form-group col-md-6">
                                <label for="precio">Precio al publico:</label>
                                <input type="text" id="precio" class="form-control" placeholder="Ingresa el precio" name="precio">
                            </div>

                            <fieldset class="col-md-6">
                                <legend>Material:</legend>
                                <!-- Agrega las opciones de materiales aquí -->
                            </fieldset>

                            <div class="form-group col-md-12">
                                <label for="img">Seleccione una imagen del producto:</label>
                                <input type="file" id="img" class="form-control" name="img" onchange="validarTamanioArchivo(this)">
                            </div>

                            <div class="form-group col-md-12">
                                <legend>Descripción:</legend>
                                <textarea name="desc" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <button type="submit" name="btnreg" class="btn btn-primary mt-3">Registrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>
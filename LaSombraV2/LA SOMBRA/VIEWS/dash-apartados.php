<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartados</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/dash-apartados.css">
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
                        <a class="nav-link" style="background-color: limegreen;" href="#">PEDIDOS</a>
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
        
        <!-- Main Content -->
        <div id="gestion" class="container-fluid">
        <h1 class="mt-5">Gestión de pedidos</h1>
        <form action="" method="post" class="mb-5">
            <div class="form-group">
                <label for="numero_pedido">Número de Pedido:</label>
                <input type="number" name="numero_pedido" id="numero_pedido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="PENDIENTE">Pendientes</option>
                    <option value="COMPLETADA">Completadas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>



        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include "../CLASS/database.php";
            $db = new Database();
            $db->conectarBD();
            $conexion = $db->getPDO();

            $numero_pedido = $_POST['numero_pedido'];
            $estado = $_POST['estado'];

            $sql = "SELECT v.id_venta, u.nombre_usuario, v.estado, v.tipo_venta, v.monto_total, s.nombre AS sucursal
                    FROM venta v
                    JOIN cliente c ON v.id_cliente = c.id_cliente
                    LEFT JOIN persona p ON c.persona = p.id_persona
                    LEFT JOIN usuarios u ON p.usuario = u.id_usuario
                    LEFT JOIN sucursales s ON v.sucursal = s.id_sucursal
                    WHERE v.id_venta = :numero_pedido AND v.estado = :estado";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':numero_pedido', $numero_pedido);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            

            if ($ventas) {
                echo '<table class="table table-bordered">';
                echo '<thead class="thead-dark"><tr>';
                echo '<th>ID Venta</th>';
                echo '<th>Nombre de Usuario</th>';
                echo '<th>Estado</th>';
                echo '<th>Tipo de Venta</th>';
                echo '<th>Monto del pedido</th>';
                echo '<th>Sucursal</th>';

    
                if ($estado == 'PENDIENTE') {
                    echo '<th>Acciones</th>';
                }
                echo '</tr></thead>';
                echo '<tbody>';
                foreach ($ventas as $venta) {
                    echo '<tr>';
                    echo '<td>' . $venta['id_venta'] . '</td>';
                    echo '<td>' . $venta['nombre_usuario'] . '</td>';
                    echo '<td>' . $venta['estado'] . '</td>';
                    echo '<td>' . $venta['tipo_venta'] . '</td>';
                    echo '<td>' . $venta['monto_total'] . '</td>';
                    echo '<td>' . $venta['sucursal'] . '</td>';
                    if ($estado == 'PENDIENTE') {
                        echo '<td>';
                        echo '<form action="../SCRIPTS/confirmar-pedido.php" method="post">';
                        echo '<input type="hidden" name="id_venta" value="' . $venta['id_venta'] . '">';
                        echo '<button type="submit" class="btn btn-success">Confirmar pedido</button>';
                        echo '</form>';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<div class="alert alert-warning">No se encontraron ventas con el estado seleccionado.</div>';
            }
        }
        ?>
    </div>  


        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>
</html>

<?php 
include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();

// Consulta para obtener los top 5 clientes con más ventas completadas en mata
$topClientesQuery = "
    SELECT u.nombre_usuario, COUNT(v.id_venta) AS total_ventas
    FROM venta v
    JOIN cliente c ON v.id_cliente = c.id_cliente
    JOIN persona p ON c.persona = p.id_persona
    JOIN usuarios u ON p.usuario = u.id_usuario
    WHERE v.estado = 'COMPLETADA'
    AND v.sucursal = '1'
    GROUP BY u.nombre_usuario
    ORDER BY total_ventas DESC
    LIMIT 5
";

$topClientesStmt = $conexion->prepare($topClientesQuery);
$topClientesStmt->execute();
$topClientesMata = $topClientesStmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los top 5 clientes con más ventas completadas en nazas
$topClientesQuery = "
    SELECT u.nombre_usuario, COUNT(v.id_venta) AS total_ventas
    FROM venta v
    JOIN cliente c ON v.id_cliente = c.id_cliente
    JOIN persona p ON c.persona = p.id_persona
    JOIN usuarios u ON p.usuario = u.id_usuario
    WHERE v.estado = 'COMPLETADA'
    AND v.sucursal = '2'
    GROUP BY u.nombre_usuario
    ORDER BY total_ventas DESC
    LIMIT 5
";

$topClientesStmt = $conexion->prepare($topClientesQuery);
$topClientesStmt->execute();
$topClientesNazas = $topClientesStmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener el producto más vendido en ventas completadas de mata
$productoMasVendidoQuery = "
    SELECT p.nombre, COUNT(dv.producto) AS total_vendido
    FROM detalle_venta dv
    JOIN productos p ON dv.producto = p.id_producto
    JOIN venta v ON dv.venta = v.id_venta
    WHERE v.estado = 'COMPLETADA'
     AND v.sucursal = '1'
    GROUP BY p.nombre
    ORDER BY total_vendido DESC
    LIMIT 1
";

$productoMasVendidoStmt = $conexion->prepare($productoMasVendidoQuery);
$productoMasVendidoStmt->execute();
$productoMasVendidoMata = $productoMasVendidoStmt->fetch(PDO::FETCH_ASSOC);


// Consulta para obtener el producto más vendido en ventas completadas de nazas
$productoMasVendidoQuery = "
    SELECT p.nombre, COUNT(dv.producto) AS total_vendido
    FROM detalle_venta dv
    JOIN productos p ON dv.producto = p.id_producto
    JOIN venta v ON dv.venta = v.id_venta
    WHERE v.estado = 'COMPLETADA'
     AND v.sucursal = '2'
    GROUP BY p.nombre
    ORDER BY total_vendido DESC
    LIMIT 1
";

$productoMasVendidoStmt = $conexion->prepare($productoMasVendidoQuery);
$productoMasVendidoStmt->execute();
$productoMasVendidoNazas = $productoMasVendidoStmt->fetch(PDO::FETCH_ASSOC);


// Todos los clientes
function obtenerClientes($conexion) {
    $clientesQuery = "
        SELECT u.nombre_usuario, v.id_venta, v.monto_total, s.nombre AS sucursal
        FROM venta v
        JOIN cliente c ON v.id_cliente = c.id_cliente
        JOIN persona p ON c.persona = p.id_persona
        JOIN usuarios u ON p.usuario = u.id_usuario
        JOIN sucursales s ON v.sucursal = s.id_sucursal
        WHERE v.estado = 'COMPLETADA'
    ";

    $clientesStmt = $conexion->prepare($clientesQuery);
    $clientesStmt->execute();
    return $clientesStmt->fetchAll(PDO::FETCH_ASSOC);
}

$clientes = obtenerClientes($conexion);

//Mostrar ventas de un cliente
if (isset($_POST['nm_prod'])) {
    $nombreUser = $_POST['nm_prod'];

    $pedidosClienteQuery = "
        SELECT u.nombre_usuario, v.id_venta, v.monto_total, s.nombre AS sucursal
        FROM venta v
        JOIN cliente c ON v.id_cliente = c.id_cliente
        JOIN persona p ON c.persona = p.id_persona
        JOIN usuarios u ON p.usuario = u.id_usuario
        JOIN sucursales s ON v.sucursal = s.id_sucursal
        WHERE v.estado = 'COMPLETADA' AND u.nombre_usuario LIKE :nombreUsuario
    ";

    $pedidosClienteStmt = $conexion->prepare($pedidosClienteQuery);
    $pedidosClienteStmt->bindValue(':nombreUsuario', '%' . $nombreUser . '%');
    $pedidosClienteStmt->execute();
    $pedidosCliente = $pedidosClienteStmt->fetchAll(PDO::FETCH_ASSOC);
}

// Filtrado por sucursal
if (isset($_POST['provee'])) {
    $sucursalSeleccionada = $_POST['provee'];

    $pedidosSucursalQuery = "
        SELECT u.nombre_usuario, v.id_venta, v.monto_total, s.nombre AS sucursal
        FROM venta v
        JOIN cliente c ON v.id_cliente = c.id_cliente
        JOIN persona p ON c.persona = p.id_persona
        JOIN usuarios u ON p.usuario = u.id_usuario
        JOIN sucursales s ON v.sucursal = s.id_sucursal
        WHERE v.estado = 'COMPLETADA' AND s.id_sucursal = :sucursal
    ";

    $pedidosSucursalStmt = $conexion->prepare($pedidosSucursalQuery);
    $pedidosSucursalStmt->bindValue(':sucursal', $sucursalSeleccionada);
    $pedidosSucursalStmt->execute();
    $pedidosSucursal = $pedidosSucursalStmt->fetchAll(PDO::FETCH_ASSOC);
}

// Detalles de venta
if (isset($_POST['venta_id'])) {
    $idVenta = $_POST['venta_id'];
    try {
        $stmt_detalles = $pdo->prepare("
            SELECT p.nombre, p.precio, dv.cantidad
            FROM detalle_venta dv
            JOIN productos p ON dv.producto = p.id_producto
            WHERE dv.venta = :idVenta;
        ");
        $stmt_detalles->bindParam(':idVenta', $idVenta, PDO::PARAM_INT);
        $stmt_detalles->execute();
        $detalles = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);

        if ($detalles && count($detalles) > 0) {
            echo '<table class="table table-borderless table-hover">';
            echo '<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th></tr></thead>';
            echo '<tbody>';
            foreach ($detalles as $detalle) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($detalle['nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($detalle['precio']) . '</td>';
                echo '<td>' . htmlspecialchars($detalle['cantidad']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No se encontraron detalles para esta compra.</p>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $db->desconectarBD();
    }
} else {
    echo '<p>ID de venta no proporcionado.</p>';
}
?>
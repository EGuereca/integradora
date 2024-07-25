<?php
     $hostname = "localhost";
     $user = "root";
     $password = "";
     $database = "sombra";
     $charset = "utf8";
     $server = "mysql:host=localhost;dbname=la_sombra"; // Ajuste de espacio en blanco
    

    try {
            $conexion = "mysql:host=".$this->hostname.";dbname=".$this->database.
            ";charset=".$this->charset;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];            
            $pdo = new PDO($conexion, $this->user, $this->password, $options);
            return $pdo;
            } catch (PDOException $e) {
            echo $e->getMessage();
    }
    
    $productos_p_pagina = 10;
    
    
    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
    } else {
        $pagina = 1;
    }

    $inicio = ($pagina - 1) * $productos_por_pagina;

    $sql = "SELECT id_producto, nombre, descripcion, precio, stock 
    FROM productos LIMIT $inicio, $productos_por_pagina";
    $result = $conn->query($sql);

    $productos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }

    $total_sql = "SELECT COUNT(*) FROM productos";
    $total_result = $conn->query($total_sql);
    $total_productos = $total_result->fetch_row()[0];
    $total_paginas = ceil($total_productos / $productos_por_pagina);

$conn->close();

?>
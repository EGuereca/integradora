<?php
session_start();
if ($_SESSION["rol"] == 3 || $_SESSION["rol"] == null) {
    header("location: ../VIEWS/iniciov2.php");
    exit();    
}

if ($_SESSION["sucursal"] == null) {
    header("location: ../VIEWS/CONTROL-SUCURSAL.php");
    exit();    
}


include '../SCRIPTS/llenar-venta.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llenado Venta</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/productos.css">
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container" id="in">
        <div class="search-bar mb-3">
            <form action="" method="post">
                <select name="pago" id="">
                    <option value="EFECTIVO">EFECTIVO</option>
                    <option value="TARJETA">TARJETA</option>
                </select>
                <button type="submit" name="registrar_venta">Registrar Venta</button>                
            </form>
        </div>
        <?php
            if($_SESSION['sucursal'] == null){
                
        ?>
        <?php } 
                else{        
        ?>
        <div class="row">      
        <?php
        if (!empty($productos)) {
            foreach ($productos as $row) { ?>

                <div class="col-lg-3 col-sm-12">
                <div class="card mb-3">                
                    <div class="card-img-container">
                        <img src="../IMG/blazy-susan.svg" alt="<?php echo $row['nombre']; ?>" class="card-img-top">
                    </div>
                    <div class="card-body">
                        
                        <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                        <p class="card-text">$ <?php echo $row['precio']; ?></p>
                        <p class="card-text"><?php echo $row['stock']; ?> piezas disponibles</p>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id_producto']; ?>">
                            <select name="cantidad">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>    
                            <button name="btn-reg" type="submit">Agregar</button>
                        </form>
                    </div>                
                </div>
            </div>          
        <?php
            }
        } else {
            echo "No hay productos disponibles";
        }
        ?>           
            </div>            
        <?php } ?>
    </div>
                        
    
</body>
</html>
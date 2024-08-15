<?php

include "../CLASS/database.php";
$db = new Database();
$db->conectarBD();

$conexion = $db->getPDO();


$sql = "SELECT id_empleado AS id,
        CONCAT(nombres,' ',ap_paterno,' ',ap_materno) AS nombre,
        r.rol AS rol,
        u.email AS email,
        u.telefono AS telefono
        FROM empleado AS e
        JOIN persona AS p ON e.persona = p.id_persona
        JOIN usuarios AS u ON p.usuario = u.id_usuario
        JOIN rol_usuario AS ru ON u.id_usuario = ru.usuario
        JOIN roles AS r ON ru.rol = r.id_rol";


$stmt = $conexion->prepare($sql);
$stmt->execute();

echo "Número de resultados: " . $stmt->rowCount();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conexion->prepare("CALL REGISTRO_EMPLEADOS(?,?,?,?,?,?,?,?,?,?,?)");
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
        
    } else {
        echo "<div class='alert alert-danger'>La contraseña debe contener al menos un número, una letra mayúscula, un carácter especial, y estar entre 8 y 20 caracteres.</div>";
    }
}

if (isset($_POST["btncrearemp"])) {
        $pass1 = $_POST['password'];
        $pass2 = $_POST['confirm_password'];

        if ($pass1 === $pass2) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $nombre = $_POST["nombre"];
            $paterno = $_POST["paterno"];
            $materno = $_POST["materno"];
            $rfc = $_POST["rfc"];
            $nss = $_POST["nss"];
            $curp = $_POST["curp"];
            $rol = $_POST["rol"];
            
            $stmt2->bindParam(1, $usuario, PDO::PARAM_STR);
            $stmt2->bindParam(2, $password, PDO::PARAM_STR);
            $stmt2->bindParam(3, $email, PDO::PARAM_STR);
            $stmt2->bindParam(4, $telefono, PDO::PARAM_STR);
            $stmt2->bindParam(5, $nombre, PDO::PARAM_STR);
            $stmt2->bindParam(6, $paterno, PDO::PARAM_STR);
            $stmt2->bindParam(7, $materno, PDO::PARAM_STR);
            $stmt2->bindParam(8, $rfc, PDO::PARAM_STR);
            $stmt2->bindParam(9, $curp, PDO::PARAM_STR);
            $stmt2->bindParam(10, $nss, PDO::PARAM_STR);
            $stmt2->bindParam(11, $rol, PDO::PARAM_STR);
            $stmt2->execute();
            
            echo "<p style='color: green;'>Usuario registrado exitosamente.</p>";
            header("refresh:3  ; ../VIEWS/dsh-empl.php");
        } else {
            echo "<p style='color: red;'>Las contraseñas son diferentes.</p>";
        }   
}


?>
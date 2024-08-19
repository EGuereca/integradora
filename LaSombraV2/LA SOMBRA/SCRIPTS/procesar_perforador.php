<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $telefono = $_POST['telefono']; // Capturar el número de teléfono
    $imagen = $_FILES['imagen']['name'];

    // Definir la ruta de destino para la imagen
    $target_dir = "imagenes_perforadores/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($imagen);

    // Intentar mover la imagen subida
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        echo "La imagen se subió correctamente.<br>";
    } else {
        echo "Hubo un problema al subir la imagen.";
        exit();
    }

    // Leer el contenido actual del archivo JSON
    $json_data = file_get_contents('perforadores.json');
    $perforadores = json_decode($json_data, true);

    // Crear el nuevo perforador
    $nuevo_perforador = array(
        "nombre" => $nombre,
        "descripcion" => $descripcion,
        "telefono" => $telefono, // Guardar el número de teléfono
        "imagen" => $target_file
    );

    // Agregar el nuevo perforador al array
    $perforadores[] = $nuevo_perforador;

    // Guardar el nuevo contenido en el archivo JSON
    if (file_put_contents('perforadores.json', json_encode($perforadores, JSON_PRETTY_PRINT))) {
        echo "Perforador agregado exitosamente.<br>";
    } else {
        echo "Hubo un problema al guardar el perforador.";
        exit();
    }

    // Redirigir de vuelta a la página de perforaciones
    header("Location: /integradora/LaSombraV2/LA%20SOMBRA/VIEWS/perforaciones.php");
    exit();
}
?>

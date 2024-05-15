<?php
session_start();

// Verificar si se recibió una imagen
if(isset($_POST['imagen'])) {
    // Decodificar la imagen base64
    $imagen_base64 = $_POST['imagen'];
    $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen_base64));

    // Guardar la imagen en el servidor
    $nombre_archivo = 'imagen_recortada_' . uniqid() . '.jpg'; // Nombre de archivo único
    $ruta_archivo = 'uploads/' . $nombre_archivo; // Ruta donde se guardará la imagen

    if(file_put_contents($ruta_archivo, $imagen)) {
        // Guardar la ruta de la imagen en $_FILES['imagen'] para simular el envío de un archivo
        $_FILES['imagen'] = $imagen_base64;

        // Guardar la ruta de la imagen en $_SESSION['picture']
        $_SESSION['picture'] = $imagen_base64;

        // Enviar una respuesta de éxito al cliente
        echo json_encode(array('success' => true, 'message' => 'Imagen guardada con éxito'));
    } else {
        // Enviar una respuesta de error al cliente
        echo json_encode(array('success' => false, 'message' => 'Error al guardar la imagen'));
    }
} else {
    // Enviar una respuesta de error al cliente si no se recibió una imagen
    echo json_encode(array('success' => false, 'message' => 'No se recibió una imagen'));
}
?>
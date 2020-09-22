<?php

// Conexiones a la BD


function upload_image($archivo) {

    $validacion_ok = 1;
    $directorio_imagenes = 'imagenes/';
    $url_final = $directorio_imagenes.basename($archivo['name']);
    $extension_archivo = strtolower(pathinfo($url_final, PATHINFO_EXTENSION));

    if (file_exists($url_final)) { // Validar si la imagen existe.
        echo 'La imagen ya existe!';
        $validacion_ok = 0;
    }

    if ($archivo['size'] > 5000000) { // Validar el tamaño de la imagen
        echo 'La imagen es muy grande!';
        $validacion_ok = 0;
    }

    // Validamos los formatos permitidos
    if ($extension_archivo != 'jpg' && $extension_archivo != 'png') {
        echo 'El formato del archivo no es permitido';
        $validacion_ok = 0;
    }

    if ($validacion_ok == 0) {
        echo 'La imagen no se puede subir';
    } else {
        if (move_uploaded_file($archivo['tmp_name'], $url_final)) {
            echo 'La imagen subida correctamente!';
        } else {
            echo 'Hubo un error al subir la imagen';
        }
    }

}

?>
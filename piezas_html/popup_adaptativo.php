<?php
// PHP para obtener el código de éxito o error
if (isset($_GET['success'])) {
    $cod_confirm = $_GET['success'];
    $message = '';
    $popup_class = 'popup_respuesta_success'; // Clase para el popup de éxito
    if ($cod_confirm == 'alta_creatura_exitosa') {
        $message = 'Creatura agregada con exito!';
    } else if ($cod_confirm == '2') { 
        $message = 'Pieza Actualizada';
    } 
    
} else if (isset($_GET['error'])) {
    $cod_error = $_GET['error'];
    $message = '';
    $popup_class = 'popup_respuesta_error'; // Clase para el popup de error
    
    if ($cod_error == 'alta_no_sesion') {
        $message = 'Debes iniciar sesión para crear Creaturas!';
    } else if ($cod_error == 'alta_json_habilidades_invalido') {
        $message = 'Error al formatear Json con las habilidades de la Creatura.';
    } else if ($cod_error == '3') {
        $message = 'Error al Generar una Nueva Compra.';
    }
} else {
    $message = '';
    $popup_class = ''; // No mostrar popup si no hay código
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Web</title>
    <style>
/* Estilos para el popup como ventana flotante */
.popup_respuesta {
    position: fixed;
    top: 50%; /* Centrado vertical */
    left: 50%; /* Centrado horizontal */
    transform: translate(-50%, -50%);
    width: 80%;
    max-width: 400px;
    padding: 20px;
    text-align: center;
    font-size: 18px;
    z-index: 9999;
    display: none; /* Inicialmente no visible */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    color: black; /* Aseguramos que el texto sea negro */
    border: 2px solid transparent; /* Borde transparente por defecto */
}

.popup_respuesta_success {
    border-color: #4CAF50; /* Verde */
}

.popup_respuesta_error {
    border-color: #f44336; /* Rojo */
}

/* Estilos para el fondo oscuro que bloquea la interacción */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro */
    z-index: 9998; /* Aseguramos que esté debajo del popup */
    display: none; /* Inicialmente no visible */
}

.popup_respuesta.show, .popup-overlay.show {
    display: block; /* Mostrar el popup y el fondo oscuro */
}

/* Estilos para el botón de cerrar */
.popup_respuesta .close-btn {
    position: absolute;
    top: 5px;
    right: 10px;
    background: none;
    border: none;
    color: black; /* Cruz de salida de color negro */
    font-size: 18px;
    cursor: pointer;
}

    </style>
</head>
<body>

    <!-- Aquí agregamos el overlay y el popup -->
    <?php if (!empty($message)): ?>
        <div id="popup-overlay" class="popup-overlay"></div> <!-- Fondo oscuro -->
        <div id="popup_respuesta" class="popup_respuesta <?php echo $popup_class; ?>">
            <button class="close-btn" onclick="closePopup()">×</button>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <script>
        // Mostrar el popup si hay un mensaje
        window.onload = function() {
            const popup = document.getElementById('popup_respuesta');
            const overlay = document.getElementById('popup-overlay');
            if (popup && popup.innerText !== '') {
                popup.classList.add('show'); // Mostramos el popup
                overlay.classList.add('show'); // Mostramos el fondo oscuro
            }
        };

        // Función para cerrar el popup
        function closePopup() {
            const popup = document.getElementById('popup_respuesta');
            const overlay = document.getElementById('popup-overlay');
            if (popup) {
                popup.classList.remove('show'); // Ocultamos el popup
                overlay.classList.remove('show'); // Ocultamos el fondo oscuro
            }
        }
    </script>

</body>
</html>
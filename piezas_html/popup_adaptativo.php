<?php
// PHP para obtener el código de éxito o error
if (isset($_GET['success'])) {
    $cod_confirm = $_GET['success'];
    $message = '';
    $popup_class = 'popup_respuesta_success'; // Clase para el popup de éxito
    if ($cod_confirm == 'alta_creatura_exitosa') {
        $message = 'Creatura agregada con exito!';
    } 
    if ($cod_confirm == 'alta_tipo_exitosa') {
        $message = '¡Tipo creado con éxito!';
    }
    if ($cod_confirm == 'alta_habilidad_exitosa') {
        $message = '¡Habilidad agregada con éxito!';
    }
    if ($cod_confirm == 'alta_usuario_exitosa') {
        $message = '¡Usuario creado exitosamente! Ya puedes iniciar sesión.';
    }
    if ($cod_confirm == 'eliminar_creatura_exitosa') {
        $message = 'Creatura eliminada correctamente.';
    }
    if ($cod_confirm == 'eliminar_habilidad_exitosa') {
        $message = 'Habilidad eliminada correctamente.';
    }
    if ($cod_confirm == 'eliminar_tipo_exitosa') {
        $message = 'Tipo eliminado correctamente.';
    }
    if ($cod_confirm == 'eliminar_usuario_exitosa') {
        $message = 'Usuario eliminado exitosamente.';
    }
    if ($cod_confirm == 'login_exitoso') {
        $message = '¡Ingreso exitoso! Bienvenido.';
    }
     if ($cod_confirm == 'logout_exitoso') {
        $message = 'Has cerrado sesión correctamente.';
    }
    if ($cod_confirm == 'modificacion_exitosa') {
        $message = '¡Modificación de creatura exitosa!';
    }
    if ($cod_confirm == 'modificacion_habilidad_exitosa') {
        $message = '¡Modificación de habilidad exitosa!';
    }
    if ($cod_confirm == 'modificacion_usuario_exitosa') {
        $message = '¡Usuario modificado con éxito!';
    } 
    if ($cod_confirm == 'modificacion_tipo_exitosa') {
        $message = '¡Tipo modificado con éxito!';
    }
} else if (isset($_GET['error'])) {
    $cod_error = $_GET['error'];
    $message = '';
    $popup_class = 'popup_respuesta_error'; // Clase para el popup de error
    
    if ($cod_error == 'alta_creatura_no_sesion') {
        $message = 'Debes iniciar sesión para crear Creaturas!';
    } else if ($cod_error == 'alta_creatura_json_habilidades_invalido') {
        $message = 'Error al formatear Json con las habilidades de la Creatura.';
    } else if ($cod_error == 'alta_creatura_tipo_imagen_no_valido') {
        $message = 'La imagen de la creatura debe ser JPEG o PNG.';
    } else if ($cod_error == 'fallo_alta_creatura') {
        $message = 'Error al generar la nueva Creatura.';
    } else if ($cod_error == 'alta_creatura_fallo_alta_moveset') {
        $message = 'Error al crear el moveset de la Creatura.';
    } else if ($cod_error == 'alta_creatura_fallo_subida_imagen') {
        $message = 'Error al subir la imagen de la creatura.';
    }

    if ($cod_error == 'alta_habilidad_sin_sesion') {
        $message = 'Debes iniciar sesión para crear habilidades.';
    } else if ($cod_error == 'alta_habilidad_campos_invalidos') {
        $message = 'Campos inválidos o incompletos. Revisa los datos.';
    } else if ($cod_error == 'fallo_alta_habilidad') {
        $message = 'Ocurrió un error al registrar la habilidad.';
    }

    if ($cod_error == 'alta_tipo_sin_sesion') {
        $message = 'Debes iniciar sesión para crear un tipo.';
    } else if ($cod_error == 'alta_tipo_icono_no_valido') {
        $message = 'El ícono debe ser un archivo PNG o JPEG.';
    } else if ($cod_error == 'alta_tipo_fallo_subida_imagen') {
        $message = 'No se pudo subir la imagen del tipo.';
    } else if ($cod_error == 'fallo_alta_tipo') {
        $message = 'Error al crear el tipo.';
    }

    if ($cod_error == 'alta_usuario_campos_vacios') {
        $message = 'Por favor, completa todos los campos obligatorios.';
    } else if ($cod_error == 'alta_usuario_contrasenas_diferentes') {
        $message = 'Las contraseñas no coinciden.';
    } else if ($cod_error == 'alta_usuario_email_invalido') {
        $message = 'El correo electrónico ingresado no es válido.';
    } else if ($cod_error == 'alta_usuario_foto_invalida') {
        $message = 'La imagen debe ser JPEG o PNG.';
    } else if ($cod_error == 'alta_usuario_fallo_subida_foto') {
        $message = 'Ocurrió un error al subir la foto de perfil.';
    } else if ($cod_error == 'alta_usuario_nick_o_correo_repetido') {
        $message = 'El nickname o correo ya está en uso.';
    }

    if ($cod_error == 'eliminar_creatura_id_invalido') {
        $message = 'ID de creatura inválido.';
    } else if ($cod_error == 'eliminar_creatura_fallo') {
        $message = 'Error al eliminar la creatura.';
    }

    if ($cod_error == 'eliminar_habilidad_id_invalido') {
        $message = 'ID de habilidad inválido.';
    } else if ($cod_error == 'eliminar_habilidad_fallo') {
        $message = 'Error al eliminar la habilidad.';
    }

    if ($cod_error == 'eliminar_tipo_id_invalido') {
        $message = 'ID de tipo inválido.';
    } else if ($cod_error == 'eliminar_tipo_no_encontrado') {
        $message = 'El tipo no fue encontrado.';
    } else if ($cod_error == 'fallo_eliminar_habilidades') {
        $message = 'Error al eliminar las habilidades relacionadas.';
    } else if ($cod_error == 'fallo_modificar_criaturas') {
        $message = 'Error al modificar las criaturas relacionadas.';
    } else if ($cod_error == 'fallo_eliminar_efectividades') {
        $message = 'Error al eliminar las efectividades relacionadas.';
    } else if ($cod_error == 'fallo_eliminar_tipo') {
        $message = 'Error al eliminar el tipo.';
    }

    if ($cod_error == 'no_sesion') {
        $message = 'No hay sesión iniciada. Por favor inicia sesión.';
    }else if ($cod_error == 'Error al eliminar habilidad') {
        $message = 'Error al eliminar una habilidad.';
    }else if ($cod_error == 'Error al modificar criatura') {
        $message = 'Error al modificar una criatura.';
    }else if ($cod_error == 'Error al eliminar efectividades') {
        $message = 'Error al eliminar efectividades del tipo.';
    }else if ($cod_error == 'Error al eliminar tipo') {
        $message = 'Error al eliminar el tipo.';
    }else if ($cod_error == 'Error al eliminar rating') {
        $message = 'Error al eliminar un rating.';
    }else if ($cod_error == 'Error al eliminar creatura') {
        $message = 'Error al eliminar una creatura.';
    }else if ($cod_error == 'Error al eliminar usuario') {
        $message = 'Error al eliminar el usuario.';
    }

    if ($cod_error == 'credenciales_invalidas') {
        $message = 'Credenciales incorrectas. Intenta nuevamente.';
    } else if ($cod_error == 'usuario_no_encontrado') {
        $message = 'Usuario no encontrado.';
    }

    if ($cod_error == 'logout_fallo') {
        $message = 'Error al cerrar sesión.';
    }

    if ($cod_error == 'sin_sesion') {
        $message = 'Debes iniciar sesión para modificar la creatura.';
    } else if ($cod_error == 'parametros_faltantes') {
        $message = 'Faltan parámetros para modificar la creatura.';
    } else if ($cod_error == 'json_habilidades_invalido') {
        $message = 'Error al procesar las habilidades (JSON inválido).';
    } else if ($cod_error == 'fallo_borrar_moveset') {
        $message = 'No se pudo borrar el moveset anterior.';
    } else if ($cod_error == 'fallo_modificar_creatura') {
        $message = 'Error al modificar la creatura.';
    } else if ($cod_error == 'fallo_subida_imagen') {
        $message = 'Error al subir la imagen de la creatura.';
    }

    if ($cod_error == 'fallo_modificar_habilidad') {
        $message = 'Error al modificar la habilidad.';
    } else if ($cod_error == 'mod_habilidad_sin_sesion') {
        $message = 'Debes iniciar sesión para modificar habilidades.';
    } else if ($cod_error == 'mod_habilidad_parametros_faltantes') {
        $message = 'Faltan parámetros para modificar la habilidad.';
    }

    if ($cod_error == 'campos_vacios') {
        $message = 'Por favor, completa todos los campos obligatorios.';
    } else if ($cod_error == 'nick_correo_repetido') {
        $message = 'El nickname o correo ya están en uso.';
    } else if ($cod_error == 'contrasenas_no_coinciden') {
        $message = 'Las contraseñas no coinciden.';
    } else if ($cod_error == 'error_subida_foto') {
        $message = 'Error al subir la foto de perfil.';
    } else if ($cod_error == 'fallo_modificacion') {
        $message = 'Error al modificar el usuario.';
    } 

    if ($cod_error == 'id_tipo_faltante') {
        $message = 'ID del tipo faltante.';
    } else if ($cod_error == 'campos_obligatorios_vacios') {
        $message = 'Por favor, completa todos los campos obligatorios.';
    } else if ($cod_error == 'tipo_no_encontrado') {
        $message = 'El tipo solicitado no fue encontrado.';
    }else if ($cod_error == 'icono_tipo_no_valido') {
        $message = 'El ícono debe ser una imagen JPG o PNG válida.';
    }else if ($cod_error == 'fallo_modificacion_tipo') {
        $message = 'Error al modificar el tipo.';
    }else if ($cod_error == 'fallo_subida_icono') {
        $message = 'Error al subir el ícono.';
    }else if ($cod_error == 'fallo_eliminar_efectividades') {
        $message = 'Error al actualizar las efectividades del tipo.';
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

  if (popup && popup.innerText.trim() !== '') {
    popup.classList.add('show'); 
    overlay.classList.add('show');

    // Borrar los parámetros de la URL (error/success)
    const url = new URL(window.location.href);
    url.searchParams.delete('error');
    url.searchParams.delete('success');
    window.history.replaceState({}, document.title, url.pathname);
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
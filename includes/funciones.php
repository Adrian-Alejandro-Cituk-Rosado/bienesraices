<?php 

define('TEMPLATES_URL',__DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__ .'funciones.php');
define('CARPETA_IMAGENES',__DIR__ .'/../imagenes/');



function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/${nombre}.php";
}
function estaAutenticado()
{
    session_start();
    

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}
function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
     exit;
   
}
//Escapa / Sanitizar el html
function s($html) : string{
$s = htmlspecialchars($html);
return $s;
}

//Validar tipo de Contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];

     return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo){
    $notificacion = [
        'mensaje' => '',
        'clase' => ''
    ];

    switch($codigo){
        case 1:
            $notificacion['mensaje'] = 'Creado correctamente';
            $notificacion['clase'] = 'exito';
            break;
        case 2:
            $notificacion['mensaje'] = 'Actualizado correctamente';
            $notificacion['clase'] = 'actualizado';
            break;
        case 3:
            $notificacion['mensaje'] = 'Eliminado correctamente';
            $notificacion['clase'] = 'error';
            break;
        default:
            return false;
    }

    return $notificacion;
}

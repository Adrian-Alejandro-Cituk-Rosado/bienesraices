<?php 
require '../../includes/app.php';
ini_set('display_errors', "On");
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

// Validar la URL por ID válido 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

// Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);
//Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();


// Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

// Ejecutar el código después de que el usuario envía el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Asignar los atributos
    $args = $_POST['propiedad'];
    $propiedad->sincronizar($args);

    // Validación
    $errores = $propiedad->validar();

    // Subida de archivos
    if ($_FILES['propiedad']['tmp_name']['imagen']) { 
        // Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        // Crear la imagen con Intervention Image
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        // Borrar la imagen anterior
        if ($propiedad->imagen) {
            $propiedad->borrarImagen();
        }
        // Asignar el nuevo nombre de la imagen
        $propiedad->setImagen($nombreImagen);
    }

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        // Almacenar la imagen si existe
        if (isset($image)) {
            // Guardar la nueva imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        $propiedad->guardar();
    }
}

incluirTemplate('header'); 
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer'); 
?>

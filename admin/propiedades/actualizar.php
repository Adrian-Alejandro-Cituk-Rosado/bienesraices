<?php
ini_set('display_errors', "On");

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
require '../../includes/app.php';
estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
}

$propiedad = Propiedad::find($id);

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
if (!$resultado) {
    echo "Error al obtener los vendedores: " . mysqli_error($db);
    exit;
}

$errores = Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    $imagen = $_FILES['imagen'];
    $errores = $propiedad->validar();
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if ($imagen['tmp_name']) {
        $image = Image::make($imagen['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    if (empty($errores)) {
        if (isset($image)) {
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        $propiedad->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin/" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>

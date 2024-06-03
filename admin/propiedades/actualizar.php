<?php
ini_set('display_errors', "On");
require '../../includes/funciones.php';
$auth=estaAutenticado();
if(!$auth){
    header('Location: /');
}
// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";
//Validar la URL por ID válido
$id=$_GET['id'];
$id=filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /admin');
}
// var_dump($id);
require '../../includes/config/database.php';
$db = conectarDB();
//Obtener los datos de la propiedad
$consulta="SELECT * FROM propiedades WHERE id=${id}";
$resultado=mysqli_query($db, $consulta);
$propiedad=mysqli_fetch_assoc($resultado);


//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo de mensaje de errores
$errores = [];
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagenPropiedad=$propiedad['imagen'];

//Ejecutar el código después de que el usuario envía el formulario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';


    $titulo = mysqli_real_escape_string($db,  $_POST['titulo']);
    $precio = mysqli_real_escape_string($db,  $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db,  $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db,  $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db,  $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db,  $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db,  $_POST['vendedor']);
    $creado = date('Y/m/d');

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El número de baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El número de lugares de estacionamiento es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }


    //Validar por tamaño (1 mb máximo)
    $medida = 1000 * 1000; //De bytes a kb

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }
    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    //Revisar que el array de errores esté vacío
    if (empty($errores)) {
        //Crear carpeta de imágenes
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        $nombreImagen='';
        // /*SUBIDA DE ARCHIVOS**/
        if($imagen['name']){
           unlink($carpetaImagenes . $propiedad['imagen']);
              // //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; // Asegúrate de incluir el punto antes de "jpg"

        // //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }
        else{
            $nombreImagen=$propiedad['imagen'];
        }
        
       

 

     


        //Insertar en la base de datos
        $query = "UPDATE propiedades SET titulo='{$titulo}', precio='{$precio}', imagen= '{$nombreImagen}', descripcion='{$descripcion}', habitaciones={$habitaciones}, wc={$wc}, estacionamiento={$estacionamiento}, vendedorId={$vendedorId} WHERE id={$id}";

        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
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
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Propiedad:</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ej:3" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ej:3" min="1" max="9" name="wc" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ej:3" min="1" max="9" name="estacionamiento" value="<?php echo $wc; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>

                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile;  ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>
<?php

incluirTemplate('footer');
?>
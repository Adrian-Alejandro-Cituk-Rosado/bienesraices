<?php

// ini_set('display_errors', "On");
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
estaAutenticado();
$db = conectarDB();
$propiedad= new Propiedad;
//Consulta para pbtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo de mensaje de errores
$errores = Propiedad::getErrores();


//Ejecutar el código después de que el usuario envía el formulario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Crear una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);
      

        //Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        //Setear la imagen
        //Realiza un resize a la imagen con Intervetion
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image=Image::make($_FILES ['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
     
    //Validar
    $errores=$propiedad->validar();

    
    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    //Revisar que el array de errores esté vacío
    if (empty($errores)) {
        
        //Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        /*SUBIDA DE ARCHIVOS**/
        
        //Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guarda en la base datos
        $propiedad->guardar();
        // Mensaje de éxito

    

    
    }
}






incluirTemplate('header');

?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'  ?>
        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>
<?php

incluirTemplate('footer');
?>
<?php 
ini_set('display_errors', "On");
require '../../includes/app.php';
use App\Propiedad;

use Intervention\Image\ImageManagerStatic as Image;


 estaAutenticado();


        // if(!$auth){
        // header('Location: /');
        // }
//Validar la URL por ID válido 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}


// echo"<pre>";
// var_dump($_GET);
// echo"</pre>";


//Base De datos

// require '../../includes/config/database.php';

// $db = conectarDB();

//Obtener los datos de la propiedad
$propiedad= Propiedad::find($id); 
// $consulta ="SELECT * FROM propiedades WHERE id=${id}";
// $resultado = mysqli_query($db, $consulta);
// $propiedad = mysqli_fetch_assoc($resultado);

// echo"<pre>";
// var_dump($propiedad);
// echo"</pre>";



//Consultar para obtener los vendedores
$consulta ="SELECT * FROM vendedor";
$resultado= mysqli_query($db, $consulta);


//Arreglo con mensajes de errores
$errores =Propiedad::getErrores();
// $titulo = $propiedad->titulo;
// // $precio = $propiedad['precio'];
// // $descripcion = $propiedad['descripcion'];
// // $habitaciones = $propiedad['habitaciones'];
// // $wc = $propiedad['wc'];
// // $estacionamiento =$propiedad['estacionamiento'];
// // $vendedorId =$propiedad['vendedorId'];
// // $imagenPropiedad = $propiedad['imagen'];

//Ejecutar el codigo después de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){



// Asignar los atributos
$args = $_POST['propiedad'];


$propiedad->sincronizar($args);


//Validación
$errores = $propiedad->validar();

//Subida de archivos
//Generar un nombre unico
$nombreImagen = md5( uniqid(rand(), true)). ".jpg";


if($_FILES['propiedad']['tmp_name']['imagen']){ 
    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
$propiedad->setImagen($nombreImagen);
}



// echo"<pre>";
// var_dump($_POST);
// echo"</pre>";
// exit;
// echo"<pre>";
// var_dump($_FILES);
// echo"</pre>";
 

// $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
// $precio = mysqli_real_escape_string($db, $_POST['precio']);
// $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
// $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
// $wc = mysqli_real_escape_string($db, $_POST['wc']);
// $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
// $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
// $creado = date('Y/m/d');

// //Asignar files hacia una variable
// $imagen = $_FILES['imagen'];



//exit;

// if(!$titulo){
//     $errores[]= "Debes añadir un titulo";
// }
// if(!$precio){
//     $errores[]= "El precio es obligatorio";
// }
// if(strlen( $descripcion)< 50){
//     $errores[]= "La descripcion es obligatoria y debe tener al menos 50 caracteres";
// }
// if(!$habitaciones){
//     $errores[]= "El numero de habitaciones es obligatorio";
// }
// if(!$wc){
//     $errores[]= "El numero de baños es obligatorio";
// }
// if(!$estacionamiento){
//     $errores[]= "El numero de lugares de estacionamiento es obligatorio";
// }
// if(!$vendedorId){
//     $errores[]= "Elige un vendedor";
// }



// //Validar por tamaño(1mb máximo)
// $medida = 1000 * 1000;


// if($imagen['size'] > $medida){
//     $errores[]='La imagen es muy pesada';
// }

//echo"<pre>";
//var_dump($errores);
//echo"</pre>";

//Revisar que el arreglo de errores este vacio

if(empty($errores)){
//Almacenar la imagen
$image->save(CARPETA_IMAGENES . $nombreImagen);


$propiedad->guardar();


// $carpetaImagenes = '../../imagenes/';

// if(!is_dir($carpetaImagenes)){
//     mkdir($carpetaImagenes);
// }

// $nombreImagen ='';

// // /* SUBIDA DE ARCHIVOS/

// if($imagen['name']){
//     //Eliminar la imagen previa
// unlink($carpetaImagenes .  $propiedad['imagen']);
// // //Generar un nombre unico
//  $nombreImagen = md5( uniqid(rand(), true)). ".jpg";

// // var_dump($nombreImagen);
// // //Subir la imagen
//  move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
// }else{
//     $nombreImagen = $propiedad['imagen'];
// }



// //Crear Carpeta







}



}




incluirTemplate('header'); ?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                  <?php echo $error; ?>
            </div>
              
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data" >
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        
        
        <!-- <fieldset>
            <legend>Información General</legend>

            
            <label for="titulo">Titulo:</label>
            <input type="text"id="titulo" name="titulo" placeholder="Titulo Propiedad"value="<?php echo $titulo; ?>">


            <label for="precio">Precio:</label>
            <input type="number"id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file"id="imagen"  accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

          </fieldset>
          
          <fieldset>
            <legend>Información Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number"id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1"max="9" value="<?php echo $habitaciones; ?>">


            <label for="wc">Baños:</label>
            <input type="number"id="wc" name="wc" placeholder="Ej. 3" min="1"max="9"value="<?php echo $wc; ?>">


            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number"id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1"max="9"value="<?php echo $estacionamiento; ?>">

          </fieldset>

          <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor" >
            <option value="">--Seleccione--</option>
                <?php while($vendedor1 = mysqli_fetch_assoc($resultado) ): ?>
                     <option  <?php echo $vendedorId === $vendedor1['id'] ? 'selected' : ''; ?>   value="<?php echo $vendedor1['id']; ?>"><?php echo $vendedor1['nombre'] . " " . $vendedor1['apellido'];?></option>

                    <?php endwhile;?>
            </select>
          </fieldset> -->

          <input type="submit"value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php 

incluirTemplate('footer'); ?>
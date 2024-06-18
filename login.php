<?php 
// Incluye el header
require 'includes/app.php';
$db = conectarDB();

// Autenticar el usuario
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo"<pre>";
    // var_dump($_POST);
    // echo"</pre>";

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']); // Usar 'password1'

    if(!$email){
        $errores[] = "El email es obligatorio o no es valido";
    }
    if(!$password){
        $errores[] = "El Password es obligatorio";
    }

    if(empty($errores)){
        // Aquí iría el código para autenticar al usuario
        //Revisar si el usuario existe.
        $query = "SELECT * FROM usuarios WHERE email='${email}'";
        $resultado = mysqli_query($db, $query);


        
        if( $resultado->num_rows){
                 //Revisar si el usuario no es correcto
                 $usuario= mysqli_fetch_assoc($resultado);
                //var_dump($usuario);
                 //Verificar si el password es correcto o no
                 $auth = password_verify($password, $usuario['password']);

       if($auth){
        //El usuario esta autenticado
        session_start(); 
        $_SESSION['usuarios'] = $usuario['email'];
        $_SESSION['login'] = true;
        // echo"<pre>";
        //    var_dump($_SESSION);
        // echo"</pre>";
        header('Location: /admin');
       }else{
        $errores[] = 'El password es Incorrecto';
       }
        }else{
          $errores[] = "El usuario no existe";
        }
    }
}


incluirTemplate('header'); 
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" >

            <label for="password">Password</label> <!-- Cambiado a 'password1' -->
            <input type="password" name="password" placeholder="Tu Password" id="password" > <!-- Cambiado a 'password1' -->
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer'); 
?>

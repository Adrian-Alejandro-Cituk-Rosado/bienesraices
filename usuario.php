<?php

//Importar la conexión 
// Incluye el header
require 'includes/app.php';
$db = conectarDB();

//Crear un email y password
$email = "correo@correo.com";
$password= "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);



// Query para crear
$query = " INSERT INTO usuarios(email, password) VALUES ('${email}', '${passwordHash}')";
//echo $query;



// Agregarlo a la base de datos
mysqli_query($db, $query);
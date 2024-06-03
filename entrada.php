<?php 

require 'includes/funciones.php';


incluirTemplate('header'); 

?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
        <div class="resumen-propiedad">
          
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non rerum soluta eligendi ut
                voluptate quisquam voluptates, eaque, delectus impedit excepturi cum exercitationem incidunt dolor
                fuga fugit sed, odit porro. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem rem dolore numquam praesentium dignissimos, quidem vero consequuntur exercitationem magnam inventore accusantium quo illo? Nisi saepe iusto rem commodi tenetur suscipit.
            </p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus molestias qui incidunt iste rem voluptatem? Animi quo, soluta cum totam inventore dolor quaerat iste quia. Repellendus officia obcaecati numquam dicta?</p>
        </div>
    </main>
    <?php 

incluirTemplate('footer'); 
?>
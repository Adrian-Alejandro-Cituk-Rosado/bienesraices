<?php 

require 'includes/funciones.php';


incluirTemplate('header'); 

?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro blog</h1>
        <article class="entrada-blog">
            <div class="imagen">
             <picture>
                 <source srcset="build/img/blog1.webp" type="image/webp">
                 <source srcset="build/img/blog1.jpeg" type="image/jpeg">
                 <img src="build/img/blog1.jpg" alt="Texto entrada Blog">
             </picture>
            </div>
            <div class="texto-entrada">
             <a href="entrada.php">
                 <h4>Terraza en el techo de tu casa</h4>
                 <p>Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>
             </a>
             <p>
                 Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
             </p>
            </div>
         </article>
         <article class="entrada-blog">
             <div class="imagen">
              <picture>
                  <source srcset="build/img/blog2.webp" type="image/webp">
                  <source srcset="build/img/blog2.jpeg" type="image/jpeg">
                  <img src="build/img/blog2.jpg" alt="Texto entrada Blog">
              </picture>
             </div>
             <div class="texto-entrada">
              <a href="entrada.php">
                  <h4>Guía para la decoración de tu hogar</h4>
                  <p>Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>
              </a>
              <p>
                Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.
              </p>
             </div>
          </article>
          <article class="entrada-blog">
            <div class="imagen">
             <picture>
                 <source srcset="build/img/blog3.webp" type="image/webp">
                 <source srcset="build/img/blog3.jpeg" type="image/jpeg">
                 <img src="build/img/blog3.jpg" alt="Texto entrada Blog">
             </picture>
            </div>
            <div class="texto-entrada">
             <a href="entrada.php">
                 <h4>Terraza en el techo de tu casa</h4>
                 <p>Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>
             </a>
             <p>
                 Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
             </p>
            </div>
         </article>
         <article class="entrada-blog">
             <div class="imagen">
              <picture>
                  <source srcset="build/img/blog4.webp" type="image/webp">
                  <source srcset="build/img/blog4.jpeg" type="image/jpeg">
                  <img src="build/img/blog4.jpg" alt="Texto entrada Blog">
              </picture>
             </div>
             <div class="texto-entrada">
              <a href="entrada.php">
                  <h4>Guía para la decoración de tu hogar</h4>
                  <p>Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>
              </a>
              <p>
                Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.
              </p>
             </div>
          </article>

    </main>
    <?php 

incluirTemplate('footer'); 
?>
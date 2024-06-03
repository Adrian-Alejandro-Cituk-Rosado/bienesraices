<?php 

require 'includes/funciones.php';


incluirTemplate('header'); 

?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam optio libero tempore voluptates magni labore cupiditate, voluptate fugiat quas nostrum atque cum perspiciatis quidem iure est illum corrupti delectus. Porro.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia dolore provident pariatur ipsum placeat! Cum voluptatum error ut, soluta consectetur expedita quibusdam quod odit, possimus quisquam neque atque explicabo commodi?</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Rerum ullam, quibusdam sed labore voluptates saepe perferendis iure, impedit,
                    totam illo atque! Sapiente omnis soluta nesciunt voluptatum, itaque ipsum nobis doloremque.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Rerum ullam, quibusdam sed labore voluptates saepe perferendis iure, impedit,
                    totam illo atque! Sapiente omnis soluta nesciunt voluptatum, itaque ipsum nobis doloremque.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Rerum ullam, quibusdam sed labore voluptates saepe perferendis iure, impedit,
                    totam illo atque! Sapiente omnis soluta nesciunt voluptatum, itaque ipsum nobis doloremque.
                </p>
            </div>
        </div>

    </section>
    <?php 

incluirTemplate('footer'); 
?>
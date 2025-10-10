<?php
include_once __DIR__ . '/conferencias.php';
?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque">
            <p class="resumen__texto resume__texto--numero"><?php echo $ponentesTotal ?></p>
            <p class="resumen__texto">speackers</p>
        </div>
        <div class="resumen__bloque">
            <p class="resumen__texto resume__texto--numero"><?php echo $conferenciasTotal ?></p>
            <p class="resumen__texto">conferencias</p>
        </div>
        <div class="resumen__bloque">
            <p class="resumen__texto resume__texto--numero"><?php echo $workshopsTotal ?></p>
            <p class="resumen__texto">workshops</p>
        </div>
        <div class="resumen__bloque">
            <p class="resumen__texto resume__texto--numero">500</p>
            <p class="resumen__texto">asistentes</p>
        </div>
    </div>
</section>

<section class="speackers">
    <h2 class="speackers__heading">Speackers</h2>
    <p class="speackers__descripcion">conoce a nuestros expertos del DevWebCamp</p>
    <div class="speackers__grid">
        <?php foreach ($ponentes as $ponente) { ?>
            <div class="speacker">
                <picture>
                    <source srcset="/img/speakers/<?php echo $ponente->imagen; ?>.webp" type="image/webp">
                    <source srcset="/img/speakers/<?php echo $ponente->imagen; ?>.png" type="image/png">
                    <img class="speacker__imagen" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $ponente->imagen; ?>.png?>" alt="imagen ponente">
                </picture>
                <div class="speacker__informacion">
                    <h4 class="speacker__nombre"><?php echo $ponente->nombre . " " . $ponente->apellido ?></h4>
                    <p class="speacker__ubicacion"><?php echo $ponente->ciudad . "," . $ponente->pais ?></p>
                    <nav class="speacker-sociales">
                        <?php $redes = json_decode($ponente->redes); ?>

                        <?php if (!empty($redes->facebook)) { ?>
                            <a class="speacker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook ?>">
                                <span class="speacker-sociales__ocultar">Facebook</span>
                            </a>
                        <?php } ?>

                        <?php if (!empty($redes->instagram)) { ?>
                            <a class="speacker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram ?>">
                                <span class="speacker-sociales__ocultar">Instagram</span>
                            </a>
                        <?php } ?>

                        <?php if (!empty($redes->github)) { ?>
                            <a class="speacker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github ?>">
                                <span class="speacker-sociales__ocultar">gitHub</span>
                            </a>
                        <?php } ?>

                    </nav>
                    <ul class="speacker__listado-skills">
                        <!-- explode genera un arreglo a partir de un caracter a separar -->
                        <?php $tags = explode(',', $ponente->tags); ?>
                        <?php foreach ($tags as $tag) { ?>
                            <li class="speacker__skill"> <?php echo $tag ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<div class="mapa" id="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos</h2>
    <P class="boletos__descripcion">precios para el DevWebCamp</P>
    <div class="boletos__grid">
        <div class="boleto boleto--presencial">
            <h4 class="boleto__log"> &#60;DevWebCamp/></h4>
            <p class="boleto__plan">presencial</p>
            <p class="boleto__precio">$199</p>
        </div>
        <div class="boleto boleto--virtual">
            <h4 class="boleto__log"> &#60;DevWebCamp/></h4>
            <p class="boleto__plan">virtual</p>
            <p class="boleto__precio">$49</p>
        </div>
        <div class="boleto boleto--gratis">
            <h4 class="boleto__log"> &#60;DevWebCamp/></h4>
            <p class="boleto__plan">gratis</p>
            <p class="boleto__precio">gratis - $0</p>
        </div>
    </div>
    <div class="boleto__enlace-contenedor">
        <a class="boleto__enlace" href="/paquetes">ver paquetes</a>
    </div>
</section>
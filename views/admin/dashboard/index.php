<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">ultimos registros</h3>
            <?php foreach ($registros as $registro) { ?>
                <p class="bloque__texto">
                    <?php echo $registro->usuario->nombre . " " . $registros->usuario->apellido ?>
                </p>
            <?php } ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>
            <p class="bloque__texto--cantidad"> $ <?php echo $ingresos ?></p>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">eventos con menos lugares</h3>
            <?php foreach ($menos as $menor) { ?>
                <p class="bloque__texto">
                    <?php echo $menor->nombre . "-" . $menor->disponibles?>
                </p>
            <?php } ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">eventos con más lugares disponibles</h3>
            <?php foreach ($mas as $mayor) { ?>
                <p class="bloque__texto">
                    <?php echo $mayor->nombre . "-" . $mayor->disponibles ?>
                </p>
            <?php } ?>
        </div>
    </div>


</main>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">informacion del evento</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre del evento</label>
        <input
            type="text"
            class="formulario__input"
            name="nombre"
            id="nombre"
            placeholder="Nombre evento"
            value="<?php

use Model\ponente;

 echo $evento->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">descripcion del evento</label>
        <textarea
            class="formulario__input"
            name="descripcion"
            id="descripcion"
            placeholder="descripcion del evento"
            rows="8"><?php echo $evento->descripcion; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoria o tipo de evento</label>
        <select
            class="formulario__select"
            name="categoria_id"
            id="categoria">
            <option value="">Seleccione una categoria</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected' : ''; ?> value="<?php echo $categoria->id; ?>">
                    <?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="dias">seleccion los días</label>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) { ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>">
                        <?php echo $dia->nombre ?></label>
                    <input
                        name="dia"
                        type="radio"
                        id="<?php echo strtolower($dia->nombre); ?>"
                        value="<?php echo $dia->id ?>"
                        <?php echo ($evento->dia_id === $dia->id) ? 'checked': '';?>
                        />
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id?>">
    </div>
    <div id="horas" class="formulario__campo">
        <label class="formulario__label">seleccion una hora</label>
        <ul id="horas" class="horas">
            <?php foreach ($horas as $hora) { ?>
                <li data-hora-id="<?php echo $hora->id?>" class="horas__hora horas__hora--deshabilitada"><?php echo $hora->hora ?></li>
            <?php } ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Nombre del evento</label>
        <input
            type="text"
            class="formulario__input"
            id="ponentes" 
            placeholder="Buscar Ponentes..." />

            <ul id="Listado-ponentes" class="Listado-ponentes"></ul>
            <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">Nombre del evento</label>
        <input
            type="number"
            min="1"
            class="formulario__input"
            id="disponibles"
            name="disponibles"
            value="<?php echo $evento->disponibles ?>"
            placeholder="selecciona tus lugares disponibles" />
    </div>
</fieldset>
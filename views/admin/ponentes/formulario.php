<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            class="formulario__input"
            name="nombre"
            id="nombre"
            placeholder="Nombre del ponente"
            value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input
            type="text"
            class="formulario__input"
            name="apellido"
            id="apellido"
            placeholder="apellido del ponente"
            value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">ciudad</label>
        <input
            type="text"
            class="formulario__input"
            name="ciudad"
            id="ciudad"
            placeholder="ciudad del ponente"
            value="<?php echo $ponente->ciudad ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="pais">pais</label>
        <input
            type="text"
            class="formulario__input"
            name="pais"
            id="pais"
            placeholder="pais del ponente"
            value="<?php echo $ponente->pais ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input
            type="file"
            class="formulario__input formulario__input--file"
            name="imagen"
            id="imagen" />
    </div>
</fieldset>
<!-- informacion extra -->
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="areas">Áreas de experiencia (separadas por coma)</label>
        <input
            type="text"
            class="formulario__input"
            name="areas"
            id="tags_input"
            placeholder="Ej. Node.js, PHP, JS, CSS, Laravel, ux/ui" />
    </div>
    <div id="tags" class="formulario__listado"></div>
    <input
        type="hidden"
        name="tags"
        value="<?php echo $ponente->tags ?? '' ?>" />
</fieldset>
<!-- redes sociales -->
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[facebook]"
                id="tags_input"
                placeholder="facebook" 
                value="<?php echo $ponente->facebook ?? ''; ?>"
                />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[twitter]"
                id="tags_input"
                placeholder="twitter" 
                value="<?php echo $ponente->twitter ?? ''; ?>"
                />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[youtube]"
                id="tags_input"
                placeholder="youtube" 
                value="<?php echo $ponente->youtube ?? ''; ?>"
                />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[instagram]"
                id="tags_input"
                placeholder="instagram" 
                value="<?php echo $ponente->instagram ?? ''; ?>"
                />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[tiktok]"
                id="tags_input"
                placeholder="tiktok" 
                value="<?php echo $ponente->tiktok ?? ''; ?>"
                />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono"> 
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[github]"
                id="tags_input"
                placeholder="github" 
                value="<?php echo $ponente->github ?? ''; ?>"
                />
        </div>
    </div>
</fieldset>
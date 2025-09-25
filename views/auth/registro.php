<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Crea tu cuenta en DevWebcamp</p>
    
    <?php require_once __DIR__ . '/../templates/alertas.php';?>

    <form class="formulario" method="POST" action="/registro">
        <div class="formulario__campo">
            <label class="formulario__label" for="nombre">Nombre</label>
            <input 
                type="text" 
                class="formulario__input"
                placeholder="tu nombre"
                id="nombre"
                name="nombre"
                value="<?php echo $usuario->nombre?>"
                >
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="apellido">Apellido</label>
            <input 
                type="text" 
                class="formulario__input"
                placeholder="tu apellido"
                id="apellido"
                name="apellido"
                value="<?php echo $usuario->apellido?>"

                >
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="email">email</label>
            <input 
                type="email" 
                class="formulario__input"
                placeholder="tu email"
                id="email"
                name="email"
                value="<?php echo $usuario->email?>"

                >
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password">password</label>
            <input 
                type="password" 
                class="formulario__input"
                placeholder="tu password"
                id="password"
                name="password"
                >
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password2">Repite tu password</label>
            <input 
                type="password" 
                class="formulario__input"
                placeholder="tu password"
                id="password2"
                name="password2"
                >
        </div>
        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>

    <div class="acciones">
        <span class="acciones__enlace--span">¿ya tienes una cuenta? <a href="/login" class="acciones__enlace">Inicia sesion</a></span>
        <span class="acciones__enlace--span">¿olvidaste tu cuenta? <a href="/olvide" class="acciones__enlace">recuperala</a></span>
    </div>
</main>
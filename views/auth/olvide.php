<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Recupera tu acceso en DevWebcamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php';?>
    
    <form class="formulario" method="POST" action="/olvide">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">email</label>
            <input 
                type="email" 
                class="formulario__input"
                placeholder="tu email"
                id="email"
                name="email"
                >
        </div>
        <input type="submit" class="formulario__submit" value="enviar instrucciones">
    </form>

    <div class="acciones">
        <span class="acciones__enlace--span">¿ya tienes una cuenta? <a href="/login" class="acciones__enlace">Inicia sesion</a></span>
        <span class="acciones__enlace--span">¿aun no tienes una cuenta? <a href="/registro" class="acciones__enlace">obtener una</a></span>
    </div>
</main>
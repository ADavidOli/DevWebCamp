<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Coloca tu nuevo password</p>
    <?php require_once __DIR__ . '/../templates/alertas.php';?>
    <?php if($token_valido){?>
   
    <form class="formulario" method="POST">
        <div class="formulario__campo">
            <label class="formulario__label" for="password">Nuevo Password</label>
            <input 
                type="password" 
                class="formulario__input"
                placeholder="tu nuevo password"
                id="password"
                name="password"
                >
        </div>
        <input type="submit" class="formulario__submit" value="Guardar password">
    </form>
    <?php }?>
    
    <div class="acciones">
        <span class="acciones__enlace--span">¿ya tienes una cuenta? <a href="/login" class="acciones__enlace">Inicia sesion</a></span>
        <span class="acciones__enlace--span">¿aun no tienes una cuenta? <a href="/registro" class="acciones__enlace">obtener una</a></span>
    </div>
</main>
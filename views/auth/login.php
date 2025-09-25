<!-- iniciamos creacion con metodoologia BEM -->
<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Bienvenido, para empezar inicia sesion en DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php';?>
    
    <form class="formulario" method="POST" action="/login">
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
        <input type="submit" class="formulario__submit" value="iniciar sesion">
    </form>

    <div class="acciones">
        <span class="acciones__enlace--span">¿aun no tienes cuenta? <a href="/registro" class="acciones__enlace"> obtener una</a></span>
        <span class="acciones__enlace--span">¿olvidaste tu cuenta? <a href="/olvide" class="acciones__enlace">recuperala</a></span>
    </div>
</main>
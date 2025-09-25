<!-- iniciamos creacion con metodoologia BEM -->
<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo?></h2>
    <p class="auth__texto">
        ya estás cerca de DevWebcamp, solo confirma tu cuenta de registro.
    </p>
    <?php require_once __DIR__ . '/../templates/alertas.php';?>
    <?php if(isset($alertas['exito'])){?>
   
    <div class="acciones--centrar">
        <span class="acciones__enlace--span">¿ya estas listo? <a href="/login" class="acciones__enlace">iniciar sesion</a></span>
    </div>
    <?php }?>
</main>
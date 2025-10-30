<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo?></h2>
    <p class="registro__descripcion">elige tu plan para completar tu registro</p>

      <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre"> pase gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Accesso virtual a DevWebCamp</li>
                <P class="paquete__precio"> $0</P>

                <form action="/finalizar-registro/gratis" method="POST">
                    <input class="paquetes__submit" type="submit" value="inscripcion gratis">
                </form>

            </ul>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">acceso presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Accesso presencial a DevWebCamp</li>
                <li class="paquete__elemento">pase por dos días</li>
                <li class="paquete__elemento">acceso a talleres y conferencias</li>
                <li class="paquete__elemento">acceso a las grabaciones</li>
                <li class="paquete__elemento">camisa del evento</li>
                <li class="paquete__elemento">comida y bebida</li>
                <P class="paquete__precio"> $199</P>
            </ul>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">acceso virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Accesso virtual a DevWebCamp</li>
                <li class="paquete__elemento">pase por dos días</li>
                <li class="paquete__elemento">acceso a talleres y conferencias</li>
                <li class="paquete__elemento">acceso a las grabaciones</li>
                <P class="paquete__precio"> $199</P>
            </ul>
        </div>
    </div>


</main>
<h2><?php echo $titulo ?></h2>

<div class="dashboard__contenedor">
    <div class="dashboard__contenedor--sm">
        <div class="search">
            <form class="search__formulario" action="/admin/ponentes/search" method="GET">
                <input
                    type="text"
                    name="valor"
                    class="search__input"
                    id="search"
                    placeholder="buscar por nombre" />
                <button class="search__boton" type="submit">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>
        </div>
        <a class="dashboard__boton" href="/admin/ponentes/crear">
            <i class="fa-solid fa-circle-plus"></i>
            Añadir ponente
        </a>
    </div>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($ponentes)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicacion</th>
                    <th scope="col" class="table__th">acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($ponentes as $ponente) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $ponente->nombre . " " . $ponente->apellido; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $ponente->ciudad . "," . $ponente->pais; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/ponentes/editar?id=<?php echo $ponente->id ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                editar</a>
                            <form class="table__formulario" method="POST" action="/admin/ponentes/eliminar">
                                <input type="hidden" name="id" value="<?php echo $ponente->id ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center"> ningun ponente registrado</p>
    <?php } ?>
</div>

<?php echo $paginacion ?>
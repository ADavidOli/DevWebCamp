<h2><?php echo $titulo ?></h2>

<div class="dashboard__contenedor">
    <div class="dashboard__contenedor--sm">
        <div class="search">
            <form class="search__formulario" action="/admin/eventos/search" method="GET">
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
        <a class="dashboard__boton" href="/admin/eventos/crear">
            <i class="fa-solid fa-circle-plus"></i>
            Añadir evento
        </a>
    </div>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($eventos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">categoria</th>
                    <th scope="col" class="table__th">Dia y hora</th>
                    <th scope="col" class="table__th">ponente</th>
                    <th scope="col" class="table__th">acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($eventos as $evento) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $evento->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->categoria->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->dia->nombre . " " . $evento->hora->hora; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->ponente->nombre; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento->id ?>">
                                <i class="fa-solid fa-pencil"></i>
                                editar</a>
                            <form class="table__formulario" method="POST" action="/admin/eventos/eliminar">
                                <input type="hidden" name="id" value="<?php echo $evento->id ?>">
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
        <p class="text-center"> ningun evento registrado</p>
    <?php } ?>
</div>

<?php echo $paginacion ?>
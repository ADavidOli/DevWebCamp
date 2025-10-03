(function () {
  const horas = document.querySelector("#horas");

  if (horas) {
    // obteniendo los datos del lado del cliente y llenarlo a un objeto en memoria.
    const categoria = document.querySelector('[name="categoria_id"]');
    const dias = document.querySelectorAll('[name="dia"]');
    const inputOcultoDia = document.querySelector('[name="dia_id"]');
    const inputOcultohora = document.querySelector('[name="hora_id"]');

    categoria.addEventListener("change", terminoBusqueda);
    // asi pasamos los valores de un input
    dias.forEach((dia) => dia.addEventListener("change", terminoBusqueda));
    // crear un objeto en memori para mandar los datos.

    let busqueda = {
      categoria_id: +categoria.value || "",
      dia: +inputOcultoDia.value || "",
    };

    if (!Object.values(busqueda).includes("")) {
      buscarEventos();
    }

    // resaltar la hora actual.
    // console.log(inputOcultohora.value);
    const id = inputOcultohora.value;
    const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
    console.log(horaSeleccionada.);


    function terminoBusqueda(e) {
      busqueda[e.target.name] = e.target.value;
      // reiniciar valores
      inputOcultohora.value = "";
      inputOcultoDia.value = "";

      const horaPrevia = document.querySelector(".horas__hora--seleccionada");
      if (horaPrevia) {
        horaPrevia.classList.remove("horas__hora--seleccionada");
      }

      // si al menos uno de estos dos campos dentro del objeto esta vacio se sale
      if (Object.values(busqueda).includes("")) {
        return;
      }
      buscarEventos();
    }

    async function buscarEventos() {
      // **conexcion a una API***
      const { dia, categoria_id } = busqueda;
      const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
      // verifica si se pudo contectar correctamente
      const resultado = await fetch(url);
      // trae de la bd utilizando la conexion de la api en formato json
      const eventos = await resultado.json();
      //**fin de la conexion a una API***/
      obtenerHorasDisponibles(eventos);
    }

    function obtenerHorasDisponibles(eventos) {
      // reiniciar las horas
      const listadoHoras = document.querySelectorAll("#horas li");
      listadoHoras.forEach((li) =>
        li.classList.add("horas__hora--deshabilitada")
      );

      // comprobar los eventos tomados y quitar la variable desahabilitada
      const horasTomadas = eventos.map((evento) => evento.hora_id);
      // convertir listadohoras en una arrreglo porque te da un nodelist
      const listadoHorasArray = Array.from(listadoHoras);

      const resultado = listadoHorasArray.filter(
        (li) => !horasTomadas.includes(li.dataset.horaId)
      );

      // listar las horas que no tengan clase.
      resultado.forEach((li) =>
        li.classList.remove("horas__hora--deshabilitada")
      );

      const horasDisponibles = document.querySelectorAll(
        "#horas li:not(.horas__hora--deshabilitada)"
      );

      horasDisponibles.forEach((hora) =>
        hora.addEventListener("click", seleccionarHora)
      );
    }

    function seleccionarHora(e) {
      // desahabilitar la hora previa si hay un nuevo click
      const horaPrevia = document.querySelector(".horas__hora--seleccionada");
      if (horaPrevia) {
        // si hay una horaprevia entonces se le quita a la ya seleccionada.
        horaPrevia.classList.remove("horas__hora--seleccionada");
      }
      // agregar clase
      e.target.classList.add("horas__hora--seleccionada");
      // .dataset lee los valores que tenga los data personalizados  en html"data-"
      inputOcultohora.value = e.target.dataset.horaId;

      //   llenar el campo oculto del día.
      inputOcultoDia.value = document.querySelector(
        '[name="dia"]:checked'
      ).value;
    }
  }
})();

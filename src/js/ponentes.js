(function () {
  const ponentesInput = document.querySelector("#ponentes");
  if (ponentesInput) {
    let ponentes = [];
    let ponentesFiltrados = [];
    const listadoPonentes = document.querySelector("#Listado-ponentes");
    const ponenteHidden = document.querySelector('[name="ponente_id"]');

    obtenerPonentes();
    ponentesInput.addEventListener("input", buscarPonentes);

    if(ponenteHidden.value){
      (async()=>{
        const ponente = await obtenerPonente(ponenteHidden.value);
        // insertar en el html
        const ponenteDom = document.createElement('LI');
        ponenteDom.classList.add('Listado-ponentes__ponente', 'Listado-ponentes__ponente--seleccionado');
        ponenteDom.textContent = `${ponente.nombre} ${ponente.apellido}`;
        listadoPonentes.appendChild(ponenteDom);
      })();
    }

    async function obtenerPonentes() {
      const url = `/api/ponentes`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();
      formatearPonentes(resultado);
    }

    async function obtenerPonente(id) {
      const url = `/api/ponente?id=${id}`;
      const respuesta = await fetch(url);    
      const resultado = await respuesta.json();
      return resultado;
    }


    function formatearPonentes(array = []) {
      ponentes = array.map((ponente) => {
        return {
          nombre: `${ponente.nombre.trim()} ${ponente.apellido}`,
          id: ponente.id,
        };
      });
    }

    function buscarPonentes(e) {
      const entrada = e.target.value;
      // si la entrada del input es más de 3 caracteres comienza a buscar
      if (entrada.length > 3) {
        // sin importar que sea mayus o minus, que funcione la busqueda.
        // para ellos utilizar expresiones regulares.
        const expresion = new RegExp(entrada, "i");
        ponentesFiltrados = ponentes.filter((ponente) => {
          if (ponente.nombre.toLowerCase().search(expresion) != -1) {
            return ponente;
          }
        });
      } else {
        ponentesFiltrados = [];
      }
      mostrarPonente();
    }

    function mostrarPonente() {
      // limpiamos, cada vez que haya una nueva busqueda
      while (listadoPonentes.firstChild) {
        listadoPonentes.removeChild(listadoPonentes.firstChild);
      }
      if (ponentesFiltrados.length > 0) {
        ponentesFiltrados.forEach((ponente) => {
          const ponenteHtml = document.createElement("LI");
          ponenteHtml.classList.add("Listado-ponentes__ponente");
          ponenteHtml.textContent = ponente.nombre;
          ponenteHtml.dataset.ponenteId = ponente.id;
          ponenteHtml.onclick = seleccionarPonente;
          // añadir al dom.
          listadoPonentes.appendChild(ponenteHtml);

        });
      } else {
        const noResultados = document.createElement("P");
        noResultados.classList.add('listado-ponente__noresultado');
        noResultados.textContent = `no hay resultados`;
        listadoPonentes.appendChild(noResultados);

      }
    }

    function seleccionarPonente(e){
      const ponenteSeleccionado = e.target;
      // remover la clas previa.
      const ponentePrevio = document.querySelector('.Listado-ponentes__ponente--seleccionado');
      if(ponentePrevio){
        ponentePrevio.classList.remove('Listado-ponentes__ponente--seleccionado');
      }
      ponenteSeleccionado.classList.add('Listado-ponentes__ponente--seleccionado');
      ponenteHidden.value = ponenteSeleccionado.dataset.ponenteId;
      
    }
  }
})();

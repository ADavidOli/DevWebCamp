(function () {
  const tags_input = document.querySelector('#tags_input');
  if (tags_input) {
    const tagsDiv = document.querySelector('#tags');
    const tagsInputHidden = document.querySelector('[name="tags"]');

    let tags = [];
    // escuchar los cambios en el input.
    tags_input.addEventListener("keypress", guardartag);
    function guardartag(evt) {
      if (evt.keyCode === 44) {
        if (evt.target.value.trim() === "" || evt.target.value < 1) {
          return;
        }
        evt.preventDefault();
        tags = [...tags, evt.target.value.trim()]; // esto nos va arrojando lo que pone el usuario despues de la coma
        tags_input.value = ""; //limpiamos el input
        mostrarTags();
      }
    }

    function mostrarTags() {
        tagsDiv.textContent = '';
        // empezamos a iterar la etiquetas para agregar al html
        tags.forEach(tag=>{
              const etiqueta = document.createElement('LI');
              etiqueta.classList.add('formulario__tag');
              etiqueta.textContent = tag;
              etiqueta.ondblclick = eliminarTag;
              tagsDiv.appendChild(etiqueta);
        });
        actualizarInputHidden();
    }
    function actualizarInputHidden(){
        tagsInputHidden.value = tags.toString();
    }

    function eliminarTag(e){
        // eliminamos en memoria con el target presionado
        e.target.remove();
        //filtramos sobre el mismo arreglo de tags
        tags = tags.filter(tag=>tag !== e.target.textContent);
        // actualizamos nuestro hidden.
        actualizarInputHidden();
    }
    //aqui acaba el if, si es que hay un id, de tags_input
  }
})();

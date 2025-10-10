if (document.querySelector("#mapa")) {
 const lat = 19.5504715;
 const log = -96.9191994;
 const zoom = 16;

  var map = L.map("mapa").setView([lat, log], zoom);
  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  L.marker([lat, log])
    .addTo(map)
    .bindPopup(`
            <h2 class="mapa__heading">DevWebCamp</h2>
            <p class="mapa__texto">Centro de convenciones de xalapa</p>
        `)
    .openPopup();
}

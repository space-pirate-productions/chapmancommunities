import L from 'leaflet';
import $ from 'jquery';

const locationMap = {
  init() {
    var map = L.map('cc-locations-map').setView([38.626418, -90.199838], 5);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
      }).addTo(map);

    let locations = $('#cc-locations-map').data('locations');

    for (const key in locations) {
      if (Object.hasOwnProperty.call(locations, key)) {
        const element = locations[key];
        L.marker([element['lat'], element['long']]).addTo(map).bindPopup(element['name'])
      }
    }
  }
}

export default locationMap;

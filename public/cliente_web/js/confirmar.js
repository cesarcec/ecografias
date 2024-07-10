

const formatAction = (element) => {
    return `
    <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i>Editar</button>
    <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i>Eliminar</button>`;
};

const formatActionRestore = (element) => {
    return `
    <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i>Restaurar</button>`;
};

const apiClient = new ApiClient(URL_API_REST);
const config = {
    table: $("#table"),
    tableDeletes: $("#table-delete"),
    // loaderObject: loader,
    modalEdit: "modal_edit",
    saveBtn: "save",
    updateBtn: "update",
    editShowBtn: ".edit",
    deleteBtn: ".delete",
    restoreBtn: ".restore",
    labelPrefixEdit: "_edit",
    selectors: [
        "id",
        "nombre",
        "latitud",
        "longitud",
        "referencia",
        "resultado_id",
    ],
    loadRelations: false,
    formatAction: formatAction,
    formatActionRestore: formatActionRestore,
};

const crudHandler = new CrudHandler(apiClient, "envio", config);

async function initMap2() {
    const { Map } = await google.maps.importLibrary("maps");
  
    const map = new Map(document.getElementById("map"), {
      center: { lat: -34.397, lng: 150.644 },
      zoom: 8,
    });
  }


/// GOOGLE MAPS
function initMap() {
    const latitud = -17.7962;
    const longitud = -63.1814;
    // $("#latitud").val(latitud);
    // $("#longitud").val(longitud);
    var myLatLng = { lat: latitud, lng: longitud };
    var mapOptions = {
      center: myLatLng,
      zoom: 8,
      streetViewControl: false,
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      draggable: true,
      title: 'Mi marcador',
    });

    markerListenerDragend(marker);
    mapListenerClick(map, marker);
    initAutoComplete(map, marker);
}

function mapListenerClick(map, marker) {
    map.addListener('click', function(event) {
        const clickedLat = event.latLng.lat();
        const clickedLng = event.latLng.lng();

        marker.setPosition(event.latLng);

        $("#latitud").val(clickedLat);
        $("#longitud").val(clickedLng);

        localizacionInversa(event);

    });
}

function markerListenerDragend(marker) {
    google.maps.event.addListener(marker, 'dragend', function(event) {
        const latitud = this.getPosition().lat();
        const longitud = this.getPosition().lng();

        $("#latitud").val(latitud);
        $("#longitud").val(longitud);

        localizacionInversa(event);

    });
}

function initAutoComplete(map, marker) {
    const inputDireccionCliente = document.getElementById("referencia");

    //establecer limites geográficos para Bolivia
    const center = {
        lat: -16.290154,
        lng: -63.588653
    };

    const defaultBounds = {
        north: center.lat + 0.5, 
        south: center.lat - 0.5, 
        east: center.lng + 0.5, 
        west: center.lng - 0.5, 
    };

    const options = {
        bounds: defaultBounds, 
        componentRestrictions: { country: "bo" }, 
        fields: ["address_components", "geometry", "icon", "name"],
        strictBounds: false,
        types: [],
    };

    let autoComplete = new google.maps.places.Autocomplete(inputDireccionCliente, options);

    autoComplete.addListener('place_changed', function(){
        const place = autoComplete.getPlace();

        if (place.geometry && place.geometry.location) {
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            $("#latitud").val(place.geometry.location.lat());
            $("#longitud").val(place.geometry.location.lng());

            smoothZoom(map, 13, 500);

        } else {
            console.log("La ubicación del lugar no está definida correctamente.");
        }
    });
}

function localizacionInversa(event) {
    // Obtener la dirección inversa utilizando Geocoding
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'location': event.latLng }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                const formattedAddress = results[0].formatted_address;
                $("#referencia").val(formattedAddress);
            }
        }
    });
}

// Función para realizar el zoom suave
function smoothZoom(map, targetZoom, duration) {
    const currentZoom = map.getZoom();
    const steps = Math.abs(currentZoom - targetZoom);
    const delay = duration / steps;

    if (currentZoom < targetZoom) {
      for (let i = currentZoom; i < targetZoom; i++) {
        setTimeout(function () {
          map.setZoom(i + 1);
        }, i * delay);
      }
    } else if (currentZoom > targetZoom) {
      for (let i = currentZoom; i > targetZoom; i--) {
        setTimeout(function () {
          map.setZoom(i - 1);
        }, (currentZoom - i) * delay);
      }
    }
}

function ubicacionActual() {
    return new Promise(function(resolve, reject) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                resolve(pos);

            }, function() {
                reject("Error al obtener la ubicación");
            });
        } else {
            reject("El navegador no soporta la geolocalización");
        }
    });
}

function ubicacionActualReady() {
    ubicacionActual()
        .then((posicion) => {

            localizacionInversa({ latLng: posicion });
            $("#latitud").val(posicion.lat);
            $("#longitud").val(posicion.lng);
            
            map.setCenter(posicion);
            marker.setPosition(posicion);

            smoothZoom(map, 13, 500);

            console.log('Ubicación obtenida correctamente:', posicion);
        })
        .catch((error) => {
            initMap();
            console.log("Error al obtener la ubicación:", error);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initMap();
});

$("#save").click(() => {
    crudHandler.postInsert();
    setTimeout(() => {
        window.location.href = URL_WEB + 'cliente-envios';
    }, 1500);
});

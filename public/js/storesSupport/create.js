let autocomplete;

function initMap() {
    let elementMap = document.getElementById("map");
    let optionsMap = {
        center : {lat : -8.11167, lng : -79.0286},
        zoom : 12
    } 
    let map = new google.maps.Map(elementMap, optionsMap);
    let marker = new google.maps.Marker({map});

    let input = document.getElementById("autocomplete");
    let options = {
        types : ["establishment"],
        componentRestrictions : {"country" : "PE"},
    }

    autocomplete = new google.maps.places.Autocomplete(input, options);
    let infowindow = new google.maps.InfoWindow();

    autocomplete.addListener('place_changed', () => {
        infowindow.close();
        let place = autocomplete.getPlace();

        if(!place.geometry) {
            alert("No hay detalles disponibles para la entrada : " + place.name);
            return;
        } 

        $('#lat').val(place.geometry.location.lat());
        $('#long').val(place.geometry.location.lng());

        let address = '';

        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        map.fitBounds(place.geometry.viewport);
        marker.setPosition(place.geometry.location);

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
    });
}
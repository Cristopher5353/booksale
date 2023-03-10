$("#departament").val($("#departament_selected").val());
$("#province").val($("#province_selected").val());
$("#district").val($("#district_selected").val());

let geocoder;
let map;
let autocomplete;
let direction = $("#store_direction").val();
let marker;
let infowindow;

function codeDirection (geocoder, map) {
    geocoder.geocode({'address': direction}, function(results, status) {
        if (status === 'OK') {
            let address = results[0].formatted_address;
            infowindow = new google.maps.InfoWindow();
            
            map.setCenter(results[0].geometry.location);
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            infowindow.setContent('<div><strong>' + address + '</strong><br>');
            infowindow.open(map, marker);
        } else {
            alert('Geocode no tuvo éxito por la siguiente razón: ' + status);
        }
    });
}

function initMap() {
    let lat = parseFloat($("#lat").val());
    let long = parseFloat($("#long").val());

    let elementMap = document.getElementById("map");
    let optionsMap = {
        center : {lat : lat, lng : long},
        zoom : 12
    } 
    map = new google.maps.Map(elementMap, optionsMap);
    
    let input = document.getElementById("autocomplete");
    let options = {
        types : ["establishment"],
        componentRestrictions : {"country" : "PE"},
    }
    
    autocomplete = new google.maps.places.Autocomplete(input, options);

    geocoder = new google.maps.Geocoder();
    codeDirection(geocoder, map);

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
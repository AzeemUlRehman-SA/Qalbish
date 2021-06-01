function initialize() {

    ;

    $('form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    var address = $('.map-input').val();
    var input = $('.map-input')[0];
    var city = "Lahore";
    var postal = "546000";
    var state = "Pakistan";
    // var address = street + ',' + city + ',' + state + ',' + postal;
    var geocoder = new google.maps.Geocoder();
    var autocompletes = [];
    var fieldKey = "address";
    const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';
    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $('#address-latitude').val(latitude);
            $('#address-longitude').val(longitude);

            const map = new google.maps.Map(document.getElementById('address-map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 14
            });

            const marker = new google.maps.Marker({
                map: map,
                position: {lat: latitude, lng: longitude},
                draggable: true,
                animation: google.maps.Animation.DROP,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true,
                rotateControl: true
            });
            var position = marker.getPosition();
            var radius = 3000;

            var circle = new google.maps.Circle({
                center: position,
                radius: radius,
                fillColor: "#0000FF",
                fillOpacity: 0.3,
                map: map,
                strokeColor: "#FFFFFF",
                strokeOpacity: 0.1,
                strokeWeight: 2
            });

            circle.bindTo('center', marker, 'position');
            var infowindow;
            infowindow = new google.maps.InfoWindow({
                content: address
            });
            marker.setVisible(isEdit);


            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = "address";
            autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});

            google.maps.event.addListener(marker, 'dragend', function (event) {

                geocoder.geocode({'latLng': event.latLng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {

                            $('.map-input').val(results[0].formatted_address);

                            infowindow = new google.maps.InfoWindow({
                                content: results[0].formatted_address
                            });
                        }
                    }
                });
                $('#address-latitude').val(event.latLng.lat());

                $('#address-longitude').val(event.latLng.lng());


            });


            google.maps.event.addListener(marker, 'mouseover', function () {
                infowindow.open(map, marker);

            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                infowindow.close(map, marker);

            });
        }
    });


}





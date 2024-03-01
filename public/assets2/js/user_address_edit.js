
    jQuery(function($){
    $("#yourphone").mask("(999) 999 - 9999");

});

    $(document).ready(function(){

});


    function initMap() {

    var lat=document.getElementById("latitude").value;
    var long=document.getElementById("longitude").value;

    var latitude = parseFloat(lat);
    var longitude = parseFloat(long);

    // The location of Uluru
    var uluru = {lat: latitude, lng: longitude};
    var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 15, center: uluru});
    // The map, centered at Uluru
    // var map = new google.maps.Map(
    // document.getElementById('map'), {zoom: 15, center: uluru});
    // // The marker, positioned at Uluru
    // var marker = new google.maps.Marker({position: uluru, map: map});

    // var map = new google.maps.Map(document.getElementById('map'), {
    //     center: {lat: 55.585901, lng: -105.750596},
    //     zoom: 5,

    // });
    var options = {
    types: ['geocode'],  // or '(cities)' if that's what you want?
    componentRestrictions: {country:["us","ca"]}
};
    var marker = new google.maps.Marker({position: uluru, map: map});
    var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};
    var input = /** @type {!HTMLInputElement} */(document.getElementById('pac-input'));
    var types = document.getElementById('type-selector');
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input,options);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
});

    autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();

    if (!place.geometry) {
    // User entered the name of a Place that was not suggested and
    // pressed the Enter key, or the Place Details request failed.
    window.alert("No details available for input: '" + place.name + "'");
    return;
}

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
} else {
    map.setCenter(place.geometry.location);
    map.setZoom(17);  // Why 17? Because it looks good.
}
    marker.setIcon(/** @type {google.maps.Icon} */({
    url: place.icon,
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(35, 35)
}));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    var item_Lat =place.geometry.location.lat()
    var item_Lng= place.geometry.location.lng()
    var item_Location = place.formatted_address;
    //alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
    $("#lat").val(item_Lat);
    $("#lng").val(item_Lng);
    $("#location").val(item_Location);
    $("#location1").val(item_Location);

    var address = '';
    if (place.address_components) {
    address = [
    (place.address_components[0] && place.address_components[0].short_name || ''),
    (place.address_components[1] && place.address_components[1].short_name || ''),
    (place.address_components[2] && place.address_components[2].short_name || '')
    ].join(' ');
}
    for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
}
    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
    var val = place.address_components[i][componentForm[addressType]];
    document.getElementById(addressType).value = val;
}
}
    console.log(val);
    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
});

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    /*radioButton.addEventListener('click', function() {
    autocomplete.setTypes(types);
    });*/
}

    setupClickListener('changetype-all', []);
    setupClickListener('changetype-address', ['address']);
    setupClickListener('changetype-establishment', ['establishment']);
    setupClickListener('changetype-geocode', ['geocode']);
}

    incrementVar = 1;
    function incrementValue(elem){
    var $this = $(elem);
    $input = $this.prev('input');
    $parent = $input.closest('div');
    newValue = parseInt($input.val())+1;
    $parent.find('.inc').addClass('a'+newValue);
    $input.val(newValue);
    incrementVar += newValue;
}
    function decrementValue(elem){
    var $this = $(elem);
    $input = $this.next('input');
    $parent = $input.closest('div');
    newValue = parseInt($input.val())-1;
    $parent.find('.inc').addClass('a'+newValue);
    if(newValue <= 1){
    $input.val(1);
}else{
    $input.val(newValue);
}
    incrementVar += newValue;
}

    function myMap() {
    var mapProp= {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
};
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
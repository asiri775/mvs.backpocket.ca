
    var customerData = {!! json_encode($customer_array,true) !!};
    var coordinations = JSON.parse(customerData);
    var newCordinations = [];
    var map = [];

    function initMap(mapdata = coordinations) {
    let latitude = parseFloat(coordinations[0][1]);
    let longtude = parseFloat(coordinations[0][2]);
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: {lat: latitude, lng: longtude}
});
    setMarkers(map,mapdata);
}

    function setMarkers(map,mapDetails = coordinations) {
    var lookup = [];
    for (let i = 0; i < mapDetails.length; i++) {
    let item = mapDetails[i];

    let latitude = parseFloat(item[1]);
    let longtude = parseFloat(item[2]);
    let information = '';
    let orderid = item[6];
    let existingMarker = getExistingMarker(lookup, [latitude, longtude]);
    if ((existingMarker == 0 || existingMarker != null)) {
    if (lookup[existingMarker][3] != orderid) {
    information = lookup[existingMarker][2] + '<hr><div><strong>Client: </strong>' + item[0] + '<div><br>'
    + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
    + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div>'
    + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';
    lookup[existingMarker][2] = information;
} else {
    continue;
}
} else {
    information = '<div><strong>Client: </strong>' + item[0] + '<div><br>'
    + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
    + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div>'
    + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';
    lookup[i] = [latitude, longtude, information, orderid];
}
    let infoWindow = new google.maps.InfoWindow({
    content: information
});

    let marker = new google.maps.Marker({
    position: {lat: latitude, lng: longtude},
    map: map,
    title: item[0],
});

    marker.addListener('click', function () {
    if (!marker.open) {
    infoWindow.open(map, marker);
    marker.open = true;
} else {
    infoWindow.close();
    marker.open = false;
}
    google.maps.event.addListener(map, 'click', function () {
    infoWindow.close();
    marker.open = false;
});
});
}
}

    function getExistingMarker(lookup, search) {
    if (lookup.length > 0) {
    for (let i = 0, l = lookup.length; i < l; i++) {
    if (lookup[i] && lookup[i].length > 0) {
    if (lookup[i][0] === search[0] && lookup[i][1] === search[1]) {
    return i;
}
}

}
    return null;
}
    return null;
}

    function getClientDetails() {

    var search = $('input[type=search]').val();
    newCordinations = [];
    for (let i = 0; i < coordinations.length; i++) {
    let item = coordinations[i];

    if(item[0].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else if(item[3].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else if(item[4].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else if(item[5].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else if(item[6].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else if(item[7].toLowerCase().includes(search.toLowerCase())){
    newCordinations.push(item);
}else{
    continue;
}
}
    initMap(newCordinations);
    let latitude = parseFloat(newCordinations[0][1]);
    let longtude = parseFloat(newCordinations[0][2]);
    map.setCenter({
    lat: latitude,
    lng: longtude
});
}

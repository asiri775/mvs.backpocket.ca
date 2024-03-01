
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

    function setMarkers(map, mapDetails = coordinations) {
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
    information = lookup[existingMarker][2] + '<hr><div><strong>Order ID: </strong><a href="/vendor/details/' + orderid + '">' + orderid + '</a><div><br>'
    + '<div><strong>Client: </strong>' + item[0] + '<div><br>'
    + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
    + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
    + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div>';

    lookup[existingMarker][2] = information;
} else {
    continue;
}
} else {
    information = '<div><strong>Order ID: </strong><a href="/vendor/details/' + orderid + '">' + orderid + '</a><div><br>'
    + '<div><strong>Client: </strong>' + item[0] + '<div><br>'
    + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
    + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
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

    if (item[0].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[3].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[4].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[5].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[6].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[7].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[8].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[9].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
} else if (item[10].toLowerCase().includes(search.toLowerCase())) {
    newCordinations.push(item);
}  else {
    continue;
}
}
    initMap(newCordinations);
    console.log(newCordinations);
    let latitude = parseFloat(newCordinations[0][1]);
    let longtude = parseFloat(newCordinations[0][2]);
    map.setCenter({
    lat: latitude,
    lng: longtude
});
}


        $(document).ready(function() {
        $('#table_1').DataTable({
            dom: 'lBfrtip',
            select: true,
            ordering: true,
            "pageLength": 50,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'All']
            ],
            buttons: [{
                extend: 'excel',
                text: '<i style="color:green" class="fa fa-file-excel-o fa-2x"></i>&nbsp; Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                title: 'Order History',
            },
                {
                    extend: 'csv',
                    text: '<i style="color:blue" class="fa fa-file-text-o fa-2x"></i>&nbsp; CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: 'Order History',
                },
                {
                    extend: 'pdf',
                    text: '<i style="color:red" class="fa fa-file-pdf-o fa-2x"></i>&nbsp; PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: 'Order History',
                },
                {
                    extend: 'print',
                    text: '<i style="color:black" class="fa fa-print fa-2x"></i>&nbsp; Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: 'Order History',
                }
            ]
        });
    });

        var Timer;
        $('#table_1').on('search.dt', function () {
        clearTimeout(Timer);
        Timer = setTimeout(SendRequest, 1000);
    });

        function SendRequest() {

        getClientDetails();
    }

        //toggle button

        $('#map_toggle').change(function(){
        var boxWidth = $(".main-row").width();
        if ($(window).width() > 992) {
        if ($('#map_toggle').is(':checked')) {
        $('#map_toggle_txt').text('Hide Map');
        $('.left-tab').animate({
        width: (boxWidth / 2) - 22
    });
        $('.right-tab').show(1000);
    } else {
        $('#map_toggle_txt').text('Show Map');
        $('.left-tab').animate({
        width: boxWidth - 48
    });
        $('.right-tab').hide();
    }
    }else{
        if ($('#map_toggle').is(':checked')) {
        $('#map_toggle_txt').text('Hide Map');
        $('.left-tab').hide()
        $('.right-tab').show();
    } else {
        $('#map_toggle_txt').text('Show Map');
        $('.left-tab').show();
        $('.right-tab').hide();
    }
    }
    });
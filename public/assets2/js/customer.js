
    $(document).ready(function() {

    $.blockUI.defaults = {

        message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

        title: null,

        draggable: true,

        theme: false,

        css: {
            padding: 0,
            margin: 0,
            width: '45%',
            top: '10%',
            left: '30%',
            textAlign: 'center',
            color: '#000',
            border: '3px solid #aaa',
            backgroundColor: '#fff'
            //cursor: 'wait'
        },

        themedCSS: {
            width: '30%',
            top: '40%',
            left: '35%'
        },

        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.6
            //cursor: 'wait'
        },

        cursorReset: 'default',

        growlCSS: {
            width: '350px',
            top: '10px',
            left: '',
            right: '10px',
            border: 'none',
            padding: '5px',
            opacity: 0.6,
            cursor: null,
            color: '#fff',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px'
        },

        iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

        forceIframe: false,

        baseZ: 1000,

        centerX: true,

        centerY: true,

        allowBodyStretch: true,

        bindEvents: true,

        constrainTabKey: true,

        fadeIn: 200,

        fadeOut: 400,

        timeout: 0,

        showOverlay: true,

        focusInput: true,

        onBlock: null,

        onUnblock: null,

        quirksmodeOffsetHack: 4,

        blockMsgClass: 'blockMsg',

        ignoreIfBlocked: false
    };



    /*$('.btn-next').click(function(){
        var next_step = $(this).data('next');
        if(next_step == "step2"){
            $('.step-pane.step1').hide();
            $("li[data-target='step1']").removeClass('active');
            $('.step-pane.step2').show();
            $("li[data-target='step2']").addClass('active');
        }
    });*/

    $('.js-select_button').click(function() {
    var next_step = $(this).data('next');
    if (next_step == "step2") {
    $('.step-pane.step1').hide();
    $("li[data-target='step1']").removeClass('active');
    $('.step-pane.step2').show();
    $("li[data-target='step2']").addClass('active');
}
});

    $('.btn-prev').click(function() {
    var prev_step = $(this).data('prev');
    if (prev_step == "step1") {
    $('.step-pane.step2').hide();
    $("li[data-target='step2']").removeClass('active');
    $('.step-pane.step1').show();
    $("li[data-target='step1']").addClass('active');
}
});

    $('#txt_search_by_name').keypress(function(e) {

    var search_length = $(this).val().trim().length;

    var key = e.which;
    if (key == 13) {
    if (search_length < 3) {
    $('.resultsMessage').show();
    $(".resultsTable").hide();
} else {
    $.ajax({
    type: "GET",
    url: '',
    data: {
    'keyword': $(this).val()
},
    success: function(data) {
    $('.resultsMessage').hide();
    $(".resultsTable").show();
    $(".resultsTable").html(data);
}
});
}
}
});

    $('#txt_search_by_phone').keypress(function(e) {

    var search_length = $(this).val().trim().length;

    var key = e.which;
    if (key == 13) {
    if (search_length < 3) {
    $('.resultsMessage').show();
    $(".resultsTable").hide();
} else {
    $.ajax({
    type: "GET",
    url: '',
    data: {
    'phone': $(this).val()
},
    success: function(data) {
    $('.resultsMessage').hide();
    $(".resultsTable").show();
    $(".resultsTable").html(data);
}
});
}
}
});

    $('#doSearch').click(function() {
    var search_name_length = $('#txt_search_by_name').val().trim().length;
    var search_phone_length = $('#txt_search_by_phone').val().trim().length;
    if (search_name_length < 3 && search_phone_length < 3) {
    $('.resultsMessage').show();
    $(".resultsTable").hide();
} else {
    $.ajax({
    type: "GET",
    url: '<?php echo route('get_ajax_search_client'); ?>',
    data: {
    'keyword': $('#txt_search_by_name').val(),
    'phone': $('#txt_search_by_phone').val()
},
    success: function(data) {
    $('.resultsMessage').hide();
    $(".resultsTable").show();
    $(".resultsTable").html(data);
}
});
}
});

    $(".close-box-button").click(function() {
    $.unblockUI();
});

    $("#zip").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#zip2').focus();
}
});

    $("#txt_fsa1").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#txt_fsa2').focus();
}
});

    $("#phone1").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#phone2').focus();
}
});

    $("#phone2").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#phone3').focus();
}
});

    $("#txt_phone1").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#txt_phone2').focus();
}
});

    $("#txt_phone2").keyup(function() {
    var val = $(this).val();
    if (val.length == 3) {
    $('#txt_phone3').focus();
}
});
});

    function openEditPopup(client_id) {
    $.ajax({
        type: "GET",
        url: '<?php echo url('/vendor/customer/get_ajax_client'); ?>',
        data: {
            'client_id': client_id
        },
        success: function(data) {
            var client = JSON.parse(data);
            $('#hf_client_id').val(client['id']);
            $('#txt_business_name').val(client['business_name']);
            $('#txt_first_name').val(client['first_name']);
            $('#txt_last_name').val(client['last_name']);
            $('#txt_gender').val(client['gender']);
            $('#txt_email').val(client['email']);
            //$('#txt_phone').val(client['PHONE']);
            $('#txt_phone1').val(client['phone'].substring(0, 3));
            $('#txt_phone2').val(client['phone'].substring(3, 6));
            $('#txt_phone3').val(client['phone'].substring(6, 10));
            $('#txt_address').val(client['address']);
            $('#txt_country').val(client['Country']);
            $('#txt_city').val(client['city']);
            $('#cmb_province').val(client['Province_State']);
            $('#txt_fsa1').val(client['zip'].substring(0, 3));
            $('#txt_fsa2').val(client['zip'].substring(3, 6));
            $.blockUI({
                message: $('#updateCustomerForm')
            });
        }
    });
}

    function selectClient(client_id) {
    var url = "<?php echo url('/vendor/order'); ?>?client_id=" + client_id + "&action=";
    window.location = url;
    /*$('.step-pane.step1').hide();
    $("li[data-target='step1']").removeClass('active');
    $('.step-pane.step2').show();
    $("li[data-target='step2']").addClass('active');*/
}


        $(document).ready(function() {
        var myLatLng = {
        lat: 47.774241,
        lng: -94.031905
    };
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: myLatLng
    });
        var currCenter = null;

        var placeSearch, autocomplete;
        var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
        var component_map = {
        street_number: 'street_no',
        route: 'address',
        locality: 'city',
        administrative_area_level_1: 'state',
        country: 'country',
        postal_code: 'zip'
    };
        $(document).on("keypress", 'form #autocomplete', function(e) {
        if (e.which == 13) return false;
        if (e.which == 13) e.preventDefault();
    });
        $("#autocomplete").on("keyup", function(e) {
        e.preventDefault();
        var code = e.keyCode || e.which;
        if (code == 40) {
        if ($('.serachwrap .focus').length == 0)
        $('.serachwrap li:first-child').addClass('focus');
        else {
        var el = $('.serachwrap li.focus');
        $('.serachwrap li').removeClass('focus');
        el.next('li').addClass('focus');
    }
        return;
    } else if (code == 38) {
        if ($('.serachwrap .focus').length == 0)
        $('.serachwrap li:last-child').addClass('focus');
        else {
        var el = $('.serachwrap li.focus');
        $('.serachwrap li').removeClass('focus');
        el.prev('li').addClass('focus');
    }
        return;
    } else if (code == 13) {
        e.preventDefault();
        var el = $('.serachwrap li.focus');
        if (el.length) {
        var string = $('.serachwrap li.focus').attr('title');
        $('#autocomplete').val(string);
        var geocd = new google.maps.Geocoder();
        geocd.geocode({
        "address": string
    }, fillInAddress);
        $('#result').hide();
        return false;
    }
    }
        $('#result').hide();
        $('#result').html('');
        var inputData = $("#autocomplete").val();
        service = new google.maps.places.AutocompleteService();
        var request1 = {
        input: inputData,
        types: ['geocode'],
        componentRestrictions: {
        country: 'us'
    },
    };
        var request2 = {
        input: inputData,
        types: ['geocode'],
        componentRestrictions: {
        country: 'ca'
    },
    };
        $('#result').empty();
        //service.getPlacePredictions(request1, callback);//remove if only for CA
        service.getPlacePredictions(request2, callback); //remove if only for US
    });
        $(document).on('click', '.serachwrap li', function() {
        var string = $(this).attr('title');
        $('#autocomplete').val(string);
        var geocd = new google.maps.Geocoder();
        geocd.geocode({
        "address": string
    }, fillInAddress);
        $('#result').hide();
    });

        function callback(predictions, status) {
        $('#result').html('');
        $('#result').hide();
        var resultData = '';
        if (predictions != '') {
        for (var i = 0; i < predictions.length; i++) {
        resultData += '<li title="' + predictions[i].description + '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
    }
        if ($('#result').html() != undefined && $('#result').html() != '') {
        resultData = $('#result').html() + resultData;
    }
        if (resultData != undefined && resultData != '') {
        $('#result').html(resultData).show();
        $('#result').show();
    }
    }
    }

        marker = null;

        function fillInAddress(results, status) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();

        if (marker != null) {
        marker.setMap(null);
    }
        var point = {
        lat: latitude,
        lng: longitude
    };
        marker = new google.maps.Marker({
        position: point,
        map: map,
        title: 'Your location'
    });
        map.setCenter(point);
        currCenter = map.getCenter();
        if (results[0].geometry.viewport)
        map.fitBounds(results[0].geometry.viewport);
        $('.step1').find('input:not(#autocomplete)').val('');
        $.map(results, function(item) {
        //console.log(JSON.stringify(results));
        /*$('#address').val(item.address_components[0]['long_name']);
        $('#city').val(item.address_components[1]['long_name']);*/
        $('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
        $('.step1 .address-form-block').removeClass('hide');
        var street_number = "";
        var route = "";
        var locality = "";
        var administrative_area_level_1 = "";
        var country = "";
        var postal_code = "";
        for (var i = 0; i < item.address_components.length; i++) {
        var addressType = item.address_components[i].types[0];
        if (componentForm[addressType]) {
        var val = item.address_components[i][componentForm[addressType]];
        if (addressType == "street_number") {
        street_number = val;
    }
        if (addressType == "route") {
        route = val;
    }
        if (addressType == "locality") {
        locality = val;
    }
        if (addressType == "administrative_area_level_1") {
        administrative_area_level_1 = val;
    }
        if (addressType == "country") {
        country = val;
    }
        if (addressType == "postal_code") {
        postal_code = val;
    }
        //alert(addressType+"->"+component_map[addressType]);
        //document.getElementById(component_map[addressType]).value = val;
    }
    }
        document.getElementById("country").value = country;
        document.getElementById("address").value = street_number + " " + route;
        document.getElementById("city").value = locality;
        document.getElementById("lontude").value = longitude;
        document.getElementById("latude").value = latitude;
        $(function() {
        $('[name=province] option').filter(function() {
        return ($(this).text() == administrative_area_level_1);
    }).prop('selected', true);
    });
        if (postal_code) {
        postal_code_array = postal_code.split(" ");
        document.getElementById("zip").value = postal_code_array[0] == null ? '' : postal_code_array[0];
        document.getElementById("zip2").value = postal_code_array[1] == null ? '' : postal_code_array[1];
    }
        google.maps.event.trigger(map, 'resize');
    });
    }
        google.maps.event.addListener(map, 'resize', function() {
        map.setCenter(currCenter);
    });
        google.maps.event.addListener(map, 'bounds_changed', function() {
        if (currCenter) {
        map.setCenter(currCenter);
    }
        currCenter = null;
    });
    });
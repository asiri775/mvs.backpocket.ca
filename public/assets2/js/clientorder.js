

    $(document).ready(function(){
    var myLatLng = {lat: 47.774241,lng: -94.031905};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: myLatLng
});

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
    password:'password',
    locality: 'city',
    administrative_area_level_1: 'state',
    country: 'country',
    postal_code: 'zip'
};
    $("#autocomplete").on("keyup", function (e) {
    var code = e.keyCode || e.which;

    if(code ==40) {
    if($('.serachwrap .focus').length==0)
    $('.serachwrap li:first-child').addClass('focus');
    else{
    var el = $('.serachwrap li.focus');
    $('.serachwrap li').removeClass('focus');
    el.next('li').addClass('focus');
}
    return;
}else if(code==38){
    if($('.serachwrap .focus').length==0)
    $('.serachwrap li:last-child').addClass('focus');
    else{
    var el = $('.serachwrap li.focus');
    $('.serachwrap li').removeClass('focus');
    el.prev('li').addClass('focus');
}
    return;
}else if(code==13){
    e.preventDefault();
    var el = $('.serachwrap li.focus');
    var string = $('.serachwrap li.focus').attr('title');
    $('#autocomplete').val(string);
    var geocd = new google.maps.Geocoder();
    geocd.geocode({"address": string},fillInAddress);
    $('#result').hide();
    return false;
}
    $('#result').hide();
    $('#result').html('');
    var inputData = $("#autocomplete").val();
    service = new google.maps.places.AutocompleteService();
    <!-- countries US and Canada--->
    var request1 = {
    input: inputData,
    types: ['geocode'],
    componentRestrictions: {country: 'us'},
};
    var request2 = { //remove if only for US
    input: inputData,
    types: ['geocode'],
    componentRestrictions: {country: 'ca'},
};
    $('#result').empty();
    service.getPlacePredictions(request1, callback);
    service.getPlacePredictions(request2, callback);//remove if only for US
});
    $(document).on('click','.serachwrap li',function(){
    var string = $(this).attr('title');
    $('#autocomplete').val(string);
    var geocd = new google.maps.Geocoder();
    geocd.geocode({"address": string},fillInAddress);
    $('#result').hide();
});
    function callback(predictions, status) {
    $('#result').html('');
    $('#result').hide();
    var resultData = '';
    if(predictions !=''){
    for (var i = 0; i < predictions.length; i++) {
    resultData += '<li title="'+predictions[i].description+'"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
}
    if($('#result').html() != undefined && $('#result').html() != ''){
    resultData = $('#result').html()+ resultData;
}
    if(resultData != undefined && resultData != ''){
    $('#result').html(resultData).show();
    $('#result').show();
}
}

}

    marker = null;
    function fillInAddress(results, status) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    if(marker!=null){
    marker.setMap(null);
}
    var point = {lat: latitude,lng: longitude};
    marker = new google.maps.Marker({
    position:point,
    map: map,
    title: 'Your location'
});
    map.setCenter(point);
    if (results[0].geometry.viewport)
    map.fitBounds(results[0].geometry.viewport);
    $('#step1').trigger("reset");

    console.log(results);

    $.map(results, function(item){

    for (var i = 0; i < item.address_components.length; i++) {
    var addressType = item.address_components[i].types[0];
    if (componentForm[addressType]) {
    var val = item.address_components[i][componentForm[addressType]];
    document.getElementById(component_map[addressType]).value = val;
}
}

    $(".address-form-block").removeClass("hide");

    $(".map-section").removeClass("col-md-12").addClass("col-md-6");

});
}
});


    $(document).ready(function () {

    var pid = $('.itemSelect option').filter(function () {
    return ($(this).text() == "DNS -- Per File Box");
}).val();

    $.ajax({
    type: "GET",
    url: '<?php echo route('client.get_ajax_product'); ?>',
    data: {'id': pid},
    success: function (data) {

    var product = JSON.parse(data);
    var rate = product['price'];

    $('.itemQty').val(1);
    $('.rate').html("$" + rate);
    $('.total').html("$" + rate);
    $('.hf_base_price').val(rate);
    $('.hf_tax').val(tax);

    $row = $('tr.item');
    countRow($row);
}
});

    $('.btn-prev').click(function () {
    var url = "";
    // window.location = url;
});

    $(document).on("change", ".itemSelect", function (e) {
    $this = $(this);
    $row = $this.parents('tr.item');

    var price_flag = false;
    if ($row.find('.itemSelect option:selected').text() == "DNS - Open Amount") {
    price_flag = true;
} else {
    price_flag = false;
}

    if ($(this).val() == "") {
    var rate = parseFloat(0.00).toFixed(2);
    var tax = parseFloat(0.00).toFixed(2);
    $row.find('.itemQty').val();
    $row.find('.rate').html("$" + rate);
    $row.find('.total').html("$" + rate);
    $row.find('.tax').html("$" + tax);
    $row.find('.hf_base_price').val(rate);
    $row.find('.hf_tax').val(tax);
    $('.subtotal').html("$" + rate);
    $('.finalTax').html("$" + tax);
    $('.grandTotal').html("$" + rate);
    $('#hf_subtotal').val("$" + rate);
    $('#hf_totaltax').val("$" + tax);
    $('#hf_grandtotal').val("$" + rate);
    return false;
}

    $.ajax({
    type: "GET",
    url: '<?php echo route('client.get_ajax_product'); ?>',
    data: {'id': $(this).val()},
    success: function (data) {

    var product = JSON.parse(data);
    var rate = product['price'];
    var tax = (rate * 13) / 100;
    $row.find('.itemQty').val(1);
    $row.find('.rate').html("$" + rate);
    $row.find('.total').html("$" + rate);
    $row.find('.tax').html("$" + tax);
    $row.find('.hf_base_price').val(rate);
    $row.find('.hf_tax').val(tax);



    countRow($row);

    if (price_flag) {
    $row.find('.rate').hide();
    $row.find('.hf_base_price').attr('type', 'text');
} else {
    $row.find('.rate').show();
    $row.find('.hf_base_price').attr('type', 'hidden');
}
}
});
});

    $(document).on("change", ".itemQty", function (e) {
    var qty = $(this).val();
    // var quentity = document.getElementById("txt_qty").value;
    // document.getElementById("qty_confirmlist").innerHTML = quentity;
    $this = $(this);
    $row = $this.parents('tr.item');
    countRow($row);
});

    $(document).on("keyup", ".hf_base_price", function (e) {
    var base_price = $(this).val();
    $this = $(this);
    $row = $this.parents('tr.item');

    var tax = (base_price * 13) / 100;
    tax = parseFloat(tax).toFixed(2);
    $('.tax').html("$" + tax);
    $('.hf_tax').val(tax);

    countRow($row);
});

    $("#addItem").click(function () {
    $('.item>td.action').html($('<div class="form-group"><button class="btn btn-default removeItem" type="button" style="padding: 3px 10px;"><i class="fa fa-minus plussigncenetr" style="font-size: 18px;"></i></button></div>'));
    document.getElementById("cmb_order_item").style.borderColor = "#c6ced0";

    $this = $(this);
    $row = $this.parents('tr.item');


    $newRow = rowTemplate();

    $('table.items tbody').append($newRow);
});

    $(document).on("click", ".removeItem", function (e) {
    $this = $(this);
    $row = $this.parents('tr.item');
    $row.remove();

    var rows = $('.item>td.action');

    if (rows.length == 1) {
    rows.html('');
}
    //getSubtotal();
    countRow($row);
});

    $("#cmb_payment_method").change(function () {
    if ($(this).val() == "1") {
    $('.cheque-data').show();
    $('#txt_cheque_number').attr('required', 'required');
    $('.cc-data').hide();
    hideCCData()
} else if ($(this).val() == "2") {
    $('.cheque-data').hide();
    $('#txt_cheque_number').removeAttr("required");
    $('.cc-data').hide();
    hideCCData()
} else if ($(this).val() == "3") {
    $('.cheque-data').hide();
    $('#txt_cheque_number').removeAttr("required");
    $('.cc-data').hide();
    hideCCData()
} else if ($(this).val() == "4") {
    $('.cheque-data').hide();
    $('#txt_cheque_number').removeAttr("required");
    $('.cc-data').show();
    showCCData();
} else {
    $('.cheque-data').hide();
    $('#txt_cheque_number').removeAttr("required");
    $('.cc-data').hide();
    hideCCData()
}
});

});

    function showCCData() {
    $('#txt_card_no').attr('required', 'required');
    $('#txt_cardholder_name').attr('required', 'required');
    $('#txt_cvv').attr('required', 'required');
    $('#cmb_exp_month').attr('required', 'required');
    $('#cmb_exp_year').attr('required', 'required');
}

    function hideCCData() {
    $('#txt_card_no').removeAttr("required");
    $('#txt_cardholder_name').removeAttr("required");
    $('#txt_cvv').removeAttr("required");
    $('#cmb_exp_month').removeAttr("required");
    $('#cmb_exp_year').removeAttr("required");
}

    function countRow($row) {


    var item = $row.find('.itemSelect').val();
    var qty = $row.find('.itemQty').val();
    var rate = $row.find('.hf_base_price').val();
    var tax = $row.find('.hf_tax').val();
    var tax = parseFloat(tax * qty).toFixed(2) || 0;
    var total = parseFloat(rate * qty).toFixed(2) || 0;
    $row.find('.total').html("$" + total);
    $row.find('.tax').html("$" + tax);


    getSubtotal();


    /*$('.subtotal').html("$"+total);
     $('.finalTax').html("$"+tax);
     $('.grandTotal').html("$"+total);*/
}

    function getSubtotal() {
    subtotal = 0;
    $('.total').each(function (i, el) {
    subtotal += parseFloat($(el).text().replace('$', ''), 10) || 0;
});

    $('.subtotal').html('$' + subtotal.toFixed(2));

    tax = 0;

    $('.tax').each(function (i, el) {
    tax += parseFloat($(el).text().replace('$', ''), 10) || 0;
});

    $('.finalTax').html('$' + tax.toFixed(2));

    $('.grandTotal').html('$' + (tax + subtotal).toFixed(2));

    $('#hf_subtotal').val(subtotal.toFixed(2));
    $('#hf_totaltax').val(tax.toFixed(2));
    $('#hf_grandtotal').val((tax + subtotal).toFixed(2));
}

    function rowTemplate() {

    template = '';
    template += '<tr class="item">';
    template += '<td><div class="form-group"><div>';
    template += $('.itemSelect').prop('outerHTML');
    template += '</div></div></td>';
    template += '<td><div class="form-group"><div class="col-sm-6" style="padding-left: 0px;">';
    template += '<input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty">';
    template += '</div></div></td>';
    template += '<td><div class="form-group"><div class="rate form-control-static">$0.00</div><input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value=""></div></td>';
    template += '<td><div class="tax"  style="display:none" form-control-static">$0.00</div><div class="form-group"><div class="total form-control-static" >$0.00</div><div class=""></div></div></td>';
    template += '<td class="action"><div class="form-group"><button class="btn btn-default removeItem" style="padding: 3px 10px;" type="button"><i style="font-size: 18px;" class="fa fa-minus plussigncenetr"></i></button></div></td>';
    template += '<input type="hidden" name="hf_tax[]" class="hf_tax" value="">';
    template += '</tr>';

    return template;
}

    $(document).ready(function () {

    $('.orderformsubmit').click(function() {

        var selorder = document.getElementById("cmb_order_item").value;
        if(selorder == "") {
            $('#cmb_order_item').focus();
            document.getElementById("cmb_order_item").style.borderColor = "red";
            return false;
        }
        // $(".itemSelect").each(function(i) {
        //      var Item = $(".itemSelect").val();
        //  });

        return true;

    });
});

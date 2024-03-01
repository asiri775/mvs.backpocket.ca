
    $(document).ready(function () {

    var pid = $('.itemSelect option').filter(function () {
    return ($(this).text() == "DNS -- Per File Box");
}).val();

    $.ajax({
    type: "GET",
    url: '<?php echo route('get_ajax_product'); ?>',
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
    window.location = url;
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
    url: '<?php echo route('get_ajax_product'); ?>',
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

    /*$('.subtotal').html("$"+rate);
     $('.finalTax').html("$"+tax);
     $('.grandTotal').html("$"+rate);*/
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
    $('.item>td.action').html($('<div class="form-group"><button title="Remove" class="btn btn-default removeItem" type="button"><i class="fa fa-minus"></i></button></div>'));

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
    template += '<td><div class="form-group"><div>';
    template += '<input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty">';
    template += '</div></div></td>';
    template += '<td><div class="form-group"><div class="rate form-control-static"></div><input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value=""></div></td>';
    template += '<td><div class="form-group"><div class="total form-control-static"></div><div class="tax"></div></div></td>';
    template += '<td class="action"><div class="form-group"><button class="btn btn-default removeItem" title="Remove" style="padding: 2px 18px;" type="button"><i class="fa fa-minus"></i></button></div></td>';
    template += '<input type="hidden" name="hf_tax[]" class="hf_tax" value="">';
    template += '</tr>';

    return template;
}


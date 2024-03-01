
    $(document).ready(function(){
    $("#save-order").click(function(){
        var product = $('#newitems option:selected').val();
        if(product == "") {
            alert("Please select at least one product.");
            return false;
        }
        var price = $('#itemprice').val();
        var newprice = price.replace("$","");
        if(!parseFloat(newprice))
        {
            alert("Please enter correct price.");
            return false;
        }
    });
});

    $(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: '/vendor/get-template-ajax',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'job_type_id', name: 'job_type_id'},
            {data: 'repeat', name: 'repeat'},
            {data: 'schedule_from', name: 'schedule_from'},
            {data: 'action', name: 'action', searchable: false}
        ]
    });
});

    var increment = 1;
    var laravelToken = "{!! csrf_token() !!}";
    var options = {!! json_encode($products) !!};

    function addItem() {
    $('.item-tbody').append(
        '<tr id="' + "row" + increment + '">'
        + '<td><select  name="item[' + increment + '][product_id]" id="newitems">' +
        '<option value="">Select Product</option></select>' +
        '</td>'
        + '<input type="hidden" id="productprice" value="" name="item[' + increment + '][product_price]" />'
        + '<td><input type="text" name="item[' + increment + '][item_note]"/></td>'
        + '<td><input type="number" name="item[' + increment + '][qty]" value="1" maxlength="4" size="4" /></td>'
        + '<td><input type="text" id="itemprice" class="price" name="item[' + increment + '][base_price]" maxlength="10" size="10"/></td>'
        + '<td><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();"'
        + 'class="btn btn-danger float-right">'
        + '<i class="glyphicon glyphicon-minus-sign"></i> remove</a></td>'
        + '</tr>'
    );
    $.each(options, function (value, key) {
    $("#row" + increment).find('select')
    .append($("<option></option>")
    .attr("value", key)
    .text(value));
});
    increment++;
}

    $('table').on('change', "select", function () {
    var self = this;
    $.ajax({
    url: "/vendor/template-product/get-price",
    method: "POST", //First change type to method here

    data: {
    id: this.value, // Second add quotes on the value.
    _token: laravelToken
},
    success: function (response) {
    console.log(response);
    var product = JSON.parse(response);

    jQuery(self).parent().parent().find("#productprice").val(product.price);
    jQuery(self).parent().parent().find(".price").val("$"+product.price);
    jQuery(self).parent().parent().find(".item_note").val(product.short_description);
},
    error: function () {
    alert("Something went wrong!");
}

});
});
    $('input[name="dates"]').daterangepicker({
    minDate: moment()
});
    $('input[name="date"]').datepicker({
    minDate: moment()
});

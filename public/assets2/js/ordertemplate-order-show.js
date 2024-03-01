
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
        + '<td><select  name="item[' + increment + '][product_id]">' +
        '<option value="">Select Product</option></select>' +
        '</td>'
        + '<td><input type="textarea" name="item[' + increment + '][item_note]"/></td>'
        + '<td><input type="text" name="item[' + increment + '][qty]"/></td>'
        + '<td><input type="text" class="price" name="item[' + increment + '][base_price]"/></td>'
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
    jQuery(self).parent().parent().find(".price").val(response);
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
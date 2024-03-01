
    $(function () {
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
}
});
    var orderId = $.urlParam('orderId');
    var fromTime = $.urlParam('fromTime');
    var toTime = $.urlParam('toTime');
    var quickdate = $.urlParam('quickdate');
    var status = $.urlParam('status');
    var method = $.urlParam('method');
    var type = $.urlParam('type');
    var table = $('#orders-table').DataTable({
    dom: "Bfrtip",
    processing: true,
    serverSide: true,
    pageLength: 10,
    ajax: {
    url: '{{ url('vendor/get-template-order-ajax')}}/{{$client->id}}?orderId=' + orderId + '&quickdate=' + quickdate + '&fromTime=' + fromTime + '&toTime=' + toTime + '&status=' + status + '&method=' + method + '&type==' + type + '&orderForm=Search',
},
    columns: [
{
    'targets': 0,
    'checkboxes': { 'selectRow': true },
    'searchable': false,
    'orderable': false,
    'className': 'dt-body-center',
    'data': 'id',
    'sortable': false,
    'render': function (id) {
    return '<input type="checkbox" name="chk_orders[]" value="' + $('<div/>').text(id).html() + '">';
}},
{data: 'id', name: 'id'},
{data: "type", name: 'type'},
{data: 'method', name: 'method'},
{data: 'pay_amount', render: $.fn.dataTable.render.number(',', '.', 2, '$'), name: 'pay_amount'},
{data: 'booking_date',render: function(data, type, full) {return moment(new Date(data)).format('MM/DD/YYYY');}},
{data: 'status', name: 'status'},
{data: 'action', name: 'action', searchable: false}
    ],
    select: {
    style: 'multi',
    selector: 'td:first-child'
},
    order: [[1, 'asc']],
    columnDefs: [{
    targets: 3, render: function (data) {
    return "$" + data;
}
}],
    buttons: [
    'selectAll',
    'selectNone',
{
    text: 'Delete All',
    action: function (e, dt, node, config) {
    var deleteids_arr = [];
    $.each($("input[name='chk_orders[]']:checked"), function(){
    deleteids_arr.push($(this).val());
});
    // Confirm alert
    var confirmdelete = confirm("Do you really want to Delete records?");
    if (confirmdelete == true) {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
}
});
    $.ajax({
    url: '{{ url('/vendor/get-template-order-delete')}}/{{$client->id}}',
    type: 'POST',
    data: {deleteids_arr: deleteids_arr,_token:'{{ csrf_token() }}'},
    success: function (result) {
    $('meta[name="csrf-token"]').attr('content', result.token);
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': result.token
}
});
    table.ajax.reload();
}
});
}

}
}
    ],
    columnDefs: [{
    targets: 4, render: function (data) {
    return moment(data).format("MM/DD/YYYY");
}
}],

});

    $('.buttons-select-all').on('click', function () {
    var table = $("#orders-table");
    var boxes = $('input:checkbox', table);
    $.each($('input:checkbox', table), function () {
    $(this).parent().addClass('checked');
    $(this).prop('checked', 'checked');
});

});
    $('.buttons-select-none').on('click', function () {
    var table = $("#orders-table");
    var boxes = $('input:checkbox', table);
    $.each($('input:checkbox', table), function () {
    $(this).parent().removeClass('checked');
    $(this).prop('checked', false);
});
});

});
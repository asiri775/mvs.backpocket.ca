
    $(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: '/vendor/get-template-ajax-by-vendor',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'TYPE_NAME', name: 'TYPE_NAME'},
            {data: 'repeat', name: 'repeat'},
            {data: 'schedule_from', name: 'schedule_from'},
            {data: 'action', name: 'action', searchable: false}
        ]
    });
});
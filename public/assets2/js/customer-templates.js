
    $(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: '{{ url('vendor/get-template-ajax') }}/{{$client->id}}',
    columns: [
{data: 'id', name: 'id'},
{data: 'name', name: 'name'},
{data: 'typeName', name: 'typeName'},
{data: 'repeat', name: 'repeat'},
{data: 'schedule_from', name: 'schedule_from'},
{data: 'action', name: 'action', searchable: false}
    ]
});

});

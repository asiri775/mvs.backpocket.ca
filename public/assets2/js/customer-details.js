
    $(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: '{{ url('vendor/get-template-ajax') }}/{{$client->id}}',
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
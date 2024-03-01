
    $(document).ready(function (e) {
    $("#tableStore1").dataTable({
        // "sDom": "<'top'f<'clear'>><t><'row'<p i>>",
        "destroy": true,
        "order": [],
        "scrollCollapse": true,
        "bLengthChange": false,
        "columns": [
            { "width": "30%" },
            { "width": "30%" },
            { "width": "50%" },
            { "width": "50%" },
        ],
        "oLanguage": {
            "sLengthMenu": "_MENU_ ",
            "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
        },
        "iDisplayLength": 5
    })
})
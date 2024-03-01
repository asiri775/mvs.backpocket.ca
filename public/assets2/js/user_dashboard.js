
    $(document).ready(function (e) {
    $("#tableEnvelope").dataTable({
        "sDom": "<t><'row'<p i>>",
        "paging": false,
        "info": false,
        "destroy": true,
        "scrollCollapse": true,
        "oLanguage": {
            "sLengthMenu": "_MENU_ ",
            "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
        },
        "iDisplayLength": 5
    })

    $("#tableStore").dataTable({
    "sDom": "<t><'row'<p i>>",
    "order": [],
    "paging": false,
    "info": false,
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
    "sLengthMenu": "_MENU_ ",
    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
},
    "iDisplayLength": 5
})
    $("#tableStore1").dataTable({
    "sDom": "<t><'row'<p i>>",
    "order": [],
    "paging": false,
    "info": false,
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
    "sLengthMenu": "_MENU_ ",
    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
},
    "iDisplayLength": 5
})
})
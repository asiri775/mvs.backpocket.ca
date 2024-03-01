
    $(document).ready(function () {
    $('#table_1').DataTable({
        select: true,
        ordering: true,
        "pageLength": 50,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            ['10', '25', '50', '100', 'All']
        ],
    });
    $('#makeActive').click(function(){
    var isActive_arr = [];
    $.each($("input[name='chk_isActive[]']:checked"), function(){
    isActive_arr.push($(this).val());
});
    var confirmActive = confirm("Do you really want to make template active?");
    if (confirmActive == true) {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
}
});
    $.ajax({
    url: '{{ url('/vendor/get-order-template-activate')}}',
    type: 'POST',
    data: {isActive_arr: isActive_arr,_token:'{{ csrf_token() }}'},
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
});
});

    var Timer;
    $('#table_1').on('search.dt', function () {
    clearTimeout(Timer);
    Timer = setTimeout(SendRequest, 1000);
});

    function SendRequest() {

    getClientDetails();
}

    //toggle button

    $('#map_toggle').change(function () {
    var boxWidth = $(".main-row").width();
    if ($(window).width() > 992) {
    if ($('#map_toggle').is(':checked')) {
    $('#map_toggle_txt').text('Hide Map');
    $('.left-tab').animate({
    width: (boxWidth / 2) - 22
});
    $('.right-tab').show(1000);
} else {
    $('#map_toggle_txt').text('Show Map');
    $('.left-tab').animate({
    width: boxWidth - 48
});
    $('.right-tab').hide();
}
} else {
    if ($('#map_toggle').is(':checked')) {
    $('#map_toggle_txt').text('Hide Map');
    $('.left-tab').hide()
    $('.right-tab').show();
} else {
    $('#map_toggle_txt').text('Show Map');
    $('.left-tab').show();
    $('.right-tab').hide();
}
}
});

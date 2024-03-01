

    $("#allow").change(function () {
    $("#pSizes").toggle();
});

    bkLib.onDomLoaded(function() {
    new nicEditor().panelInstance('description');
    new nicEditor().panelInstance('policy');
});

    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#adminimg').attr('src', e.target.result);
};

    reader.readAsDataURL(input.files[0]);
}
}
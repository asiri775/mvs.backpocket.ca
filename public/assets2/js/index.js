
    $("body").on('click', '.toggle-password_1', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#reg_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}

});


    $("body").on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#cpass");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});

    $("body").on('click', '.toggle-password-1', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#newpass");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});

    $("body").on('click', '.toggle-password-2', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#renewpass");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});

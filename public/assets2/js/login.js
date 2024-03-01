
    $(".toggle-password").click(function() {

    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    $(this).toggleClass("far fa-eye-slash");
} else {
    input.attr("type", "password");
    $(this).toggleClass("far fa-eye");
}
});
    $(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('.login-btn').attr('disabled', 'disabled');
    });
});
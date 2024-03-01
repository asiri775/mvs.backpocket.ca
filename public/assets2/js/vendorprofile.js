

    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#vendorimg').attr('src', e.target.result);
}

    reader.readAsDataURL(input.files[0]);
}
}

    $(document).on("click","#addBankAccount",function(){
    $("#bankAccountBox").slideToggle();
});

    $(document).on("click","#addUserAccountTrigger",function(){
    $("#addUserForm")[0].reset();
    window.location.href = "{!! url('vendor/settings') !!}?section=login-users&action=add";
});

    $(document).on("submit", ".ajaxForm", function(e) {

    var formData = $(this);
    var type = formData.find("#form_type").val();

    var errorBox = formData.find(".errorbox");
    errorBox.html("");
    var submitBtn = formData.find('button[type="submit"]');
    var oldHtml = submitBtn.html();
    submitBtn.html('<i class="fa fa-spinner fa-spin">&nbsp;</i>Processing...');
    $.post(formData.attr("action"), formData.serialize(), function(r) {
    if (r != "")
{
    var data = JSON.parse(r);
    if (data.status == "error") {
    errorBox.html("<p class='text-danger'>" + data.message + "</p>");
} else {
    $(".note-editable").html("");
    formData[0].reset();
    errorBox.html("<p class='text-success'>" + data.message + "</p>");
    //$("#main_content_zone_parent").load(window.location.href+" #main_content_zone");
    if(type == "user") {
    window.location.href="{!! url('vendor/settings') !!}?section=login-users";
}
}
} else {
    errorBox.html("<p class='text-success'>Something went wrong, Please Try Later!</p>");
}
    submitBtn.html(oldHtml);
});
    e.preventDefault();
    return false;
});
    
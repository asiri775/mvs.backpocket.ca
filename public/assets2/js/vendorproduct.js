

    $("#load-more").click(function () {
    $("#load").show();
    var id = "{{$vendor->id}}";
    var page = $("#page").val();
    $.get("{{url('/')}}/loadvendor/"+id+"/"+page, function(data, status){
    $("#load").fadeOut();
    $("#products").append(data);
    //alert("Data: " + data + "\nStatus: " + status);
    $("#page").val(parseInt($("#page").val())+1);
    if ($.trim(data) == ""){
    $("#load-more").fadeOut();
}
});
});
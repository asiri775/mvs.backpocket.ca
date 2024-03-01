
    incrementVar = 1;
    function incrementValue(elem){
    var $this = $(elem);
    $input = $this.prev('input');
    $parent = $input.closest('div');
    newValue = parseInt($input.val())+1;
    $parent.find('.inc').addClass('a'+newValue);
    $input.val(newValue);
    incrementVar += newValue;
}
    function decrementValue(elem){
    var $this = $(elem);
    $input = $this.next('input');
    $parent = $input.closest('div');
    newValue = parseInt($input.val())-1;
    $parent.find('.inc').addClass('a'+newValue);
    if(newValue <= 1){
    $input.val(1);
}else{
    $input.val(newValue);
}
    incrementVar += newValue;
}

    function myMap() {
    var mapProp= {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
};
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

    $("#print-btn").click(function() {

    //$("#print_report").addClass("printable");
    window.print();


});

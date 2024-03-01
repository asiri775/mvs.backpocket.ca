
    function meThods(val) {
    var action1 = "{{route('payment.submit')}}";
    var action2 = "{{route('stripe.submit')}}";
    var action3 = "{{route('cash.submit')}}";
    var action4 = "{{route('mobile.submit')}}";
    var action5 = "{{route('bank.submit')}}";
    if (val.value == "Mobile") {
    $("#payment_form").attr("action", action4);
    $("#stripes").hide();
    $("#mobile").show();
    $("#bank").hide();
}
    if (val.value == "Bank") {
    $("#payment_form").attr("action", action5);
    $("#stripes").hide();
    $("#mobile").hide();
    $("#bank").show();
}
    if (val.value == "Paypal") {
    $("#payment_form").attr("action", action1);
    $("#stripes").hide();
    $("#mobile").hide();
    $("#bank").hide();
}
    if (val.value == "Stripe") {
    $("#payment_form").attr("action", action2);
    $("#stripes").show();
    $("#mobile").hide();
    $("#bank").hide();
}
    if (val.value == "Cash") {
    $("#payment_form").attr("action", action3);
    $("#stripes").hide();
    $("#mobile").hide();
    $("#bank").hide();
}
}

    function sHipping(val) {
    var shipcost = parseFloat($("#ship-cost").html());
    var totalcost = parseFloat($("#total-cost").html());
    var total = 0;

    if (val.value == "shipto") {
    total = shipcost + totalcost;
    $("#pick").hide();
    $("#ship-diff").show();
    $("#pick-info").hide();
    $("#shipshow").show();
    $("#total-cost").html(total);
    $("#grandtotal").val(total);
    $("#shipto").find("input").prop('required',true);
    $("#pick").find("select").prop('required',false);
}

    if (val.value == "pickup") {
    total = totalcost - shipcost;
    $("#pick").show();
    $("#pick-info").show();
    $("#ship-diff").hide();
    $("#shipshow").hide();
    $("#total-cost").html(total);
    $("#grandtotal").val(total);
    $("#shipto").find("input").prop('required',false);
    $("#pick").find("select").prop('required',true);
}
}

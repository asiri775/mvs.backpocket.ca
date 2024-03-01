<section>
    <script>
        $(document).ready(function(e){
            $.getJSON("{{ route('get.child.categories') }}?cat_id=" + $("#subCategory").val(), function(values) {
                var options, option;

                var select_child = "{{$category_current->id}}";
                $("#childCategory").html("");
                options = "<option value='" + $("#subCategory").val() + "'>ALL</option>";
                for (var i = 0; i < values.length; i++) {
                    if(values[i].id == select_child){
                        option = "<option selected value='" + values[i].id + "'>" + values[i].name + "</option>";
                    }
                    else{
                        option = "<option value='" + values[i].id + "'>" + values[i].name + "</option>";
                    }
                    options += option;
                }
                $("#childCategory").append(options);
                $('#childCategory.selectpicker').selectpicker('refresh');
            });
            var cat_current = "{{ $category_current['id'] }}";
            $.getJSON("{{ route('get.products') }}?cat_id=" + cat_current, function(values) {
                processProductList(values);
            });

            $("#subCategory").change(function(ev){
                var subCat = $(this).val();
                $.getJSON("{{ route('get.child.categories') }}?cat_id=" + subCat, function(values) {
                    var options;
                    $("#childCategory").html("");
                    options = "<option value='" + subCat + "'>ALL</option>";
                    for (var i = 0; i < values.length; i++) {
                        options += "<option value='" + values[i].id + "'>" + values[i].name + "</option>";

                    }
                    $("#childCategory.selectpicker").append(options);
                    $('#childCategory.selectpicker').selectpicker('refresh');
                });

                $.getJSON("{{ route('get.products') }}?cat_id=" + $(this).val(), function(values) {
                    processProductList(values);
                });
            });

            $("#childCategory").change(function(ev){
                $.getJSON("{{ route('get.products') }}?cat_id=" + $(this).val(), function(values) {
                    processProductList(values);
                });
            });
            incrementVar = 0;
            $('.inc.button').click(function(){
                var $this = $(this),
                    $input = $this.prev('input'),
                    $parent = $input.closest('div'),
                    newValue = parseInt($input.val())+1;
                $parent.find('.inc').addClass('a'+newValue);
                $input.val(newValue);
                incrementVar += newValue;
            });
            $('.dec.button').click(function(){
                var $this = $(this),
                    $input = $this.next('input'),
                    $parent = $input.closest('div'),
                    newValue = parseInt($input.val())-1;
                $parent.find('.inc').addClass('a'+newValue);
                if(newValue <= 0){
                    $input.val(0);
                }else{
                    $input.val(newValue);
                }
                incrementVar += newValue;
            });
        });

        function processProductList (values) {
            var trows;
            $("#productTable tbody").html("");
            for (var i = 0; i < values.length; i++) {
                var price = parseFloat(values[i].price);

                trows +=    "<tr><td><a href='{{ url('product') }}/" + values[i].id + "/" + values[i].title.toLowerCase().replace(' ', '-') + "'>" + values[i].title +
                    "</a>" +
                    "<input type='hidden' class='_token' name='_token' value='{{csrf_token()}}'>" +
                    "<input type='hidden' class='uniqueid name='uniqueid'' value='{{Session::get('uniqueid')}}'>" +
                    "<input type='hidden' class='price' name='price' value='" + price.toFixed(2) + "'>" +
                    "<input type='hidden' class='title' name='title' value='" + values[i].title + "'>" +
                    "<input type='hidden' class='product' name='product' value='" + values[i].id + "'>" +
                    "<input type='hidden' class='cost' name='cost' value='" + values[i].price + "'>" +
                    "<input type='hidden' class='size' name='size'>" +
                    "</td>" +
                    "<td class='text-left'>$" + price.toFixed(2) + "</td>" +
                    "<td class='text-center icons'>" +
                    "<i style='cursor: pointer;' class='fas fa-minus-circle' onclick='decrementValue(this)'></i>" +
                    "<input class='number quantity' style='border-style: none;width: 17px;' type='text' id='" + i + "' value='1' readonly>" +
                    "<i style='cursor: pointer;' class='fas fa-plus-circle' onclick='incrementValue(this)'></i>" +
                    "<td>" +
                    "<a href='#!' class='add-cart' onclick='toAddCartFromTable(this)'><i class='fas fa-cart-plus cart-icon' style='margin-top: 0px; padding-top: 0px;'></i></a>" +
                    "</td>" +
                    "</tr>";
            }

            if (values.length == 0) {
                $("#productTable tbody").append("<tr><td class='text-center' colspan='4'>Sorry, But the procucts will be coming on soon!</td></tr>").hide().fadeIn("slow");
            } else {
                $("#productTable tbody").append(trows).hide().fadeIn("slow");
            }
        }

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Invalid Input");

        $("#filter").validate({
            rules: {
                searchProduct: {
                    lettersonly: true
                },
            }
        });
        $("#searchProduct").keyup(function(e){

            if($("#filter").valid()){
                if($.trim($(this).val()) == ""){
                    $.getJSON("{{ route('get.products') }}?cat_id=6", function(values) {
                        processProductList(values);
                    });
                }
                else{
                    $.getJSON("{{ route('search.products') }}?search=" + $(this).val(), function(values) {
                        processProductList(values);
                    });
                }

            }
        })

        function refreshPage(){
            setTimeout('location.reload()', 1000);
        }
        $("#sortby").change(function() {
            var sort = $("#sortby").val();
            window.location = "{{url('/category')}}/{{$category->slug}}?sort=" + sort;
        });

        $("#load-more").click(function() {
            $("#load").show();
            var slug = "{{$category->slug}}";
            var page = $("#page").val();
            var sort = $("#sortby").val();
            $.get("{{url('/')}}/loadcategory/" + slug + "/" + page + "?sort=" + sort, function(data, status) {
                $("#load").fadeOut();
                $("#products").append(data);
                //alert("Data: " + data + "\nStatus: " + status);
                $("#page").val(parseInt($("#page").val()) + 1);
                if ($.trim(data) == "") {
                    $("#load-more").fadeOut();
                }

            });
        });

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
    </script>
</section>
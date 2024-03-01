@extends('includes.newmaster2')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/newhome_copy.css') }}">

    <div class="home-wrapper-new">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" id="column-change">
                @if(Auth::guard('profile')->guest())
                <div class="box pickup">
                <img src="{{url('/assets/img/welcome-bg.jpg')}}" class="responsive" />

                    <div class="overlay"></div>
                    <div class="box-content">
                        <div class="box-title">
                            <h4>Request a Pick up</h4>
                        </div>
                        <div class="box-body">
                            <p>Lets Start with your address</p>

                            <div class="form-group">
                                <div class="col-lg-12 col-md-3 col-sm-5 col-xs-12 input-group" style="z-index:1">
                                    <form class="example" action="{{route('user.get.address')}}" method="post">
                                        {{csrf_field()}}
                                        <input value="" type="text" id="pac-input" class="form-control"
                                            placeholder="Search here" autocomplete="off" aria-describedby="basic-addon2"
                                            required>
                                        <button type="submit" class="btn btn-sm btn-primary">GO</button>
                                        <input type="hidden" value="" name="lat" id="lat">
                                        <input type="hidden" value="" name="lng" id="lng">
                                        <input type="hidden" value="" name="address" id="location">
                                        <input class="field" value="" name="route" id="route" type="hidden" />
                                        <input class="field" value="" name="locality" id="locality" type="hidden" />
                                        <input class="field" value="" name="administrative_area_level_1"
                                            id="administrative_area_level_1" type="hidden" />
                                        <input class="field" value="" name="country" id="country" type="hidden" />
                                        <input class="field" name="postal_code" id="postal_code" type="hidden" />
                                        <input class="field" name="street_number" id="street_number" type="hidden" />
                                    </form>
                                </div>

                                {{-- <div class="inner-addon left-addon"> --}}
                                {{-- <div class="col-lg-7 col-md-3 col-sm-5 col-xs-5 input-group">
                                                        <input type="text" class="form-control" id="searchroleName" placeholder="Search here"  aria-describedby="basic-addon2">
                                                        <span class="input-group-addon fa fa-search"  id="basic-addon2"></span>
                                                      </div> --}}

                                {{-- <input type="text" class="form-control" placeholder="Search" />
                                            <span class="far fa-search"></i>"></span> --}}
                                {{-- </div> --}}
                            </div>
                            <div id="map" style="height: 300px;width: 100%" hidden></div>
                            <p>Already A Customer?</p>
                            <div class="row">
                                <div class="col-xs-5">
                                    <a href="{{url('signin/user')}}" type="button" class="btn site-color btn-block">SIGN
                                        IN</a>
                                </div>

                                <div class="col-xs-1">
                                    <div class="or-text">or</div>
                                </div>
                                <div class="col-xs-5">
                                    {{-- <button type="button" class="btn fb-color btn-block"><i
                                            class="fab fa-facebook-square"></i>
                                        Login
                                    </button>- --}}
                                    <a href="{{url('user/registration')}}" type="button"
                                        class="btn btn-primary btn-block">SIGN UP</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @else

                <div class="box welcome">
                <a href="{{url('user-dashboard')}}"><img src="{{url('/assets/img/tile_welcome.png')}}" class="responsive" /></a>

                    {{-- <div class="overlay"></div> --}}
                    <div class="box-content">
                        {{-- <div class="box-title">
                                <h4>Free Cleaning</h4>
                            </div>
                            <div class="box-body"></div> --}}
                    </div>

                </div>
                @endif

            </div>
            <a href="{{ url('/user/gift-cards') }}">
                <div class="col-sm-4" id="column-change">
                    <div class="box drop-off">
                        <img src="{{url('/assets/img/tilead_GiftCards.png')}}" class="responsive" />
                        {{-- <div class="overlay"></div> --}}
                        <!-- <div class="box-content">
                            <div class="box-title">
                            <h4>Drop off Garments</h4>
                        </div> -->
                        <!-- <div class="box-body">
                            <p>Find the nearest location to conveniently drop off your garments</p>
                            <a href="#">Store Locator</a>
                        </div> --}}
                        </div> -->

                    </div>
                </div>
            </a>
            <a href="{{ url('user/refer-friend') }}">
                <div class="col-sm-4" id="column-change">
                    <div class="box free-cleaning">
                    <img src="{{url('/assets/img/tilead_easy.png')}}" class="responsive" />

                        <!-- {{-- <div class="overlay"></div> --}}
                        <div class="box-content">
                            {{-- <div class="box-title">
                            <h4>Free Cleaning</h4>
                        </div>
                        <div class="box-body"></div> --}}
                        </div> -->

                    </div>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-sm-8" id="column-expanded">
                <div class="row">
                    @foreach(\App\Category::where('mainid', 6)->where('role','sub')->get() as $childmenu)
                    <div class="col-sm-3">
                        <div class="category-item">
                            <a href="{{url('/category')}}/{{$childmenu->slug}}">
                                <div class="category-img">
                                    {{-- @if($childmenu->slug == 'dry-cleaning')
                                <img src="{{ url('/assets/img/tile_dryclean.png') }}">
                                    @elseif($childmenu->slug == 'laundry')
                                    <img src="{{ url('/assets/img/tile_laundry.png') }}">
                                    @elseif($childmenu->slug == 'drycleaning-corporate')
                                    <img src="{{ url('/assets/img/tile_corporate.png') }}">
                                    @elseif($childmenu->slug == 'specialty-cleaning')
                                    <img src="{{ url('/assets/img/tile_specialty.png') }}">
                                    @endif --}}
                                    <img
                                        src="{{ url('/assets/images/categories/') . '/' . $childmenu->feature_image }}">
                                </div>
                                <div class="category-name">
                                    {{$childmenu->name}}
                                </div>

                            </a>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            <div class="col-sm-4" id="column-change">
                <div class="box whyube">
                <img src="{{url('/assets/img/tilead_whyube.png')}}" class="responsive" />

                
                    {{-- <div class="overlay"></div> --}}
                    <div class="box-content">
                        {{-- <div class="box-title">
                            <h4>Why UBE</h4>
                        </div>
                        <div class="box-body"></div> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap"
    async defer></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

<script>
    function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 55.585901,
                    lng: -105.750596
                },
                zoom: 5
            });
            var options = {
                types: ['geocode'],  // or '(cities)' if that's what you want?
                componentRestrictions: {country:["us","ca"]}
            };
           
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };
            var input = /** @type {!HTMLInputElement} */ (
                document.getElementById('pac-input'));
    
            var types = document.getElementById('type-selector');
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
    
            var autocomplete = new google.maps.places.Autocomplete(input,options);
            autocomplete.bindTo('bounds', map);
    
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
    
            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
    
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
    
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17); // Why 17? Because it looks good.
                }
                marker.setIcon( /** @type {google.maps.Icon} */ ({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                var item_Lat = place.geometry.location.lat()
                var item_Lng = place.geometry.location.lng()
                var item_Location = place.formatted_address;
                //alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
                $("#lat").val(item_Lat);
                $("#lng").val(item_Lng);
                $("#location").val(item_Location);
                $("#location1").val(item_Location);
    
                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    //document.getElementById(component).disabled = false;
                }
                // Get each component of the address from the place details,
                // and then fill-in the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
                //console.log(val);
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });
    
            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                /*radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
                });*/
            }
    
            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
        }
</script>
@stop
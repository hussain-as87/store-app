@extends('layouts.store_layout')
@section('content')

    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 500px;width: 1000px;"></div>
            </div>

            <div>
                <ul>
                    <li>lat: <span id="lat"></span></li>
                    <li>lng: <span id="lng"></span></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Map Types</h4>
                        <p class="card-title-desc">Example of google maps.</p>

                        <div id="gmaps-types" class="gmaps"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        {{-- <script>
                    let map, marker;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById("mymap"), {
                            center: {
                                lat: 31.0461

                                , lng: 34.8516

                            }
                            , zoom: 8
                        , });

                        map.addListener("click", (e) => {
                            console.log(e);
                            document.getElementById("lat").innerText = e.latting.lat();
                            document.getElementById("lng").innerText = e.latting.lng();
                            if (!marker) {
                                marker = new google.maps.marker([
                                    Position: {
                                        lat: e.latting.lat()
                                        , lng: e.latting.lng()
                                    }
                                    , map
                                    , draggable: true
                                , ]);
                                marker.addListener('dragend', () => {
                                    let position = marker.getposition();
                                    document.getElementById("lat").innerText = e.latting.lat();
                                    document.getElementById("lng").innerText = e.latting.lng();
                                })
                            } else {
                                marker.setPoition({
                                    lat: e.latting.lat()
                                    , lng: e.latting.lng()
                                });
                            }

                        });

                    }

                </script> --}}
        {{-- <script>
                $("#pac-input").focusin(function() {
                    $(this).val('');
                });
                $('#latitude').val('');
                $('#longitude').val('');
                // This example adds a search box to a map, using the Google Place Autocomplete
                // feature. People can enter geographical searches. The search box will return a
                // pick list containing a mix of places and predicted search terms.
                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                function initAutocomplete() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {
                            lat: 31.9522

                            , lng: 35.2332

                        }
                        , zoom: 13
                        , mapTypeId: 'roadmap'
                    });
                    // move pin and current location
                    infoWindow = new google.maps.InfoWindow;
                    geocoder = new google.maps.Geocoder();
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude
                                , lng: position.coords.longitude
                            };
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(pos)
                                , map: map
                                , title: 'موقعك الحالي'
                            });
                            markers.push(marker);
                            marker.addListener('click', function() {
                                geocodeLatLng(geocoder, map, infoWindow, marker);
                            });
                            // to get current position address on load
                            google.maps.event.trigger(marker, 'click');
                        }, function() {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        console.log('dsdsdsdsddsd');
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                    var geocoder = new google.maps.Geocoder();
                    google.maps.event.addListener(map, 'click', function(event) {
                        SelectedLatLng = event.latLng;
                        geocoder.geocode({
                            'latLng': event.latLng
                        }, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    deleteMarkers();
                                    addMarkerRunTime(event.latLng);
                                    SelectedLocation = results[0].formatted_address;
                                    console.log(results[0].formatted_address);
                                    splitLatLng(String(event.latLng));
                                    $("#pac-input").val(results[0].formatted_address);
                                }
                            }
                        });
                    });

                    function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
                        var latlng = {
                            lat: markerCurrent.position.lat()
                            , lng: markerCurrent.position.lng()
                        };
                        /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                        $('#latitude').val(markerCurrent.position.lat());
                        $('#longitude').val(markerCurrent.position.lng());
                        geocoder.geocode({
                            'location': latlng
                        }, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    map.setZoom(8);
                                    var marker = new google.maps.Marker({
                                        position: latlng
                                        , map: map
                                    });
                                    markers.push(marker);
                                    infowindow.setContent(results[0].formatted_address);
                                    SelectedLocation = results[0].formatted_address;
                                    $("#pac-input").val(results[0].formatted_address);
                                    infowindow.open(map, marker);
                                } else {
                                    window.alert('No results found');
                                }
                            } else {
                                window.alert('Geocoder failed due to: ' + status);
                            }
                        });
                        SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
                    }

                    function addMarkerRunTime(location) {
                        var marker = new google.maps.Marker({
                            position: location
                            , map: map
                        });
                        markers.push(marker);
                    }

                    function setMapOnAll(map) {
                        for (var i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }

                    function clearMarkers() {
                        setMapOnAll(null);
                    }

                    function deleteMarkers() {
                        clearMarkers();
                        markers = [];
                    }
                    // Create the search box and link it to the UI element.
                    var input = document.getElementById('pac-input');
                    $("#pac-input").val("أبحث هنا ");
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function() {
                        searchBox.setBounds(map.getBounds());
                    });
                    var markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener('places_changed', function() {
                        var places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        // Clear out the old markers.
                        markers.forEach(function(marker) {
                            marker.setMap(null);
                        });
                        markers = [];
                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function(place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon
                                , size: new google.maps.Size(100, 100)
                                , origin: new google.maps.Point(0, 0)
                                , anchor: new google.maps.Point(17, 34)
                                , scaledSize: new google.maps.Size(25, 25)
                            };
                            // Create a marker for each place.
                            markers.push(new google.maps.Marker({
                                map: map
                                , icon: icon
                                , title: place.name
                                , position: place.geometry.location
                            }));
                            $('#latitude').val(place.geometry.location.lat());
                            $('#longitude').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }

                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                }

                function splitLatLng(latLng) {
                    var newString = latLng.substring(0, latLng.length - 1);
                    var newString2 = newString.substring(1);
                    var trainindIdArray = newString2.split(',');
                    var lat = trainindIdArray[0];
                    var Lng = trainindIdArray[1];
                    $("#latitude").val(lat);
                    $("#longitude").val(Lng);
                }

            </script> --}}


        <script async
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm2eie4pEGExspK3sRViuvJE3ulUB7ghw&language=ar&callback=initMap"></script>


        <script>
            var map;
            $(document).ready(function () {
                (map = new GMaps({
                    div: "#gmaps-markers"
                    , lat: -12.043333
                    , lng: -77.028333
                })).addMarker({
                    lat: -12.043333
                    , lng: -77.03
                    , title: "Lima"
                    , details: {
                        database_id: 42
                        , author: "HPNeo"
                    }
                    , click: function (a) {
                        console.log && console.log(a), alert("You clicked in this marker")
                    }
                }), (map = new GMaps({
                    div: "#gmaps-overlay"
                    , lat: -12.043333
                    , lng: -77.028333
                })).drawOverlay({
                    lat: map.getCenter().lat()
                    , lng: map.getCenter().lng()
                    , content: '<div class="gmaps-overlay">Lima<div class="gmaps-overlay_arrow above"></div> < /
                    div > ',verticalAlign:"top",horizontalAlign:"center"}),map=GMaps.createPanorama({el:"#panorama",lat:42.3455,lng:-71.0983}),(map=new GMaps({div:"#gmaps-types",lat:-12.043333,lng:-77.028333,mapTypeControlOptions:{mapTypeIds:["hybrid","roadmap","satellite","terrain","osm"]}})).addMapType("osm",{getTileUrl:function(a,e){return"https:/ / a.tile.openstreetmap.org / "+e+" / "+a.x+" / "+a.y+".png "},tileSize:new google.maps.Size(256,256),name:"
                OpenStreetMap
                ",maxZoom:18}),map.setMapTypeId("
                osm
                ")});

        </script>
    </div>
    </div>
    </div>
@endsection

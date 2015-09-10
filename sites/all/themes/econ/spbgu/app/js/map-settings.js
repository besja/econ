 if ( $( ".contacts" ).length ) {

        var map;
        function init() {
            var mapOptions = {
                center: new google.maps.LatLng(59.944845,30.370895),
                zoom: 16,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.DEFAULT,
                },
                disableDoubleClickZoom: true,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                },
                scaleControl: true,
                scrollwheel: false,
                panControl: true,
                streetViewControl: true,
                draggable : true,
                overviewMapControl: true,
                overviewMapControlOptions: {
                    opened: false,
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}],
            }
            var mapElement = document.getElementById('embedded-map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var locations = [
                ['Чайковского, 62', 'undefined', 'undefined', 'undefined', '#fac-place_1', 59.94658399999999, 30.366950999999972, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png'],
                ['Радищева, 39', 'undefined', 'undefined', 'undefined', '#fac-place_2', 59.94279689999999, 30.364062500000045, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png'],
                ['Таврическая, 21', 'undefined', 'undefined', 'undefined', '#fac-place_3', 59.944833, 30.37845900000002, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png']
            ];

            function addClickToPin(currentMarker) {
                google.maps.event.addListener(currentMarker, 'click', function() {
                    scrollPos = $(currentMarker.web).offset().top;
                    $(currentMarker.web).velocity("scroll", { duration: 1000, easing: "ease-in-out", offset: -50 });
                });
            }
            for (i = 0; i < locations.length; i++) {
                if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
                if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
                if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
                if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
                if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
                marker = new google.maps.Marker({
                    icon: markericon,
                    position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                    map: map,
                    title: locations[i][0],
                    desc: description,
                    tel: telephone,
                    email: email,
                    web: web
                });
                addClickToPin(marker);

                link = '';
            function setZoom() {
                if($(window).width() < 1300 ) {
                    map.setZoom(15);
                    if ($(window).width() < 1100 ) {
                        var pt = new google.maps.LatLng(59.944845,30.37000);
                        map.setCenter(pt);
                        map.setZoom(14);
                    }
                } else {
                    var pt = new google.maps.LatLng(59.944845,30.370895);
                    map.setZoom(16);
                    map.setCenter(pt);
                }
            }
            }

            setZoom();
            $(window).resize(function(){ setZoom() });
    }
    google.maps.event.addDomListener(window, 'load', init);
}



 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/markerwithlabel.js"></script>
 
 <script type="text/javascript">
 
 

   
   var styleArray = [
    {
        "featureType": "administrative.country",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "hue": "#ff0000"
            }
        ]
    }
];


function initMap() {
      var marcadores = [
        ['<b>OVERSEAS</b><br>Eje 7 Sur 59, Oficina 301,<br> Col. Insurgentes Mixcoac, <br>Del. Benito Juárez, CP 03920, CDMX.', 19.3738698,-99.1823441]
      ];
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 15,
        center: new google.maps.LatLng(19.3738698,-99.1823441),
        styles: styleArray,
        scrollwheel: false,
        // draggable: false,
        // raiseOnDrag: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });
      
     

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(marcadores[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    google.maps.event.addDomListener(window, 'load', initMap);
    

 </script>


        <div id="mapa" style="width:100%; display:block"></div>
      








jQuery(document).ready(function($) {
       
             var icon = 
                        "M21.25,8.375V28h6.5V8.375H21.25zM12.25,28h6.5V4.125h-6.5V28zM3.25,28h6.5V12.625h-6.5V28z";   
                        //    "M336.18,56.08L328.61,58.04L297.33,72.99L323.16,96.99L332.22,98.03L331.21,86L359.54,115.27L365.23,106.21L348.14,55.35L336.18,56.08z";  //CIenfuegos en miniatura

        // svg path for target icon
            var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
            // svg path for plane icon
            var planeSVG = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";







            var miMapa= AmCharts.makeChart("mapdiv", {
                type: "map",  //le dice a AmCharts que es un mapa

                /* 
                        **
                        * crear un objeto proveedor(provider) de datos
                        * la propiedad "map"-> suele ser la misma que el nombre del archivo del mapa.
                        * "getAreasFromMap" -> indica que amMap debe leer todas las áreas disponibles
                        *                       en los datos del mapa y tratarlos como están incluidos en su proveedor de datos.
                        *                       en caso de que no lo establezca true, todas las áreas, excepto las enumeradas en los datos
                        *                       del proveedor que serán tratadas como no listado.
                      
               */

               "theme": "light", 

                "projection": "winkel3",

//Común para todas las imagenes se establece aqui en ImagesSettings .
                imagesSettings: {
                    color: "#CC0000",
                    rollOverColor: "#CC0000",
                    selectedColor: "#CC0000",
                    pauseDuration: 0.2,  //Define la pausa entre animaciones (si una línea tiene más de un segmento o la animación está en looped or flipped).
                    animationDuration: 3.5,  //duracion de la animacion de punto a punto
                    adjustAnimationSpeed: true  //las imágenes a lo largo de las líneas ajustarán la velocidad de animación correspondiente a la distancia entre líneas.
                },

                //Común para todas las Lineas se establece aqui en linesSettings.
                linesSettings: {
                    color: "#CC0000",
                    alpha: 0.4
                },

              areasSettings: {
                    unlistedAreasColor: "#0000CC"
                },
                                

              "dataProvider": {
                "map": "cubaLow",                      // (.JS)  suele ser el mismo nombre del archivo del mapa. 
                
                //"mapURL":"ammap/maps/svg/cubaLow.svg", // (SVG)
                
                "getAreasFromMap": true, //(activar y desactivar areas)
                                    //true: Indica que amMap debe leer todas las áreas disponibles, en los datos del mapa y  tratarlos como están incluidos en su proveedor de datos. (algo así como que activar todas las areas. ESTE NO TIENE EN CUENTA "areas")
                                   //false:  Todas las áreas, excepto las enumeradas en los datos del proveedor que serán tratadas como no listado.
                                           //(algo asi como  activar solo las areas enumeradas, y el resto desactivarlas)

                   
                  // OJO: pendiente, porque ademas al parecer se aplican a las enumeradas....                                            
                 /*
                 "areasSettings": {
                    //"alpha": 1,  //opacidad
                    //"outlineColor": "#AACC00",
                    //"outline": "#00CC00", //color de contorno
                    //"unlistedAreasColor": "#0000CC",  //opacidad de las áreas no listadas(unlisted areas)
                   
                    unlistedAreasColor: "#8dd9ef",
                    rollOverOutlineColor: "#FFFFFF",
                    rollOverColor: "#CC0000",
                    "balloonText": "osmel calderon [[title]] joined EU at [[customData]]"
                   },
                  */


 


                   
                   /*
                    zoomLevel: 0.9,
                    zoomLongitude: 23.1330204, 
                    zoomLatitude: -82.3830414,*/

                   




            "balloon": {
                "adjustBorderColor": true,
                "color": "#0000CC",
                "cornerRadius": 5,
                "fillColor": "#0000CC"
              },

              

             "areas": [
                { "id": "CU-05" , "color": "#CC0000" },   // villa_clara
                { "id": "CU-09" , "color": "#00CC00" }, //camaguey
                { "id": "CU-03" , "color": "#0000CC" }, //Ciudad de la habana
              ],   

                    
/*


Ciudad  Coordenadas
La Habana   23.1330204, -82.3830414
Santiago de Cuba    20.0208302, -75.8266678
Camagüey    21.3808308, -77.9169388
Holguín 20.8872204, -76.2630615
Guantánamo  20.1444397, -75.2091675
Santa Clara 22.4069405, -79.9647217
Diez de Octubre 23.0881004, -82.3597031
Arroyo Naranjo  23.0367699, -82.3693695
Las Tunas   20.9616699, -76.9511108
Bayamo  20.3741703, -76.6436081
Boyeros 23.0072002, -82.4017029
Pinar del Río   22.4166698, -83.6966705
Cienfuegos  22.1495705, -80.4466171
Habana del Este 23.1591702, -82.3305588
San Miguel del Padrón   23.0663891, -82.2947235
Centro Habana   23.1383305, -82.3641663
Matanzas    23.0411091, -81.5774994
Ciego de Ávila  21.8400002, -78.76194
Cerro   23.1086102, -82.3777771
Manzanillo  20.3417301, -77.1212616
Sancti Spíritus 21.9297199, -79.4424973

                  Lo que hago es crear 2 lineas(Una para el avion y otra para la transparencia)
                  1ra Linea le pongo un argo(arc). Para pasar la imagen que quiero que se vea
                  2da Linea (sin arco=LineaRecta, sin color, sin transparencia). Para pasar otra imagen transparente por encima de ella, que simule
                        la sombra del avion.
              */





                    lines: [
                    {    //esta es la linea que quiero q se vea el vuelo
                        id: "line1",
                        arc: -0.85,
                        //alpha: 0.3,
                        
                        arrow: 'middle',  //start, end, middle, both, none.
                        arrowColor:'#CC0000',   //Color de la flecha
                        arrowAlpha:1,        // Opacidad de la flecha
                        arrowSize: 10,
                        
                        //thickness:2, //Grosor de la linea
                        // dashLength: 30, //linea discontinua su tamaño
                        latitudes: [23.1330204,  21.3808308, 20.8872204, 20.0208302], //habana,  camaguey, holguin, santiago
                        longitudes: [-82.3830414, -77.9169388, -76.2630615, -75.8266678]
                    }, {    //esta es la linea que quiero q se vea la sombra del vuelo
                        id: "line2",
                          arc: 0,  //sin arco
                        alpha: 0,  //sin transparencia
                        color: "#000000", //sin color

                        latitudes: [23.1330204,  21.3808308, 20.8872204, 20.0208302], //habana,  camaguey, holguin, santiago
                        longitudes: [-82.3830414, -77.9169388, -76.2630615, -75.8266678],
                    }
                    ],              

              "images": [


                    {  //cienfuegos   //Para ubicar una imagen en el mapa, me voy a wikipedia, para encontrar lat y long y luego convierto a decimal
                        "latitude": 22.145556,
                        "longitude": -80.436389,
                           //"type": "rectangle",  //circle, rectangle and bubble
                        "svgPath": targetSVG,  //para poner una imagen personalizada, comentamos "type".
                        //"color": "#6c00ff",

                        "color": "#CC0000",

                         "scale": 0.5,  //escala de la imagen
                         "label": "Cienfuegos cuba, mi casa",  //etiqueta a la imagen
                          "labelShiftY": 2,   //posición vertical de la etiqueta ajustada en 2 píxeles 

                          "zoomLevel": 5,  //le dirá cuánto desea acercar
                          "title": "Mi ciudad Natal", // titulo de la ventana emergente
                          "description": "Cienfuego es la ciudad donde yo naci.",  //se mostrará en una ventana emergente

                    },

                
                    //Aqui los puntos de cada posición
                    {
                       svgPath: targetSVG,
                            title: "La Habana",
                         latitude: 23.1330204,
                        longitude: -82.3830414
                    }, 

                    {
                        svgPath: targetSVG,
                        title: "Camaguey",
                        latitude: 21.3808308,
                        longitude: -77.9169388
                    }, 

                    {
                        svgPath: targetSVG,
                        title: "Holguin",
                        latitude: 20.8872204,
                        longitude: -76.2630615
                    }, 

                    {
                        svgPath: targetSVG,
                        title: "Santiago de Cuba",
                        latitude: 20.0208302,
                        longitude: -75.8266678
                    }, 



                   

                    {  //Imagen que pasa por la linea que tiene arco (el avion)
                        svgPath: planeSVG,  //imagen o icono
                        positionOnLine: 0.5,   //con 0.5 -> la imagen se colocará en el medio de la línea. Los valores permitidos son de 0 a 1.

                      //Imagen
                        color: "#CC00CC",  //color imagen
                        alpha: 1,       //transparencia imagen de 0-1

                      //contorno de la imagen 
                        outlineThickness: 10,     //grosor
                        outlineColor: "#00CC00",  //color 
                        outlineAlpha: 1,          //transparencia
                          
                      //animacion
                        animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                        lineId: "line1",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                        flipDirection: false,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                        loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                        scale: 0.05,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                        positionScale: 1.3,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                        
                      //Texto que se mostrará al lado de la imagen.
                        label: 'osmel', 

                        labelBackgroundAlpha: 0.1, //Opacidad del fondo
                        labelBackgroundColor: "#CC0000",     //Color del fondo
                        

                        labelColor:  "#CC00CC",     //Color
                        labelFontSize: 16, //Tamaño 

                        labelPosition:  top,  //valores permitidos (left, right, top, bottom and middle.)
                        labelRollOverColor:"#0000CC",  //Color roll-over, cuando le pasa por encima.

                          //En algunos casos, es posible que desee ajustar un poco la posición de la etiqueta.
                        labelShiftX: -10,       // Use esta propiedad para desplazar la etiqueta horizontalmente.
                        labelShiftY:-25,        // Use esta propiedad para desplazar la etiqueta verticalmente.


                        //animationDuration: 5, //duración de la animación (a lo largo de la línea o cuando se llama al método animateTo). 
                        //easingFunction: AmCharts.easeInOutQuad,  //Posibles valores: AmCharts.easeInOutQuad, AmCharts.bounce, AmCharts.easeInSine, AmCharts.easeOutSine, AmCharts.easeOutElastic.
                    },

                    {  //la sombra
                        svgPath: planeSVG,
                        positionOnLine: 0,
                        color: "#0000CC",
                        alpha: 0.1,
                        animateAlongLine: true,
                        lineId: "line2",
                        flipDirection: true,
                        loop: true,
                        scale: 0.03,
                        positionScale: 1.3
                    }, 


               ],                                       

                  
              },

               




             /**
             * crear configuraciones(settings) de áreas 
                 -autoZoom: 
                            true: significa que el mapa se acercará cuando se haga clic en el área 
                 -selectedColor: indica el color del área en la que se hizo clic.

                

              "areasSettings": {  //configurando areas
                "autoZoom": true,  //true: significa que el mapa se acercará cuando se haga clic en el área 
                "selectedColor": "#CC0000"  //indica el color del área en la que se hizo clic.
              },*/

              /**
               * let's say we want a small map to be displayed, so let's create it
               */
              "smallMap": {}  //representa el map en miniatura
            } );



    //Las proyecciones de un mapa
    jQuery('body').on('change','#proyecciones', function (e) {    
        //alert( $(this).val()  );
        miMapa.setProjection( jQuery(this).val()  );

    });  


}); 
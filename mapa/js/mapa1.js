jQuery(document).ready(function($) {
           
           var icono_posicion = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

           var imagen_avion = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";


           

           
            var mapData = [
             {
                 svgPath: icono_posicion,
                      title: "La Habana",
                   latitude: 23.1330204,
                  longitude: -82.3830414,
                  color: "#eea638",
                  valor:"ppp",
              }, 
              {
                  svgPath: icono_posicion,
                  title: "Camaguey",
                  latitude: 21.3808308,
                  longitude: -77.9169388,

                  color: "#eeaaCC",
                  valor:"ppp",
              }, 

              {
                  svgPath: icono_posicion,
                  title: "Holguin",
                  latitude: 20.8872204,
                  longitude: -76.2630615,
                  color: "#CCCCCC",
                  valor:"ppp",
              }, 
              {
                  svgPath: icono_posicion,
                  title: "Santiago de Cuba",
                  latitude: 20.0208302,
                  longitude: -75.8266678,
                  color: "#d8854f",
                  valor:"ppp",
              },
            ];
      

         //Aqui los puntos de cada posición
                   





          var  miMapa;
            
              //AmCharts.theme = AmCharts.themes.black;

              miMapa = new AmCharts.AmMap();
              miMapa.addTitle("Primer titulo", 14);
              miMapa.addTitle("Segundo Titulo", 11);

                //Común para todas las imagenes se establece aqui en ImagesSettings .
                miMapa.imagesSettings= {
                    color: "#CC0000",
                    rollOverColor: "#CC0000",
                    selectedColor: "#CC0000",
                    pauseDuration: 0.2,  //Define la pausa entre animaciones (si una línea tiene más de un segmento o la animación está en looped or flipped).
                    animationDuration: 3.5,  //duracion de la animacion de punto a punto
                    adjustAnimationSpeed: true  //las imágenes a lo largo de las líneas ajustarán la velocidad de animación correspondiente a la distancia entre líneas.
                };


        
              var dataProvider = {
                "map": "cubaLow",   //o mapVar: AmCharts.maps.worldLow,
      
                "getAreasFromMap": true,
    
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




                images: [],
                lines : [],
                

              }


              //crear Ptos de ubicacion (Imagenes)
              latitud_linea=[];
              longitud_linea=[];
              for (var i = 0; i < mapData.length; i++) {
                  var dataItem = mapData[i];
                  dataProvider.images.push({  //agregando cada imagen al 
                   "svgPath": dataItem.svgPath,  //para poner una imagen personalizada, comentamos "type".
                    color: dataItem.color,
                    longitude: dataItem.longitude,
                    latitude: dataItem.latitude,
                    title: dataItem.title, 
                    value: dataItem.valor,
                  });
                  latitud_linea.push(dataItem.latitude);
                  longitud_linea.push(dataItem.longitude);

              }
              
                //Lineas
               dataProvider.lines = [
                    {   //esta es la linea que quiero q se vea el vuelo
                        id: "line1",
                        color: "#CC0000", 
                        arc: -0.85,
                        latitudes: latitud_linea,
                        longitudes: longitud_linea,
                    }, {    //esta es la linea que quiero q se vea la sombra del vuelo
                        id: "line2",
                        alpha: 0,  //sin transparencia
                        color: "#000000", //sin color
                        latitudes: latitud_linea,
                        longitudes: longitud_linea,
                    }
                ];    

                //Imagen que pasa por la linea que tiene arco (el avion)
                dataProvider.images.push({
                        svgPath: imagen_avion,  //imagen o icono
                        positionOnLine: 0.5,   //con 0.5 -> la imagen se colocará en el medio de la línea. Los valores permitidos son de 0 a 1.

                      //Imagen
                        color: "#0000CC",  //color imagen
                        alpha: 1,       //transparencia imagen de 0-1
                          
                      //animacion
                        animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                        lineId: "line1",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                        flipDirection: true,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                        loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                        scale: 0.05,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                        positionScale: 1.3,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                        
               
                });

              
              miMapa.dataProvider = dataProvider;
              miMapa.write("mapdiv");





//Las proyecciones de un mapa
    jQuery('body').on('change','#proyecciones', function (e) {    
        //alert( $(this).val()  );
        miMapa.setProjection( jQuery(this).val()  );

    });  

    //cambiando idioma
      function setLanguage(lang) {
        if ('en' == lang)
            miMapa.language = null;
        else
            miMapa.language = lang;
        miMapa.validateData();
      }

//Inicio y fin
    jQuery('body').on('change','#idioma', function (e) {    
        //alert( $(this).val()  );
        setLanguage($(this).val());
        //miMapa.setProjection( jQuery(this).val()  );

    });


//cambiando puntos
      function puntos() {
        inicio = jQuery('#inicio').val();
        fin = jQuery('#fin').val();

        elementos = [];
        elementos.push( parseInt(inicio) );
        elementos.push(parseInt(fin));

        
          
        

        //alert(elementos);

//crear Ptos de ubicacion (Imagenes)
               dataProvider.images =  [];
               dataProvider.lines =  [];
              
              latitud_linea=[];
              longitud_linea=[];

              console.log(elementos);
              
              //jQuery.each(elementos, function( index, value ) {  
               for (var i = 0; i < mapData.length; i++) { 
                  var dataItem = mapData[i];  //value-1
                  
                  dataProvider.images.push({  //agregando cada imagen al 
                   "svgPath": dataItem.svgPath,  //para poner una imagen personalizada, comentamos "type".
                    color: dataItem.color,
                    longitude: dataItem.longitude,
                    latitude: dataItem.latitude,
                    title: dataItem.title, 
                    value: dataItem.valor,
                  });


                    if (jQuery.inArray(i+1, elementos)!=-1) {
                      console.log( jQuery.inArray(i+1, elementos)  );
                            latitud_linea.push(dataItem.latitude);
                            longitud_linea.push(dataItem.longitude);
                    }
              }    
              //});    
              


              //Lineas
               dataProvider.lines = [
                    {   //esta es la linea que quiero q se vea el vuelo
                        id: "line1",
                        color: "#CC0000", 
                        arc: -0.85,
                        latitudes: latitud_linea,
                        longitudes: longitud_linea,
                    }, {    //esta es la linea que quiero q se vea la sombra del vuelo
                        id: "line2",
                        alpha: 0,  //sin transparencia
                        color: "#000000", //sin color
                        latitudes: latitud_linea,
                        longitudes: longitud_linea,
                    }
                ];    

                //Imagen que pasa por la linea que tiene arco (el avion)
                dataProvider.images.push({
                        svgPath: imagen_avion,  //imagen o icono
                        positionOnLine: 0.5,   //con 0.5 -> la imagen se colocará en el medio de la línea. Los valores permitidos son de 0 a 1.

                      //Imagen
                        color: "#0000CC",  //color imagen
                        alpha: 1,       //transparencia imagen de 0-1
                          
                      //animacion
                        animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                        lineId: "line1",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                        flipDirection: true,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                        loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                        scale: 0.05,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                        positionScale: 1.3,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                        
               
                });




        miMapa.dataProvider = dataProvider;      
        miMapa.validateData();
      }


//Inicio y fin
    jQuery('body').on('change','#inicio, #fin', function (e) {    
       puntos(); 

    });



});             
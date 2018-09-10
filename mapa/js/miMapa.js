jQuery(document).ready(function($) {
           
           var icono_posicion = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

           var imagen_avion = "M114.1,42.2C114.2,42.2,114.2,42.2,114.1,42.2C114.2,42.2,114.2,42.2,114.1,42.2c2.6-1.1,4.6-2.1,6.1-3  c6.7-4,14.6-10.4,14.6-15.2c0-4.8-7.8-11.2-14.6-15.2c-5.4-3.2-17.5-8.6-37.8-8.6c-6.4,0-13.6,0.4-21.5,1.1c-0.2,0-0.3,0.2-0.3,0.3  c0,0,0,0,0,0c0,0,0,0.1,0,0.1c0,0,0,0.1,0,0.1c0,0,0,0,0,0l0,1.6C39.3,4.8,20.2,7.5,20.2,7.5s-5,7.3-5,16.3s5,16.6,5,16.6 s19.1,2.7,40.5,4.1l0,1.9c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0,0,0,0,0c0,0,0,0,0.1,0  c0,0,0,0,0.1,0c0,0,0,0,0.1,0c7.9,0.7,15.1,1.1,21.5,1.1C97.1,47.8,107.5,45,114.1,42.2z M82.4,0.8c1.1,0,2.2,0,3.3,0.1 c0,0,0,0,0,0.1l-0.2,1.8c-1,0-2-0.1-3.1-0.1c-3,0-6.1,0.1-9.2,0.2l0-1.8c0,0,0,0,0,0C76.4,0.9,79.5,0.8,82.4,0.8z M61.3,1.9 c3.9-0.4,7.7-0.6,11.3-0.8c0,0,0,0,0,0c0,0,0,0,0,0l0,1.8C68.8,3,65,3.2,61.3,3.4L61.3,1.9z M86.2,2.8L86.3,1c0,0,0-0.1,0-0.1 c5.3,0.2,10,0.8,14.1,1.5l-0.7,2.3C95.6,3.7,91.1,3,86.2,2.8z M100.4,4.8l0.7-2.2c0,0,0,0,0-0.1c5.2,1,9.3,2.4,12.6,3.7l-1.5,2.6  C108.7,7.3,104.8,5.9,100.4,4.8z M112.7,9.1l1.5-2.6c2.4,1,4.2,2,5.6,2.8c1.7,1,3.6,2.2,5.3,3.5l-2.2,2.4 C120.3,13.2,116.8,11,112.7,9.1z M130.7,23.7c-0.3-1.5-2.8-4.7-7.2-8.1l2.2-2.3c0,0,0,0,0,0c4.4,3.4,8.2,7.3,8.4,10.5H130.7z   M130.7,24.3h3.5c-0.2,3.2-4.1,7.2-8.6,10.6l-2.2-2.4C127.9,29.1,130.4,25.8,130.7,24.3z M122.8,32.9l2.2,2.4 c-1.7,1.2-3.5,2.4-5.2,3.4c-1.4,0.9-3.4,1.9-5.8,2.9l-1.5-2.6C116.7,37,120.1,34.9,122.8,32.9z M112.1,39.2l1.5,2.6 c-3.3,1.3-7.5,2.7-12.6,3.7l-0.7-2.3C104.7,42.1,108.6,40.7,112.1,39.2z M99.7,43.3l0.7,2.3c-4.1,0.8-8.8,1.3-14,1.5l-0.2-1.9 C91,45,95.6,44.3,99.7,43.3z M61.3,46.1l0-1.5c3.7,0.2,7.5,0.4,11.3,0.6l0,1.8C69,46.8,65.2,46.5,61.3,46.1z M73.2,45.2 c3.1,0.1,6.2,0.2,9.2,0.2c1,0,2.1,0,3.1-0.1l0.2,1.9c-1.1,0-2.1,0.1-3.3,0.1c-2.9,0-6-0.1-9.3-0.2L73.2,45.2z";
           var dataProvider;

            var mapData ;
            var  miMapa;
            jQuery.ajax({ //guardar en la cookie el conteo
                            url : '/overseas/mapa/recopilar_datos',
                            data : { 
                                  id_estatus: jQuery('#id_estatus').val(),
                                      id_pais: jQuery('#pais').val(),
                                      inicio: jQuery('#inicio').val(),
                                      fin: jQuery('#fin').val(),
                            },
                            type : 'POST',
                            dataType : 'json',
                            success : function(data) {  
                               console.log( ( data  ) );  //JSON.parse

                              mapData = data;


                              
                              
                                //AmCharts.theme = AmCharts.themes.black;

                                miMapa = new AmCharts.AmMap();
                                //miMapa.addTitle("Primer titulo", 14);
                                //miMapa.addTitle("Segundo Titulo", 11);

                                  //Común para todas las imagenes se establece aqui en ImagesSettings .
                                  miMapa.imagesSettings= {
                                      color: "#000000",
                                      rollOverColor: "#000000",
                                      selectedColor: "#000000",
                                      pauseDuration: 0.2,  //Define la pausa entre animaciones (si una línea tiene más de un segmento o la animación está en looped or flipped).
                                      animationDuration: 8.5,  //duracion de la animacion de punto a punto
                                      //adjustAnimationSpeed: true  //las imágenes a lo largo de las líneas ajustarán la velocidad de animación correspondiente a la distancia entre líneas.
                                  };

                             
                          
                                dataProvider = {
                                  "map": "worldLow",   //o mapVar: AmCharts.maps.worldLow,
                        
                                  "getAreasFromMap": false,
                              
                                  "balloon": {
                                      "adjustBorderColor": true,
                                      "color": "#0000CC",
                                      "cornerRadius": 5,
                                      "fillColor": "#0000CC"
                                    },


                                    
                                    "zoomLevel": 2,
                                   "areas": [
                                      { "id": "CU-05" , "color": "#CC0000" },   // villa_clara
                                      { "id": "CU-09" , "color": "#00CC00" }, //camaguey
                                      { "id": "CU-03" , "color": "#0000CC" }, //Ciudad de la habana
                                    ],   




                                  images: [
                                    
                                  ],
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
                                          color: "#000000", 
                                          arc: 0,
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
                                          color: "#000000",  //color imagen
                                          alpha: 1,       //transparencia imagen de 0-1
                                            
                                        //animacion
                                          animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                                          lineId: "line1",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                                          flipDirection: false,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                                          loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                                          scale: 0.1,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                                          positionScale: 1,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                                         


                                 
                                  });

                                  //Sombra del avion
                                  dataProvider.images.push({
                                          svgPath: imagen_avion,  //imagen o icono
                                          positionOnLine: 0.5,   //con 0.5 -> la imagen se colocará en el medio de la línea. Los valores permitidos son de 0 a 1.

                                        //Imagen
                                          color: "#000000",  //color imagen
                                          alpha: 0.25,       //transparencia imagen de 0-1
                                            
                                        //animacion
                                          animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                                          lineId: "line2",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                                          flipDirection: false,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                                          loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                                          scale: 0.1,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                                          positionScale: 1,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                                          
                                 
                                  });





                                
                                miMapa.dataProvider = dataProvider;
                                miMapa.write("mapdiv");

                            }

          }); 


          


//Las proyecciones de un mapa
    jQuery('body').on('change','#proyecciones', function (e) {    
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
        setLanguage($(this).val());
    });


//cambiando puntos

function puntos() {


      jQuery.ajax({ //guardar en la cookie el conteo
                            url : '/overseas/mapa/recopilar_datos',
                            data : { 
                                  id_estatus: jQuery('#id_estatus').val(),
                                      id_pais: jQuery('#pais').val(),
                                      inicio: jQuery('#inicio').val(),
                                      fin: jQuery('#fin').val(),
                                      id_puertoescala: jQuery('#fin option:selected').attr('id_puertoescala'),
                                      id_puertoescala2: jQuery('#fin option:selected').attr('id_puertoescala2'),                      
                            },
                            type : 'POST',
                            dataType : 'json',
                            success : function(data) {  
                                                           //crear Ptos de ubicacion (Imagenes)
                              dataProvider.images =  [];
                              dataProvider.lines =  [];
                              
                              latitud_linea=[];
                              longitud_linea=[];


                              mapData = data;


            jQuery('.etiq_pais').text( (jQuery('#id_estatus').val() ==1) ?  mapData[0].pais : 'México' ); 
            jQuery('.etiq_puerto').text( (jQuery('#id_estatus').val() ==1) ?  mapData[0].title : mapData[0].title ); 
            jQuery('.etiq_destino').text( (jQuery('#id_estatus').val() ==1) ?  (mapData[1].title+', México') : (mapData[1].title+' ,'+mapData[0].pais) ); 
             jQuery('.etiq_via').text( (jQuery('#id_estatus').val() ==1) ?  mapData[0].via : mapData[0].via ); 
            jQuery('.etiq_tt').text( (jQuery('#id_estatus').val() ==1) ?  mapData[0].tt : mapData[0].tt ); 

                              
                              


                             for (var i = 0; i < mapData.length; i++) { 
                                    var dataItem = mapData[i];  //value-1
                                    
                                    if (dataItem) {
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
                              
                              }    




                               //Lineas
                               dataProvider.lines = [
                                    {   //esta es la linea que quiero q se vea el vuelo
                                        id: "line1",
                                        color: "#000000", 
                                        arc: 0,
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
                                      color: "#000000",  //color imagen
                                      alpha: 1,       //transparencia imagen de 0-1
                                        
                                    //animacion
                                      animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                                      lineId: "line1",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                                      flipDirection: false,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                                      loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                                      scale: 0.1,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                                      positionScale: 3,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                                      
                             
                              });


                              dataProvider.images.push({
                                          svgPath: imagen_avion,  //imagen o icono
                                          positionOnLine: 0.5,   //con 0.5 -> la imagen se colocará en el medio de la línea. Los valores permitidos son de 0 a 1.

                                        //Imagen
                                          color: "#000000",  //color imagen
                                          alpha: 0.25,       //transparencia imagen de 0-1
                                            
                                        //animacion
                                          animateAlongLine: true,  //Si establece el "lineId" de alguna línea, la imagen se animará a lo largo de la línea.
                                          lineId: "line2",  //id para la línea y "establecer esta id" para la imagen si desea usar crear animación a lo largo de la línea
                                          flipDirection: false,  //true: Si la animación debe reproducirse en dirección inversa cuando se llega al final de una línea.
                                          loop: true,  //si debe repetir el ciclo de la animacion o finalizar cuando llegue al final

                                          scale: 0.1,  //escala de imagen. Solo funciona para imagenes creadas con svgPath, para el resto usar width/height
                                          positionScale: 1,  //escala que hara en el medio de la animación de la linea. Si establece en 2, la imagen se escalará 2 veces en el medio de la animación
                                          
                                 
                                  }); 


                              miMapa.dataProvider = dataProvider;      
                              miMapa.validateData();



                          }

        }); 



}


//Inicio y fin
    jQuery('body').on('change','#id_estatus, #pais, #inicio, #fin', function (e) {    
       //puntos(); 

    var campo = jQuery(this).attr("name");   

    if (campo=='id_estatus') {
        jQuery('.etiq1').text( (jQuery('#id_estatus').val() ==1) ?  'Origen' : 'Destino' ); ;
        jQuery('.etiq2').text( (jQuery('#id_estatus').val() ==1) ?  'Destino' : 'Origen' ); ;

    } 



     var val_estatus  = jQuery('#id_estatus').val();           //option:selected').text();     
     var val_pais = jQuery('#pais').val();        
     var val_inicio = jQuery('#inicio').val();        
     var val_fin  = jQuery('#fin').val();   
      
      dependencia = jQuery('#'+campo).attr("dependencia");         
        
      if (dependencia !="")  {     
          jQuery("#"+dependencia).html('');  //limpiar la dependencia
          cargarDependencia_existente(campo,dependencia,val_estatus,val_pais, val_inicio,val_fin);
       } else {
          puntos(); 
       }


       

    });




    function cargarDependencia_existente(campo,dependencia,val_estatus,val_pais, val_inicio,val_fin) {
      

      jQuery.ajax({
              url : '/overseas/mapa/cargar_dependencia',
              data:{
                dependencia: dependencia,
                campo:campo,
                val_estatus:val_estatus,
                val_pais: val_pais,
                val_inicio:val_inicio,
                val_fin:val_fin,
              },


              type : 'POST',
              dataType : 'json',
              success : function(data) {
                    
                      if (data != "[]") {
                              jQuery.each(data, function (i, valor) {
                                    if (valor.nombre !== null) {
                                        if (campo="fin") {
                                         jQuery("#"+dependencia).append('<option value="' + valor.identificador + '" id_puertoescala="' + valor.id_puertoescala + '" id_puertoescala2="' + valor.id_puertoescala2 + '"  >' + valor.nombre + '</option>');     
                                        } else {
                                          jQuery("#"+dependencia).append('<option value="' + valor.identificador + '"  >' + valor.nombre + '</option>');     
                                        }
                                    }
                              });
                      }   

                        jQuery("#"+dependencia).trigger('change');  

                      return false;                    

              }, //success

          }); 
    }










});             
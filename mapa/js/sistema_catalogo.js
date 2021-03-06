jQuery(document).ready(function($) {

      

//Inicio y fin
    jQuery('body').on('change','#id_estatus, #pais, #inicio, #fin', function (e) {    
       //puntos(); 

          var campo = jQuery(this).attr("name");   

          jQuery('#nuevo_catalogo').attr("href",'/mapa/nuevo_catalogo/'+jQuery.base64.encode( jQuery('#id_estatus').val() ) );   
          

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
                //puntos(); 
                var oTable =jQuery('#tabla_catalogos').dataTable();
                oTable._fnAjaxUpdate();
             }


       

    });




    function cargarDependencia_existente(campo,dependencia,val_estatus,val_pais, val_inicio,val_fin) {
      jQuery.ajax({
              url : '/mapa/cargar_dependencia',
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
                              jQuery("#"+dependencia).append('<option value="0" >Todos</option>');
                              jQuery.each(data, function (i, valor) {
                                    if (valor.nombre !== null) {
                                         jQuery("#"+dependencia).append('<option value="' + valor.identificador + '"  >' + valor.nombre + '</option>');     
                                    }
                              });
                      }   

                        jQuery("#"+dependencia).trigger('change');  

                      return false;                    

              }, //success

          }); 
    }

jQuery("#id_estatus").trigger('change');  







var hash_url = window.location.pathname;



jQuery('#tabla_catalogos').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_catalogos",
              "type": "POST",
                               "data": function ( d ) {
                            d.id_estatus= jQuery('#id_estatus').val();
                                     d.id_pais= jQuery('#pais').val();
                                      d.inicio= jQuery('#inicio').val();
                                         d.fin= jQuery('#fin').val();
                             }  
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },

/*
                                      0=>$row->id,
                                      1=>$row->title,
                                      2=>$row->pais,
                                      3=>$row->tt,
                                      4=>$row->city,
                                      5=>$row->latitude,
                                      6=>$row->longitude,
                                      7=>$row->pop,
                                      8=>$row->country,
                                      9=>$row->iso2,
                                      10=>$row->iso3,
                                      11=>$row->province,
                                      12=>$row->via,


e.id_puerto id, e.puerto title,  e.tt, m.city,  m.lat latitude, 
m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via
*/

    "columnDefs": [
               { 
                    "render": function ( data, type, row ) {
                        if (row[14]==1) {
                          return  row[1]+'('+row[2]+')'; //puerto(pais)
                        }  else {
                           return row[5]+'(México)'; //destino  
                        }
                        

                    },
                    "targets": [0] 
                },
                { 
                    "render": function ( data, type, row ) {
                        if (row[14]==1) {
                            return row[5]+'(México)'; //destino  
                        }  else {
                           return  row[1]+'('+row[2]+')'; //puerto(pais)
                        }
                    },
                    "targets": [1] //
                },
                { 
                    "render": function ( data, type, row ) {
                        return row[13]; //destino
                    },
                    "targets": [2] //,via
                },
                { 
                    "render": function ( data, type, row ) {
                        return row[15]; //destino
                    },
                    "targets": [3] //,via
                },

                {
                    "render": function ( data, type, row ) {
                      if  ( (hash_url!="/mapa/buscador") )   {  

                          texto='<td>';
                            texto+='<a href="/mapa/editar_catalogo/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode( jQuery('#id_estatus').val()  )+'" type="button"'; 
                            texto+=' class="btn btn-warning btn-sm btn-block" >';
                              texto+=' <span class="glyphicon glyphicon-edit"></span>';
                            texto+=' </a>';
                          texto+='</td>';
                       } else {
                        texto=' <fieldset disabled> <td>';                
                          texto+=' <a href="#"'; 
                          texto+=' class="btn btn-danger btn-sm btn-block">';
                            texto+=' <span class="glyphicon glyphicon-edit"></span>';
                          texto+=' </a>';
                        texto+=' </td></fieldset>'; 
                      
                      }  



                      return texto; 
                    },
                    "targets": 4
                },

                
                {
                    "render": function ( data, type, row ) {

                      if  ( (hash_url!="/mapa/buscador") )   {  
                        texto=' <td>';                
                        texto+=' <a href="/mapa/eliminar_catalogo/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[2]+' '+row[3])+ '"'; 
                        texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
                        texto+=' <span class="glyphicon glyphicon-remove"></span>';
                        texto+=' </a>';
                      texto+=' </td>';  
                            } else {
                        texto=' <fieldset disabled> <td>';                
                        texto+=' <a href="#"'; 
                        texto+=' class="btn btn-danger btn-sm btn-block">';
                        texto+=' <span class="glyphicon glyphicon-remove"></span>';
                        texto+=' </a>';
                      texto+=' </td></fieldset>'; 
                      
                      }
                  


              return texto; 
                    },
                    "targets": 5
                },
               
                
            ],


"fnHeaderCallback": function( nHead, aData, iStart, iEnd, aiDisplay ) {
      var api = this.api();
           api.column(4).visible(true); 
           api.column(5).visible(true); 

         
         

        if  ( (hash_url=="/mapa/buscador") )   {  
                
             api.column(4).visible(false); 
             api.column(5).visible(false); 
        }   



  },


  }); 


///////////////////////////////////////puerto//////////////////////////////////////////////////

jQuery('#tabla_puertos').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_puertos",
              "type": "POST",
                               "data": function ( d ) {
                                         d.prueba= '';
                             }  
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },

    "columnDefs": [
              
              { //color, medida, ancho
                  "render": function ( data, type, row ) {
            return data;  
                  },
                  "targets": [0,1,2,3,4,5]
              },
          

                {
                    "render": function ( data, type, row ) {
                      if  ( (hash_url!="/mapa/buscador") )   {  

                          texto='<td>';
                            texto+='<a href="/mapa/editar_puerto/'+jQuery.base64.encode(row[0])+'" type="button"'; 
                            texto+=' class="btn btn-warning btn-sm btn-block" >';
                              texto+=' <span class="glyphicon glyphicon-edit"></span>';
                            texto+=' </a>';
                          texto+='</td>';
                       } else {
                        texto=' <fieldset disabled> <td>';                
                          texto+=' <a href="#"'; 
                          texto+=' class="btn btn-warning btn-sm btn-block">';
                            texto+=' <span class="glyphicon glyphicon-edit"></span>';
                          texto+=' </a>';
                        texto+=' </td></fieldset>'; 
                      
                      }  



                      return texto; 
                    },
                    "targets": 6
                },

                
                {
                    "render": function ( data, type, row ) {

                      /*if  ( (hash_url!="/mapa/buscador") )   {  
                        texto=' <td>';                
                        texto+=' <a href="/mapa/eliminar_catalogo/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[1]+' '+row[2])+ '"'; 
                        texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
                        texto+=' <span class="glyphicon glyphicon-remove"></span>';
                        texto+=' </a>';
                      texto+=' </td>';  
                            } else*/ {
                        texto=' <fieldset disabled> <td>';                
                        texto+=' <a href="#"'; 
                        texto+=' class="btn btn-danger btn-sm btn-block">';
                        texto+=' <span class="glyphicon glyphicon-remove"></span>';
                        texto+=' </a>';
                      texto+=' </td></fieldset>'; 
                      
                      }
                  


              return texto; 
                    },
                    "targets": 7
                },
               
                
            ],




  }); 

/////////////////////////////////////////////////////////////////////////////////////////


var opts = {
    lines: 13, 
    length: 20, 
    width: 10, 
    radius: 30, 
    corners: 1, 
    rotate: 0, 
    direction: 1, 
    color: '#E8192C',
    speed: 1, 
    trail: 60,
    shadow: false,
    hwaccel: false,
    className: 'spinner',
    zIndex: 2e9, 
    top: '50%', // Top position relative to parent
    left: '50%' // Left position relative to parent   
  };

  
  jQuery(".navigacion").change(function() {
      document.location.href = jQuery(this).val();
  });

    var target = document.getElementById('foo');



});
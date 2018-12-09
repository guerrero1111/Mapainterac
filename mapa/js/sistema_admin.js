jQuery(document).ready(function($) {


	//logueo y recuperar contraseña
	jQuery("#form_login").submit(function(e){
		jQuery('#foo').css('display','block');

		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				
				if(data != true){
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				}else{
						spinner.stop();
						jQuery('#foo').css('display','none');

						window.location.href = '/mapa/admin';
				}
			}
		});
		return false;
	});





	//gestion de usuarios (crear, editar y eliminar )
	jQuery('body').on('submit','#form_usuarios', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/mapa/'+$catalogo;				
				}
			} 
		});
		return false;
	});	








jQuery('#tabla_usuarios').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_usuarios",
	         		"type": "POST",
	         		
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
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]+' '+row[3]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //perfil
		                },
		                "targets": [1] //,2,3,4
		            },		            

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //email
		                },
		                "targets": [2] //,2,3,4
		            },


		            {
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="/mapa/editar_usuario/'+jQuery.base64.encode(row[0])+'" type="button"'; 
							texto+=' class="btn btn-warning btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';



							return texto;	
		                },
		                "targets": 3
		            },

		            
		            {
		                "render": function ( data, type, row ) {

		                	if (true) {  //row[4]==0
	   							texto='	<td>';								
									texto+=' <a href="/mapa/eliminar_usuario/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[2]+' '+row[3])+ '"'; 
									texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td>';	
		                	} else {
	   							texto='	<fieldset disabled> <td>';								
									texto+=' <a href="#"'; 
									texto+=' class="btn btn-danger btn-sm btn-block">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td></fieldset>';	
	                		
		                	}
									


							return texto;	
		                },
		                "targets": 4
		            },
		           
		            
		        ],
	});	

	jQuery('#modalMessage').on('hide.bs.modal', function(e) {
	    jQuery(this).removeData('bs.modal');
	});	






jQuery('#tabla_acceso_usuario').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_historico_accesos",
	         		"type": "POST",
	         		
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

 									0=>$row->nombre,
                                      1=>$row->apellidos,
                                      2=>$row->perfil,
                                      3=>$row->email,
                                      4=>$row->fecha,
                                      5=>$row->ip_address,
                                      6=>$row->user_agent,
                                      7=>$row->telefono,
*/

		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[0]+' '+row[1]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; //perfil
		                },
		                "targets": [1] 
		            },		            

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //email
		                },
		                "targets": [2] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //fecha
		                },
		                "targets": [3] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //ip_addrees
		                },
		                "targets": [4] 
		            },

		            		            			    	{ 
		            "render": function ( data, type, row ) {
		                		return row[6]; //user_agent
		                },
		                "targets": [5] 
		            },


					{ 
		                 "visible": false,
		                "targets": [6]
		            }

		            
		        ],
	});	

jQuery('#tabla_listado_completo').dataTable( {
	
	  "pagingType": "full_numbers",
		 "order": [[ 3, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_participantes_unico",
	         		"type": "POST",
	         		
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
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[8]; //Fecha creación
		                },
		                "targets": [0] 
		            },		            


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]+' '+row[3]; //nombre+apellidos
		                },
		                "targets": [1] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //nick
		                },
		                "targets": [2] 
		            },		           		            


			    	// { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[10]; //nick
		      //           },
		      //           "targets": [3] 
		      //       },		  

		            { 
		                "render": function ( data, type, row ) {
		                		return row[12]; //ticket
		                },
		                "targets": [3] 
		            },	
		            	
			    		            
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return '$'+row[18]; //monto
		      //           },
		      //           "targets": [7] //,2,3,4
		      //       },		
			    	// { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[5]; //email
		      //           },
		      //           "targets": [8] //,2,3,4
		      //       },

			    	// { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[6]; //telefono
		      //           },
		      //           "targets": [9] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[7]; //telefono
		      //           },
		      //           "targets": [5] //,2,3,4
		      //       },
			    	// { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[1]; //estado
		      //           },
		      //           "targets": [6] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[11]; //calle
		      //           },
		      //           "targets": [7] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[13]; //numero
		      //           },
		      //           "targets": [8] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[14]; //colonia
		      //           },
		      //           "targets": [9] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[15]; //municipio
		      //           },
		      //           "targets": [10] //,2,3,4
		      //       },
		      //       { 
		      //           "render": function ( data, type, row ) {
		      //           		return row[16]; //cp
		      //           },
		      //           "targets": [11] //,2,3,4
		      //       },
		            { 
		                "render": function ( data, type, row ) {
		                		return row[17]; //ciudad
		                },
		                "targets": [4] //,2,3,4
		            },


 					{
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="/mapa/detalle_participante/'+jQuery.base64.encode(row[0])+'" type="button"'; 
							texto+=' class="btn btn-info btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';



							return texto;	
		                },
		                "targets": 5
		            },

					{ 

		                 "visible": false,
		                "targets": [5] //6
		            }
		            
		           
		            
		        ],
	});	



jQuery('#tabla_participantes_unicos').dataTable( {
	
	  "pagingType": "full_numbers",
		 "order": [[ 3, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_participantes_unico",
	         		"type": "POST",
	         		
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
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[7]; //Fecha creación
		                },
		                "targets": [0] 
		            },		            


/*
   //
                                      9 17=>intval($row->cantidad),
                                      10 18=>intval($row->ptoface),
                                      11 19=>intval($row->transaccion),
                                      12 20=>intval($row->total_iguales),
                                      13 21=>intval($row->total_desiguales),
*/
                                      

// 
					{ 
		                "render": function ( data, type, row ) {
		                		return row[9]- (row[10]==100); //
		                },
		                "targets": [1] 
		            },
					{ 
		                "render": function ( data, type, row ) {
		                		return row[11]; //
		                },
		                "targets": [2] 
		            },
					{ 
		                "render": function ( data, type, row ) {
		                		return row[12]+row[13]; //
		                },
		                "targets": [3] 
		            },		            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[10]; //
		                },
		                "targets": [4] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return (row[12]+row[13])+row[11]+row[10];
		                },
		                "targets": [5] 
		            },
				
		            //



			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]+' '+row[3]; //nombre+apellidos
		                },
		                "targets": [6] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return '@'+row[4]; //nick
		                },
		                "targets": [7] 
		            },		           		            


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[8]; //nick
		                },
		                "targets": [8] 
		            },		  



			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //email
		                },
		                "targets": [9] //,2,3,4
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[6]; //telefono
		                },
		                "targets": [10] //,2,3,4
		            },
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //estado
		                },
		                "targets": [11] //,2,3,4
		            },



 					{
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="/mapa/detalle_participante/'+jQuery.base64.encode(row[0])+'" type="button"'; 
							texto+=' class="btn btn-info btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';



							return texto;	
		                },
		                "targets": 12
		            },

					{ 

		                 "visible": false,
		                "targets": [13] //6
		            }
		            
		           
		            
		        ],
	});	








//listado de participantes

jQuery('#tabla_participantes').dataTable( {
	  "pagingType": "full_numbers",
		   "order": [[ 3, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_participantes",
	         		"type": "POST",
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
								
										//fecha_creacion, total_ticket, 
									//total_ptos_face, total_tikect_acumulados,
									//nombre, nick, contraseña, email, telefono, , fecha_nac
                                      */
/*
0=>$row->id,
                                      1=>$row->fecha_creacion,
                                      2=>intval($row->total_ticket),
                                      3=>intval($row->total_puntos_face),
                                      4=>intval($row->total),
                                      5=>$row->nomb_completo,
                                      6=>$row->nick,
                                      7=>$row->contrasena,
                                      8=>$row->email,
                                      9=>$row->telefono,
                                      10=>$row->fecha_nac,  */                                    
 
		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //Fecha creación
		                },
		                "targets": [0] 
		            },		            
		           // 
					{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; // total_ticket
		                },
		                "targets": [1] 
		            },
					            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //TOTAL DE PUNTOS DE FACEBOOK total_ptos_face
		                },
		                "targets": [2] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //TOTAL DE PUNTOS ACUMULADOS total_tikect_acumulados
		                },
		                "targets": [3] 
		            },
				
		          

/////////
					{ 
		                "render": function ( data, type, row ) {
		                		return row[11]; //semana1
		                },
		                "targets": [4] 
		            },
				

					{ 
		                "render": function ( data, type, row ) {
		                		return row[12]; //semana2
		                },
		                "targets": [5] 
		            },
				

					{ 
		                "render": function ( data, type, row ) {
		                		return row[13]; //semana3
		                },
		                "targets": [6] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[14]; //semana4
		                },
		                "targets": [7] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[15]; //semana5
		                },
		                "targets": [8] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[16]; //semana6
		                },
		                "targets": [9] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[17]; //semana7
		                },
		                "targets": [10] 
		            },


///////////////


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //+' '+row[2]; //nombre+apellidos
		                },
		                "targets": [11] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return '@'+row[6]; //nick
		                },
		                "targets": [12] 
		            },		           		            


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[7]; //contraseña
		                },
		                "targets": [13] 
		            },		  

		          
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[8]; //email
		                },
		                "targets": [14] //,2,3,4
		            },

			    
		            { 
		                "render": function ( data, type, row ) {
		                		return row[9]; //telefono
		                },
		                "targets": [15] //,2,3,4
		            },
			    	

		            { 
		                "render": function ( data, type, row ) {
		                		return row[10]; //fecha_nac
		                },
		                "targets": [16] //,2,3,4
		            },


 					{
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="/mapa/detalle_participante/'+jQuery.base64.encode(row[0])+'" type="button"'; 
							texto+=' class="btn btn-info btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';



							return texto;	
		                },
		                "targets": 17
		            },

					{ 

		                 "visible": false,
		                 //"targets": [11] //6
		                
		            }
		            
		        ],
	});	





jQuery('#tabla_detalle_participantes').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_detalle_participantes",
	         		"type": "POST",
	         		"data": function ( d ) {
	         		 	d.id = jQuery('#id').val();  
	         		 },
	         		
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


		//puntos, redes, cadena, ticket, fecha_compra, monto, numero_tienda, producto, presentacion

		"columnDefs": [
			    	
			    		{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //Puntos
		                },
		                "targets": [0] 
		            },		            
		           // 
					{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; // redes
		                },
		                "targets": [1] 
		            },
					{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //cadena
		                },
		                "targets": [2] 
		            },
					            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //ticket
		                },
		                "targets": [3] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //fecha_compra
		                },
		                "targets": [4] 
		            },
				
					{ 
		                "render": function ( data, type, row ) {
		                		return row[6]; //monto
		                },
		                "targets": [5] 
		            },
		          

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[7]; //Num. tienda
		                },
		                "targets": [6] 
		            },



			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[8]; //producto
		                },
		                "targets": [7] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[9]; //Presentacion o litraje
		                },
		                "targets": [8] 
		            },

			    
					{ 

		                 "visible": false,
		               // "targets": [9] 
		            }
		            
		           
		            
		        ],
	});	





jQuery('#tabla_participantes_cupones').dataTable( {
	  "pagingType": "full_numbers",
		   "order": [[ 0, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_participante_cupones",
	         		"type": "POST",
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
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[0]; //total de cu
		                },
		                "targets": [0] 
		            },		            
		           // 
					{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; // total_ticket
		                },
		                "targets": [1] 
		            },
					            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; //TOTAL DE PUNTOS DE FACEBOOK total_ptos_face
		                },
		                "targets": [2] 
		            },

					
		
					{ 

		                 "visible": false,
		                // "targets": [3] //6
		                
		            }
		            
		        ],
	});	




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//historico de participantes

jQuery('#tabla_bitacora_participante').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/mapa/procesando_historico_participantes",
	         		"type": "POST",
	         		
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
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]+' '+row[2]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return '@'+row[3]; //nick
		                },
		                "targets": [1] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //email
		                },
		                "targets": [2] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //fecha acceso
		                },
		                "targets": [3] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[6]; //ip_addrees
		                },
		                "targets": [4] 
		            },

		            		            			    	{ 
		            "render": function ( data, type, row ) {
		                		return row[7]; //user_agent
		                },
		                "targets": [5] 
		            },


					{ 
		                 "visible": false,
		                "targets": [6,7]
		            }

		            
		        ],
	});	

/////////////////////////////////premios///////////////////////

jQuery('#tabla_cat_premios').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_cat_premios",
              "type": "POST",
              
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
            
            	{ 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //nombre
                },

            	{ 
                    "render": function ( data, type, row ) {
                        return row[2];
                    },
                    "targets": [1] //premio
                },
          
            	{ 
                    "render": function ( data, type, row ) {
                        return row[3];
                    },
                    "targets": [2] //cantidad
                },

                {
                    "render": function ( data, type, row ) {
				            texto='<td>';
				              texto+='<a href="/mapa/editar_premio/'+jQuery.base64.encode(row[0])+'" type="button"'; 
				              texto+=' class="btn btn-warning btn-sm btn-block" >';
				                texto+=' <span class="glyphicon glyphicon-edit"></span>';
				              texto+=' </a>';
				            texto+='</td>';
				              return texto; 
                    },
                    "targets": 3
                },
                
                {
                    "render": function ( data, type, row ) {
		                      if (row[4]==0) {
					                  texto=' <td>';                
					                  texto+=' <a href="/mapa/eliminar_premio/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
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
			           "targets": 4
			    },
               
                
            ],
  }); 

/////////////////////////////////imagenes///////////////////////

jQuery('#tabla_cat_imagenes').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_cat_imagenes",
              "type": "POST",
              
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
            
            	{ 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //nombre
                },

            	{ 
                    "render": function ( data, type, row ) {
                        return row[2];
                    },
                    "targets": [1] //imagen
                },
          
            	{ 
                    "render": function ( data, type, row ) {
                        return row[3];
                    },
                    "targets": [2] //puntos
                },

                {
                    "render": function ( data, type, row ) {
				            texto='<td>';
				              texto+='<a href="/mapa/editar_imagen/'+(row[0])+'" type="button"'; 
				              texto+=' class="btn btn-warning btn-sm btn-block" >';
				                texto+=' <span class="glyphicon glyphicon-edit"></span>';
				              texto+=' </a>';
				            texto+='</td>';
				              return texto; 
                    },
                    "targets": 3
                },
                
                {
                    "render": function ( data, type, row ) {
		                      if (row[4]==0) {
					                  texto=' <td>';                
					                  texto+=' <a href="/mapa/eliminar_imagen/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
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
			           "targets": 4
			    },
               
                
            ],
  }); 

/////////////////////////////////Litrajes///////////////////////

jQuery('#tabla_cat_litrajes').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_cat_litrajes",
              "type": "POST",
              
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
            
            { 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //,2,3,4
                },

          

                {
                    "render": function ( data, type, row ) {

            texto='<td>';
              texto+='<a href="/mapa/editar_litraje/'+(row[0])+'" type="button"'; 
              texto+=' class="btn btn-warning btn-sm btn-block" >';
                texto+=' <span class="glyphicon glyphicon-edit"></span>';
              texto+=' </a>';
            texto+='</td>';


              return texto; 
                    },
                    "targets": 1
                },

                
                {
                    "render": function ( data, type, row ) {

                      if (row[2]==0) {
                  texto=' <td>';                
                  texto+=' <a href="/mapa/eliminar_litraje/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
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
                    "targets": 2
                },
               
                
            ],
  }); 


/////////////////////////////////Estados///////////////////////



  jQuery('#tabla_cat_estados').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/mapa/procesando_cat_estados",
              "type": "POST",
              
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
            
            { 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //,2,3,4
                },

          

                {
                    "render": function ( data, type, row ) {

            texto='<td>';
              texto+='<a href="/mapa/editar_estado/'+(row[0])+'" type="button"'; 
              texto+=' class="btn btn-warning btn-sm btn-block" >';
                texto+=' <span class="glyphicon glyphicon-edit"></span>';
              texto+=' </a>';
            texto+='</td>';


              return texto; 
                    },
                    "targets": 1
                },

                
                {
                    "render": function ( data, type, row ) {

                      if (row[2]==0) {
                  texto=' <td>';                
                  texto+=' <a href="/mapa/eliminar_estado/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
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
                    "targets": 2
                },
               
                
            ],
  }); 

	jQuery('body').on('submit','#form_catalogos', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/mapa/'+$catalogo;				
				}
			} 
		});
		return false;
	});	

//Agregar las estradas a salidas
jQuery('body').on('click','#exportar_reportes', function (e) {
		  	  busqueda      = jQuery('input[type=search]').val();

	    abrir('POST', 'exportar_reportes', {
	    			busqueda:busqueda,
	    			tipo_reporte: jQuery(this).attr('nombre') //reportes_participante
	    }, '_blank' );
});






abrir = function(verb, url, data, target) {
  var form = document.createElement("form");
  form.action = url;
  form.method = verb;
  form.target = target || "_self";
  if (data) {
    for (var key in data) {
      var input = document.createElement("textarea");
      input.name = key;
      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
      form.appendChild(input);
    }
  }
  form.style.display = 'none';
  document.body.appendChild(form);
  form.submit();
};


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

	
	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});

   	var target = document.getElementById('foo');


});
<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class modelo_admin extends CI_Model{
		
		private $key_hash;
		private $timezone;

		function __construct(){
			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
			$this->timezone    = 'UM1';

				//usuarios
		      $this->usuarios             = $this->db->dbprefix('usuarios'); 
          $this->perfiles             = $this->db->dbprefix('perfiles');

          $this->configuraciones      = $this->db->dbprefix('catalogo_configuraciones');
          
          $this->proveedores          = $this->db->dbprefix('catalogo_empresas');
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->catalogo_estados      = $this->db->dbprefix('catalogo_estados');
          $this->participantes      = $this->db->dbprefix('participantes');
          $this->bitacora_participante      = $this->db->dbprefix('bitacora_participante');

          $this->registro_participantes         = $this->db->dbprefix('registro_participantes');
          $this->catalogo_litraje      = $this->db->dbprefix('catalogo_litraje');

          $this->catalogo_imagenes         = $this->db->dbprefix('catalogo_imagenes');
          $this->catalogo_premios      = $this->db->dbprefix('catalogo_premios');

          
          $this->coordenadas         = $this->db->dbprefix('coordenadas');
          $this->catalogo_cupones         = $this->db->dbprefix('catalogo_cupones');

          $this->catalogo_cadenas         = $this->db->dbprefix('catalogo_cadenas');
          $this->catalogo_productos         = $this->db->dbprefix('catalogo_productos');
          $this->catalogo_litrajes         = $this->db->dbprefix('catalogo_litrajes');

          
          $this->catalogo_puerto           = $this->db->dbprefix('catalogo_puerto');
          $this->catalogo_exportacion     = $this->db->dbprefix('catalogo_exportacion_pana');
          $this->catalogo_importacion     = $this->db->dbprefix('catalogo_importacion_pana');


          $this->catalogo_pais     = $this->db->dbprefix('catalogo_pais');
          


        $this->fecha_unixtime_inicio    = strtotime('07/15/2018');  
        $this->fecha_unixtime_hoy    = now(); //strtotime("now");


		}








public function buscador_participantes_cupones($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];



          switch ($columa_order) {
                      case '0':
                        $columna = 'total_cupones';
                     break;
                    case '1':
                        $columna = 'email';
                     break;

                    case '2':
                        $columna = 'cupones';
                     break;

                  
                   default:
                        $columna = 'total_cupones'; //por defecto los ṕuntos
                        $order = 'desc';
                     break;
                 }             



                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          $this->db->select("COUNT(c.id) as total_cupones"); //total de tickets
          $this->db->select("id, email");            
          /*$this->db->select( 'GROUP_CONCAT(DISTINCT(   CONCAT("<span style=color:red>", c.valor, "</span> [",( CASE WHEN c.fecha_participacion = 0 THEN "" ELSE DATE_FORMAT(FROM_UNIXTIME(c.fecha_participacion),"%d-%m-%Y %H:%i:%s") END ),"]  "  )    ) ORDER BY c.id SEPARATOR "|") as cupones',false);*/

           //  (3600*6hrs) es 21600
           $this->db->select( 'GROUP_CONCAT(DISTINCT(   CONCAT("<span style=color:red>", c.valor, "</span> [",( CASE WHEN (c.fecha_participacion-21600) = 0 THEN "" ELSE DATE_FORMAT(FROM_UNIXTIME( (c.fecha_participacion-21600)  ),"%d-%m-%Y %H:%i:%s") END ),"]  "  )    ) ORDER BY c.id SEPARATOR "|") as cupones',false);

          //$this->db->select("( CASE WHEN c.fecha_participacion = 0 THEN "" ELSE DATE_FORMAT(FROM_UNIXTIME(c.fecha_participacion),"%d-%m-%Y %H:%i:%s") END ) AS fecha_participacion", FALSE); 

          $this->db->from($this->catalogo_cupones.' as c'); 
          
          $where = '( (c.email <>"") && (c.email is not null) )';
          
          $this->db->where($where);  
       

          //ordenacion
          $this->db->group_by('c.email'); 

         //ordenacion
         $this->db->order_by($columna, $order); 


          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>intval($row->total_cupones),
                                      1=>$row->email,
                                      2=>$row->cupones, //.$row->fecha_participacion,
                                    );
                      }

                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => $registros_filtrados,  //intval( self::total_participantes() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  






public function buscador_participantes($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];



          switch ($columa_order) {
                      case '0':
                        $columna = 'fecha_creacion';
                     break;
                    case '1':
                        $columna = 'total_ticket';
                     break;

                    case '2':
                        $columna = 'total_puntos_face';
                     break;

                    case '3':
                        $columna = 'total';
                     break;


                    case '4':
                        $columna = 'puntos_semana1';
                     break;

                   case '5':
                        $columna = 'puntos_semana2';
                     break;

                   case '6':
                        $columna = 'puntos_semana3';
                     break;

                   case '7':
                        $columna = 'puntos_semana4';
                     break;


                   case '8':
                        $columna = 'puntos_semana5';
                     break;

                   case '9':
                        $columna = 'puntos_semana6';
                     break;

                   case '10':
                        $columna = 'puntos_semana7';
                     break;

                   case '11':
                        $columna = 'nomb_completo';
                     break;
                  case '12':
                        $columna = 'nick';  
                     break;
                  case '13':
                        $columna = 'contrasena';  
                     break;               

                  case '14':
                        $columna = 'email';  
                     break;                     
                  case '15':
                        $columna = 'telefono';
                     break;      
                  case '16':
                        $columna = 'fecha_nacimiento';  //puntos
                     break;
                   default:
                        $columna = 'fecha_creacion'; //por defecto los ṕuntos
                        $order = 'desc';
                     break;
                 }             



                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
                  //fecha_creacion, total_ticket, 
                  //total_ptos_face, total_puntos,
                  //nombre, nick, contraseña, email, telefono, , fecha_nac

          

          $this->db->select("p.id", FALSE);           
          $this->db->select("( CASE WHEN p.creacion = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.creacion),'%d-%m-%Y') END ) AS fecha_creacion", FALSE); 
          $this->db->select("COUNT(r.id_participante) as total_ticket"); //total de tickets

          $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total_puntos_face", FALSE); 
          //$this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')) AS total", FALSE);  //sin redes
          $this->db->select("
             sum( (AES_DECRYPT( r.valor,  '{$this->key_hash}')) + ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total",false );  //con redes

          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("CONCAT( AES_DECRYPT(p.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(p.apellidos,'{$this->key_hash}') )  AS nomb_completo", FALSE);      

          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
          $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);    //sino es p.celular
          $this->db->select("( CASE WHEN p.fecha_nac = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.fecha_nac),'%d-%m-%Y') END ) AS fecha_nacimiento", FALSE); 
         

      





//devuelve la semana en q estoy
          $semana_actual=ceil(((ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)==0) ? 1 : ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)) / 7) ;

          $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual-1) );
          $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual) )-1;

          
          $this->db->select($semana_actual." as semana_actual",false);

          ////separado   no lo uso por el momento. actual
          $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana", FALSE);
          $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}'))))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana", FALSE); 


          for ($i=1; $i <=7 ; $i++) { 

            
            $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i-1) );
            $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i) )-1;
            
           $this->db->select("sum( AES_DECRYPT(r.valor, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) + ( (r.redes =1)*(( AES_DECRYPT(r.valor, '{$this->key_hash}')))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) ) AS puntos_semana".$i, FALSE);
            
             
            
            //separado   no lo uso por el momento
            $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana_solo".$i, FALSE);
            $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) *( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana".$i, FALSE); 



          }





          $this->db->from($this->participantes.' as p'); 
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
          
          
          //filtro de busqueda
            /*
            $where = "(

                      (
                        (  CONCAT( AES_DECRYPT(p.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(p.apellidos,'{$this->key_hash}') ) LIKE  '%".$cadena."%' )
                        OR ( AES_DECRYPT(p.email,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                        OR ( AES_DECRYPT(p.telefono,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                        OR ( AES_DECRYPT(p.celular,'{$this->key_hash}') LIKE  '%".$cadena."%' )
                         OR ( AES_DECRYPT(p.calle,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                         OR ( p.numero LIKE  '%".$cadena."%' ) 
                         OR ( AES_DECRYPT(p.colonia,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                         OR ( AES_DECRYPT(p.municipio,'{$this->key_hash}') LIKE  '%".$cadena."%' )
                         OR ( AES_DECRYPT(p.cp,'{$this->key_hash}') LIKE  '%".$cadena."%' )
                         OR ( AES_DECRYPT(p.ciudad,'{$this->key_hash}') LIKE  '%".$cadena."%' )
                        OR ( DATE_FORMAT(FROM_UNIXTIME(p.fecha_pc),'%d-%m-%Y %H:%i:%s') LIKE  '%".$cadena."%' ) 
                       
                        
                        OR ( r.monto LIKE  '%".$cadena."%' ) 
                        OR ( AES_DECRYPT(r.ticket,'{$this->key_hash}') LIKE  '%".$cadena."%' )
                        
                        
                        OR ( CONCAT('@',AES_DECRYPT(p.nick,'{$this->key_hash}') )LIKE  '%".$cadena."%' ) 

                        OR ( AES_DECRYPT(p.contrasena,'{$this->key_hash}') LIKE  '%".$cadena."%' )

                        
                        
                       )
            )";              

  
          $this->db->where($where);
          */
    
          //ordenacion
         // $this->db->order_by($columna, $order); 


          //ordenacion
          $this->db->group_by('p.id'); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->fecha_creacion.'-'.$row->id,
                                      2=>intval($row->total_ticket),
                                      3=>intval($row->total_puntos_face),
                                      4=>intval($row->total),
                                      5=>$row->nomb_completo,
                                      6=>$row->nick,
                                      7=>$row->contrasena,
                                      8=>$row->email,
                                      9=>$row->telefono,
                                      10=>$row->fecha_nacimiento,
                                      11=>$row->puntos_semana1, //+$row->total_redes_semana1,
                                      12=>$row->puntos_semana2,
                                      13=>$row->puntos_semana3,
                                      14=>$row->puntos_semana4,
                                      15=>$row->puntos_semana5,
                                      16=>$row->puntos_semana6,
                                      17=>$row->puntos_semana7,

                                    );
                      }

                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => $registros_filtrados,  //intval( self::total_participantes() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  



//////////////////////////////////////////////////////////////

      

  public function buscador_detalle_participantes($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                  case '0':
                        $columna = 'puntos';  
                     break;  

                  case '1':
                        $columna = 'redes';  
                     break;              

                  case '2':
                        $columna = 'cadena';  
                     break;               
                 
                  case '3':
                        $columna = 'ticket';  
                     break;                     
                  case '4':
                        $columna = 'fecha_compra'; //por defecto los ṕuntos
                     break;                                    
                  case '5':
                        $columna = 'monto';  
                     break;                     
                 case '6':
                        $columna = 'num_tienda';  
                     break;                     

                 case '7':
                        $columna = 'producto';  
                     break;                     

                 case '8':
                        $columna = 'litraje';  
                     break;                     
              

                   default:
                        $columna = 'puntos'; //por defecto los ṕuntos
                     break;
                 }                 

          
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          

          $this->db->select("p.id", FALSE);           
          
          $this->db->select("p.id", FALSE);  
          $this->db->select("
             ( (AES_DECRYPT( r.valor,  '{$this->key_hash}')) + ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS puntos",false );  //con redes
          //$this->db->select("( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS redes", FALSE); 
          $this->db->select("( CASE WHEN r.redes = 1 THEN 'Si' ELSE 'No' END ) AS redes", FALSE);

          $this->db->select("c.nombre cadena,l.nombre litraje,prod.nombre producto");  

          $this->db->select("AES_DECRYPT(r.ticket,'{$this->key_hash}') AS ticket", FALSE);      
          $this->db->select("( CASE WHEN r.compra = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(r.compra),'%d-%m-%Y') END ) AS fecha_compra", FALSE); 
          $this->db->select("sum(AES_DECRYPT(r.monto,'{$this->key_hash}') ) AS monto", FALSE);

          $this->db->select("sum(AES_DECRYPT(r.tienda,'{$this->key_hash}') ) AS numero_tienda", FALSE);             
          



        

          
    


          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
          $this->db->join($this->catalogo_cadenas.' as c', 'r.id_cadena = c.id');
          $this->db->join($this->catalogo_litrajes.' as l', 'r.id_litraje = l.id');
          $this->db->join($this->catalogo_productos.' as prod', 'r.id_producto = prod.id');

          //$this->db->where("p.id", '"'.$data['id'].'"',false);  
          //$this->db->where('r.ticket',"AES_ENCRYPT('{$this->session->userdata('num_ticket_participante')}','{$this->key_hash}')",FALSE);


          //filtro de busqueda
       
          
          $where = "( (p.id='".$data['id']."') ) AND   
                  (
                         ( AES_DECRYPT(r.ticket,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                         OR ( AES_DECRYPT(r.monto,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                         
                         OR ( DATE_FORMAT(FROM_UNIXTIME(r.compra),'%d-%m-%Y') LIKE  '%".$cadena."%' ) 

          


                   )     


           ";      
          $this->db->where($where);
          $this->db->group_by('r.ticket');

          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 

          $basede = base_url();
          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {

                   

                               $dato[]= array(
                                               //puntos, redes, cadena, ticket, fecha_compra, monto, numero_tienda, producto, presentacion
                                     0=>$row->id, 
                                     1=>$row->puntos, 
                                     2=>$row->redes, 
                                     3=>$row->cadena, 
                                     4=>$row->ticket, 
                                     5=>$row->fecha_compra, 
                                     6=>intval($row->monto), 
                                     7=>$row->numero_tienda, 
                                     8=>$row->producto, 
                                     9=>$row->litraje, 

                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => $registros_filtrados, 
                        "recordsFiltered" => $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      











        public function listado_configuraciones(){

            $this->db->select('c.id, c.configuracion, c.valor, c.activo');
            $this->db->from($this->configuraciones.' as c');
            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }     




        public function listado_usuarios_correo( $id_perfil ){

            $this->db->select($this->usuarios.'.id, nombre,  apellidos');
            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->from($this->usuarios);
            $this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');

           // $this->db->where($this->usuarios.'.especial !=', 2);  //quitar en caso de no super-administrador
            //$this->db->where($this->usuarios.'.id_perfil', $id_perfil+1);
            //$this->db->or_where($this->usuarios.'.id_perfil', 1);  //quitar en caso de no super-administrador
            


          $where = '(
                     (
                        ('.$this->usuarios.'.especial <> 2 ) AND ('.$this->usuarios.'.especial <> 3 ) AND ('.$this->usuarios.'.id_perfil='.($id_perfil+1).')
                     ) OR ('.$this->usuarios.'.id_perfil=1)
            )';   
            


          $this->db->where($where);






            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }     



		//login
		public function check_login($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->select("AES_DECRYPT(contrasena,'{$this->key_hash}') AS contrasena", FALSE);			
			$this->db->select($this->usuarios.'.nombre,'.$this->usuarios.'.apellidos');			
			$this->db->select($this->usuarios.'.id,'.$this->perfiles.'.id_perfil,'.$this->perfiles.'.perfil,'.$this->perfiles.'.operacion');
            $this->db->select($this->usuarios.'.especial');         

                
			$this->db->from($this->usuarios);
			$this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');
			$this->db->where('contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);


			$login = $this->db->get();

			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();
		}

        //anadir al historico de acceso
        public function anadir_historico_acceso($data){

            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data->id_perfil);

            $this->db->set( 'id_usuario', $data->id);
            $this->db->set( 'fecha',  gmt_to_local( $timestamp, 'UM1', TRUE) );
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            

            $this->db->insert($this->historico_acceso );

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }

       public function total_acceso($limit=-1, $offset=-1){

            $fecha = date_create(date('Y-m-j'));
            date_add($fecha, date_interval_create_from_date_string('-1 month'));
            $data['fecha_inicial'] = date_format($fecha, 'm');
            $data['fecha_final'] = $data['fecha_final'] = (date('m'));


            $this->db->from($this->historico_acceso.' As h');
            $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario','LEFT');
            $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id_perfil','LEFT');

            if  (($data['fecha_inicial']) and ($data['fecha_final'])) {
                $this->db->where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_inicial'] );
                $this->db->or_where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_final'] );
            } 

              

           $unidades = $this->db->get();            
           return $unidades->num_rows();
        }

       


		
		//Recuperar contraseña		
	    public function recuperar_contrasena($data){
			$this->db->select("AES_DECRYPT(u.email,'{$this->key_hash}') AS email", FALSE);						
			$this->db->select('u.nombre,u.apellidos');
			$this->db->select("AES_DECRYPT(u.telefono,'{$this->key_hash}') AS telefono", FALSE);			
			$this->db->select("AES_DECRYPT(u.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
			$this->db->from($this->usuarios.' as u');
			$this->db->where('u.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();		
	    }	

	
	
   
        public function coger_usuarios($limit=-1, $offset=-1, $uid ){

            $especial=$this->session->userdata('especial');

		    $this->db->select($this->usuarios.'.id, nombre,  apellidos');
            

            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
			$this->db->select($this->perfiles.'.id_perfil,'.$this->perfiles.'.perfil,'.$this->perfiles.'.operacion');
			$this->db->from($this->usuarios);
			$this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');
			$this->db->where( $this->usuarios.'.id !=', $uid );
            if ($especial==3) {
                $this->db->where( $this->usuarios.'.especial =3' );
            }


            if ($limit!=-1) {
                $this->db->limit($limit, $offset); 
            } 
             

			$result = $this->db->get();
			
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }        

        //eliminar usuarios
        public function borrar_usuario( $uid ){
            $this->db->delete( $this->usuarios, array( 'id' => $uid ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }



        //editar	
        public function coger_catalogo_usuario( $uid ){
            $this->db->select('id, nombre, apellidos, id_perfil');
            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
            $this->db->select( "AES_DECRYPT( contrasena,'{$this->key_hash}') AS contrasena", FALSE );
            $this->db->where('id', $uid);
            $result = $this->db->get($this->usuarios );
            if ($result->num_rows() > 0)
            	return $result->row();
            else 
            	return FALSE;
            $result->free_result();
        }  


		public function check_correo_existente($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->from($this->usuarios);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return FALSE;
			else
				return TRUE;
			$login->free_result();
		}

		public function anadir_usuario( $data ){
            $timestamp = time();

            $id_session = $this->session->userdata('id');
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

            $this->db->set( 'id', "UUID()", FALSE);
			$this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);
            

            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->insert($this->usuarios );

            if ($this->db->affected_rows() > 0){
            		return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }

		public function check_usuario_existente($data){
			
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->from($this->usuarios);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$this->db->where('id !=',$data['id']);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return FALSE;
			else
				return TRUE;
			$login->free_result();
		}        


        public function edicion_usuario( $data ){

            $timestamp = time();

            $id_session = $this->session->userdata('id');
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

			$this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);
            
            
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->where('id', $data['id'] );
            $this->db->update($this->usuarios );
            if ($this->db->affected_rows() > 0) {
				return TRUE;
			}  else
				 return FALSE;
        }		

//----------------**************catalogos-------------------************------------------
        public function coger_catalogo_perfiles(){
            $this->db->select( 'id_perfil, perfil, operacion' );
            $perfiles = $this->db->get($this->perfiles );
            if ($perfiles->num_rows() > 0 )
            	 return $perfiles->result();
            else
            	 return FALSE;
            $perfiles->free_result();
        }	    	

   			    


      public function buscador_usuarios($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                   case '0':
                        $columna = 'u.nombre';
                     break;
                   case '1':
                        $columna = 'p.perfil';
                     break;
                   case '2':
                        $columna = 'email';
                     break;
                     
                   
                   default:
                        $columna = 'u.nombre';
                     break;
                 }                 

                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          

          $this->db->select('u.id, u.nombre, u.apellidos, u.id_perfil');
          $this->db->select( "AES_DECRYPT( u.email,'{$this->key_hash}') AS email", FALSE );
          $this->db->select( "AES_DECRYPT( u.telefono,'{$this->key_hash}') AS telefono", FALSE );
          $this->db->select( "AES_DECRYPT( u.contrasena,'{$this->key_hash}') AS contrasena", FALSE );
          $this->db->select('p.perfil');

          $this->db->from($this->usuarios.' as u');
          $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id_perfil');
          $this->db->where( 'u.id !=', $id_session);
          
          //filtro de busqueda
       
          $where = '(

                      (
                        ( u.nombre LIKE  "%'.$cadena.'%" ) OR (u.apellidos LIKE  "%'.$cadena.'%") OR (p.perfil LIKE  "%'.$cadena.'%") 
                        OR (  AES_DECRYPT( u.email,"{$this->key_hash}")  LIKE  "%'.$cadena.'%") 
                        
                       )
            )';   



  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->perfil,
                                      2=>$row->nombre,
                                      3=>$row->apellidos,
                                      4=>$row->email,
                                      5=>$row->telefono,
                                      
                                      
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_usuarios() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      



        public function total_usuarios(){
            $id_session = $this->session->userdata('id');

            $especial=$this->session->userdata('especial');

            $this->db->from($this->usuarios.' as u');
            $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id_perfil');

            $this->db->where( 'u.id !=', $id_session );
                           
            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }       






      public function historico_acceso($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                  case '0':
                        $columna = 'u.nombre';
                     break;
                  case '1':
                        $columna = 'p.perfil';
                     break;
                  case '2':
                        $columna = 'h.email';
                     break;
                  case '3':
                        $columna = 'h.fecha';
                     break;  
                  case '4':
                        $columna = 'h.ip_address';
                     break;  
                  case '5':
                        $columna = 'h.user_agent';
                     break;                      
                   
                   default:
                        $columna = 'u.nombre';
                     break;
                 }                 

                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          




            $this->db->select("AES_DECRYPT(h.email,'{$this->key_hash}') AS email", FALSE);            
            $this->db->select('p.id_perfil, p.perfil, p.operacion');
            $this->db->select('u.nombre,u.apellidos');         
            $this->db->select('h.ip_address, h.user_agent, h.id_usuario');
            $this->db->select("( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%d-%m-%Y %H:%i:%s') END ) AS fecha", FALSE);  

            $this->db->from($this->historico_acceso.' As h');
            $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario');
            $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id_perfil','LEFT');
          
          //filtro de busqueda
       
       
          $where = '(

                      (
                        ( u.nombre LIKE  "%'.$cadena.'%" ) OR (u.apellidos LIKE  "%'.$cadena.'%") OR (p.perfil LIKE  "%'.$cadena.'%") 
                        OR (  AES_DECRYPT( h.email,"{$this->key_hash}")  LIKE  "%'.$cadena.'%") 
                        OR (  DATE_FORMAT(FROM_UNIXTIME(h.fecha),"%d-%m-%Y %H:%i:%s")     LIKE  "%'.$cadena.'%") 
                        OR (h.ip_address LIKE  "%'.$cadena.'%")
                        OR (h.user_agent LIKE  "%'.$cadena.'%")
                       )
            )';   


        

  
  
          $this->db->where($where);
      

          //ordenacion
         $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

         

              if ( $result->num_rows() > 0 ) {
                
                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);
                    

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                     
                                      0=>$row->nombre,
                                      1=>$row->apellidos,
                                      2=>$row->perfil,
                                      3=>$row->email,
                                      4=>$row->fecha,
                                      5=>$row->ip_address,
                                      6=>$row->user_agent,
                                      
                                      
                                      
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_historico_acceso() ), 
                        "recordsFiltered" =>  $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      



        public function total_historico_acceso(){
            $id_session = $this->session->userdata('id');

            $especial=$this->session->userdata('especial');

            $this->db->from($this->historico_acceso.' As h');
            $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario');
            $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id_perfil','LEFT');
          

            //$this->db->where( 'u.id !=', $id_session );
                           
            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }       

     



        public function total_participantes(){
            

          $this->db->from($this->participantes.' as p');
          $this->db->join($this->catalogo_estados.' as c', 'c.id = p.id_estado');
          $this->db->join($this->catalogo_premios.' as pr', 'pr.id = p.id_premio');

            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }       



public function buscador_listado_completo($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                   case '0':
                        $columna = 'fecha_pc_compra';
                     break;
                   case '1':
                        $columna = 'nomb';
                     break;
                  case '2':
                        $columna = 'nick';  
                     break;
                  case '3':
                        $columna = 'contrasena';  
                     break;          

                  // case '5':
                  //       $columna = 'email';  
                  //    break;                     
                  // case '6':
                  //       $columna = 'telefono';
                  //    break;      
                     case '7':
                        $columna = 'celular';
                     break;                 
                  case '8':
                        $columna = 'estado';  
                     break;                                                                                   
                   case '9':
                        $columna = 'calle';  
                     break; 
                     case '10':
                        $columna = 'ticket';  
                     break;
                     
                     case '12':
                        $columna = 'numero';  //puntos
                     break;
                     case '13':
                        $columna = 'colonia';  //puntos
                     break;
                     case '14':
                        $columna = 'municipio';  //puntos
                     break;
                     case '15':
                        $columna = 'cp';  //puntos
                     break;
                     case '16':
                        $columna = 'ciudad';  //puntos
                     break;
                     // case '17':
                     //    $columna = 'monto';  //puntos
                     // break;
                   default:
                        $columna = 'fecha_pc_compra'; //por defecto los ṕuntos
                        $order = 'desc';
                     break;
                 }                 

                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          

          $this->db->select("p.id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nomb", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);   
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);  
          $this->db->select("AES_DECRYPT(p.calle,'{$this->key_hash}') AS calle", FALSE);      
          $this->db->select("p.numero numero", FALSE); 
          $this->db->select("AES_DECRYPT(p.colonia,'{$this->key_hash}') AS colonia", FALSE);  
          $this->db->select("AES_DECRYPT(p.municipio,'{$this->key_hash}') AS municipio", FALSE);
          $this->db->select("AES_DECRYPT(p.cp,'{$this->key_hash}') AS cp", FALSE);
          $this->db->select("AES_DECRYPT(p.ciudad,'{$this->key_hash}') AS ciudad", FALSE);  
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("CONVERT(AES_DECRYPT(p.total,'{$this->key_hash}'),decimal) AS puntos", FALSE);
           $this->db->select("( CASE WHEN r.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(r.fecha_pc),'%d-%m-%Y %H:%i:%s') END ) AS fecha_pc_compra", FALSE); 
          $this->db->select("( CASE WHEN p.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.fecha_pc),'%d-%m-%Y %H:%i:%s') END ) AS fecha", FALSE);  
          $this->db->select("c.nombre estado", FALSE);           
           $this->db->select("AES_DECRYPT(r.monto,'{$this->key_hash}') AS monto", FALSE);
           $this->db->select("AES_DECRYPT(r.ticket,'{$this->key_hash}') AS ticket", FALSE);    
            

          $this->db->from($this->participantes.' as p');
          $this->db->join($this->catalogo_estados.' as c', 'c.id = p.id_estado');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
          
       

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->estado,
                                      2=>$row->nomb,
                                      3=>$row->apellidos,
                                      4=>$row->nick,
                                      // 5=>$row->email,
                                      // 6=>$row->telefono,
                                      7=>$row->celular,
                                      8=>$row->fecha_pc_compra,
                                      10=>$row->contrasena,
                                      11=>$row->calle,
                                      12=>$row->ticket,
                                      13=>$row->numero,
                                      14=>$row->colonia,
                                      15=>$row->municipio,
                                      16=>$row->cp,
                                      17=>$row->ciudad,
                                      // 18=>$row->monto,
                                      
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_participantes() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();     

      }  









public function buscador_participantes_unico($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                   case '0':
                        $columna = 'fecha_pc_compra';
                     break;

                    case '1':
                        $columna = 'TICKETS_REGISTRADOS';
                      break;

                    case '2':
                        $columna = 'PUNTOS_OBTENIDOS_COMPRA';
                     break;

                    case '3':
                        $columna = 'PUNTOS_OBTENIDOS_JUEGO';
                     break;

                    case '4':
                        $columna = 'TOTAL_PUNTOS_FACEBOOK';
                     break;

                    case '5':
                        $columna = 'TOTAL_PUNTOS_ACUMULADOS';
                     break;

                   case '6':
                        $columna = 'nomb';
                     break;
                  case '7':
                        $columna = 'nick';  
                     break;
                  case '8':
                        $columna = 'contrasena';  
                     break;               

                                   

                  case '9':
                        $columna = 'email';  
                     break;                     
                  case '10':
                        $columna = 'telefono';
                     break;                     
                  case '11':
                        $columna = 'estado';  
                     break;                                                                                   
                   
                   default:
                        $columna = 'fecha'; //por defecto los ṕuntos
                        $order = 'desc';
                     break;
                 }                 

                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          

          $this->db->select("p.id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nomb", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          //$this->db->select("CONVERT(AES_DECRYPT(p.total,'{$this->key_hash}'),decimal) AS puntos", FALSE);
          $this->db->select("( CASE WHEN p.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.fecha_pc),'%d-%m-%Y %H:%i:%s') END ) AS fecha", FALSE);  
          $this->db->select("c.nombre estado", FALSE);           

///////////////////new

 $this->db->select(" ((SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) = 'fac-')*1)*100 AS total_facebook", FALSE);         
$this->db->select("
sum(
 ((
              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
                AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')



  )*1 ) * (AES_DECRYPT(r.transaccion,'{$this->key_hash}') )
 ) AS total_iguales
",false );
$this->db->select("
sum(
 ((
              NOT(( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) ) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
              AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')              
  )*1 ) * 25
 ) AS total_desiguales
",false );
          $this->db->select("( CASE WHEN SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) = 'fac-' THEN 100 ELSE 0 END ) AS ptoface", FALSE);
          
          $this->db->select("sum(AES_DECRYPT(r.transaccion,'{$this->key_hash}') ) AS transaccion", FALSE);

          $this->db->select("COUNT(r.id_participante) as 'cantidad'");
          
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);    


///////////////////fin new


///////////////////////*********************

/////////


          $this->db->select("COUNT((SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')*1) as  TICKETS_REGISTRADOS",false);

          
          


          $this->db->select("sum(AES_DECRYPT(r.transaccion,'{$this->key_hash}') ) AS PUNTOS_OBTENIDOS_COMPRA", FALSE);





$this->db->select("

sum(
 ((
              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
                AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')


  )*1 ) * (AES_DECRYPT(r.transaccion,'{$this->key_hash}') )
 )+

sum(
 ((
              NOT(( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) ) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
                AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')
  )*1 ) * 25
 ) PUNTOS_OBTENIDOS_JUEGO
  ",FALSE);



          $this->db->select("( CASE WHEN SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) = 'fac-' THEN 100 ELSE 0 END ) AS TOTAL_PUNTOS_FACEBOOK", FALSE);
          




$this->db->select("

sum(
 ((
              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
                AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')


  )*1 ) * (AES_DECRYPT(r.transaccion,'{$this->key_hash}') )
 )+

sum(
 ((
              NOT(( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,2,1) ) AND

              ( SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,1,1) = SUBSTR(CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) ,3,1) ) )
              AND
              (SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) <> 'fac-')
                AND
              (CAST(BASE64_DECODE(AES_DECRYPT(r.puntos,'{$this->key_hash}')) AS CHAR) <> '000')
  )*1 ) * 25
 ) +
 sum(AES_DECRYPT(r.transaccion,'{$this->key_hash}') )+
 ( CASE WHEN SUBSTR(AES_DECRYPT(r.ticket,'{$this->key_hash}'),1,4 ) = 'fac-' THEN 100 ELSE 0 END )
 as
 TOTAL_PUNTOS_ACUMULADOS

  ",FALSE);          
/////////////////////***********************          




          $this->db->from($this->participantes.' as p'); 
          $this->db->join($this->catalogo_estados.' as c', 'c.id = p.id_estado');
          //$this->db->join($this->catalogo_estados.' as c', 'c.id = p.id_estado');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante', 'LEFT');
          





          //$this->db->from($this->participantes.' as p');
          
          
          






          
          //filtro de busqueda
            $where = "(

                      (
                        (  CONCAT( AES_DECRYPT(p.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(p.apellidos,'{$this->key_hash}') ) LIKE  '%".$cadena."%' )
                        OR ( AES_DECRYPT(p.email,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                        OR ( AES_DECRYPT(p.telefono,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                        OR ( DATE_FORMAT(FROM_UNIXTIME(p.fecha_pc),'%d-%m-%Y %H:%i:%s') LIKE  '%".$cadena."%' ) 
                        OR ( c.nombre LIKE  '%".$cadena."%' ) 
                        OR ( CONCAT('@',AES_DECRYPT(p.nick,'{$this->key_hash}') )LIKE  '%".$cadena."%' ) 

                        OR ( AES_DECRYPT(p.contrasena,'{$this->key_hash}') LIKE  '%".$cadena."%' )

                        
                        
                       )
            )";              

  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          $this->db->group_by('p.id');           

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->estado,
                                      2=>$row->nomb,
                                      3=>$row->apellidos,
                                      4=>$row->nick,
                                      5=>$row->email,
                                      6=>$row->telefono,
                                      7=>$row->fecha,
                                      
                                      8=>$row->contrasena,

                                      //
                                      9=>intval($row->cantidad),
                                      10=>intval($row->ptoface),
                                      11=>intval($row->transaccion),
                                      12=>intval($row->total_iguales),
                                      13=>intval($row->total_desiguales),


                                      
                                      
                                      
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_participantes_unico() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      



        public function total_participantes_unico(){
            

          $this->db->from($this->participantes.' as p');
          $this->db->join($this->catalogo_estados.' as c', 'c.id = p.id_estado');
          
          

            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }       

//detalles del participantes

          public function listado_imagenes(){

            $this->db->select('c.id, c.nombre, c.valor, c.activo, c.puntos');
            $this->db->from($this->catalogo_imagenes.' as c');
            $this->db->where('c.activo',0);
            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }   

    



        public function total_detalle_participantes($data){
            

             $this->db->from($this->participantes.' as p');
            $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
            $this->db->join($this->catalogo_litraje.' as l', 'r.id_litraje = l.id');
            $where = "( (p.id='".$data['id']."') )";      

            $this->db->where($where);
            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }       






        //historico participantes

 public function bitacora_participantes($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];



              switch ($columa_order) {
                   case '0':
                        $columna = 'nomb';
                     break;
                   case '1':
                        $columna = 'nick';
                     break;                     
                  case '2':
                        $columna = 'correo';  
                     break;                     
                  case '3':
                        $columna = 'fecha';
                     break;                     
                  
                  case '4':
                        $columna = 'ip_address';
                     break;  
                  case '5':
                        $columna = 'user_agent';
                     break;                                                                                                       
                   
                   default:
                        $columna = 'fecha'; //por defecto los ṕuntos
                     break;
              }        









                                      

          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          



            $this->db->select("h.id", FALSE);            
            $this->db->select("AES_DECRYPT(h.email,'{$this->key_hash}') AS correo", FALSE);            
            $this->db->select("AES_DECRYPT(u.nombre,'{$this->key_hash}') AS nomb", FALSE);      
            $this->db->select("AES_DECRYPT(u.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
            $this->db->select("AES_DECRYPT(u.nick,'{$this->key_hash}') AS nick", FALSE);      
            $this->db->select('h.ip_address, h.user_agent, h.id_usuario');
            $this->db->select("( CASE WHEN h.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha_pc),'%d-%m-%Y %H:%i:%s') END ) AS fecha", FALSE);  

            $this->db->from($this->bitacora_participante.' As h');
            $this->db->join($this->participantes.' As u' , 'u.id = h.id_usuario');
          
          //filtro de busqueda
       
       

        $where = "(

                      (
                        (  CONCAT( AES_DECRYPT(u.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(u.apellidos,'{$this->key_hash}') ) LIKE  '%".$cadena."%' )
                        OR ( AES_DECRYPT(h.email,'{$this->key_hash}') LIKE  '%".$cadena."%' ) 
                        OR ( DATE_FORMAT(FROM_UNIXTIME(h.fecha_pc),'%d-%m-%Y %H:%i:%s') LIKE  '%".$cadena."%' ) 
                        OR (h.ip_address LIKE  '%".$cadena."%' ) 
                        OR (h.user_agent LIKE  '%".$cadena."%' ) 
                        OR ( CONCAT('@',AES_DECRYPT(u.nick,'{$this->key_hash}') )LIKE  '%".$cadena."%' ) 
                        
                       )
            )";   

       
  
          $this->db->where($where);
          
      

          //ordenacion
         $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

         

              if ( $result->num_rows() > 0 ) {
                
                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);
                    

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                     
                                      0=>$row->id,
                                      1=>$row->nomb,
                                      2=>$row->apellidos,
                                      3=>$row->nick,
                                      4=>$row->correo,
                                      5=>$row->fecha,
                                      6=>$row->ip_address,
                                      7=>$row->user_agent,
                                      
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_bitacora_participantes() ), 
                        "recordsFiltered" =>  $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      



        public function total_bitacora_participantes(){
            $this->db->from($this->bitacora_participante.' As h');
            $this->db->join($this->participantes.' As u' , 'u.id = h.id_usuario');
            
           $total = $this->db->get();            
           return $total->num_rows();
            
        }               



      public function exportar_participantes($data){
          
          $cadena = addslashes($data['busqueda']);
          $id_session = $this->session->userdata('id');



          $this->db->select("p.id", FALSE);           
          $this->db->select("( CASE WHEN p.creacion = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.creacion),'%d-%m-%Y') END ) AS fecha_creacion", FALSE); 
          $this->db->select("COUNT(r.id_participante) as total_ticket"); //total de tickets

          $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total_puntos_face", FALSE); 
          //$this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')) AS total", FALSE);  //sin redes
          $this->db->select("
             sum( (AES_DECRYPT( r.valor,  '{$this->key_hash}')) + ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total",false );  //con redes

          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("CONCAT( AES_DECRYPT(p.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(p.apellidos,'{$this->key_hash}') )  AS nomb_completo", FALSE);      

          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
          $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);    //sino es p.celular
          $this->db->select("( CASE WHEN p.fecha_nac = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.fecha_nac),'%d-%m-%Y') END ) AS fecha_nacimiento", FALSE); 
         

      





//devuelve la semana en q estoy
          $semana_actual=ceil(((ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)==0) ? 1 : ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)) / 7) ;

          $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual-1) );
          $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual) )-1;

          
          $this->db->select($semana_actual." as semana_actual",false);

          ////separado   no lo uso por el momento. actual
          //$this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana", FALSE);
          //$this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}'))))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana", FALSE); 


          for ($i=1; $i <=7 ; $i++) { 

            
            $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i-1) );
            $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i) )-1;
            
           $this->db->select("sum( AES_DECRYPT(r.valor, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) + ( (r.redes =1)*(( AES_DECRYPT(r.valor, '{$this->key_hash}')))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) ) AS puntos_semana".$i, FALSE);
            
             
            
            //separado   no lo uso por el momento
           // $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) ) AS puntos_semana_solo".$i, FALSE);
            //$this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) *( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) AS total_redes_semana".$i, FALSE); 



          }





          $this->db->from($this->participantes.' as p'); 
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
          
          
       
          //agrupar
          $this->db->group_by('p.id'); 

          $result = $this->db->get();


              if ( $result->num_rows() > 0 ) {
                  return $result->result();
                    
              }  else {
                  return false; 

              }

              $result->free_result();           

      }  
      

 public function exportar_participantes_detalle($data){
          
          $cadena = addslashes($data['busqueda']);
          $id_session = $this->session->userdata('id');



          $this->db->select("p.id", FALSE);           
          $this->db->select("( CASE WHEN p.creacion = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.creacion),'%d-%m-%Y') END ) AS fecha_creacion", FALSE); 
          $this->db->select("COUNT(r.id_participante) as total_ticket"); //total de tickets


          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("CONCAT( AES_DECRYPT(p.nombre,'{$this->key_hash}'),' ',AES_DECRYPT(p.apellidos,'{$this->key_hash}') )  AS nomb_completo", FALSE);      

          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
          $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);    //sino es p.celular
          $this->db->select("( CASE WHEN p.fecha_nac = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(p.fecha_nac),'%d-%m-%Y') END ) AS fecha_nacimiento", FALSE); 
         

      



           $this->db->select("sum( ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total_puntos_face", FALSE); 

          $this->db->select("
             sum( (AES_DECRYPT( r.valor,  '{$this->key_hash}')) + ((r.redes=1) * (( AES_DECRYPT(r.valor, '{$this->key_hash}')))) ) AS total",false );  //con redes



      //devuelve la semana en q estoy
          $semana_actual=ceil(((ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)==0) ? 1 : ceil(($this->fecha_unixtime_hoy-$this->fecha_unixtime_inicio)/86400)) / 7) ;

          $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual-1) );
          $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($semana_actual) )-1;

            


          for ($i=1; $i <=7 ; $i++) { 

            
            $primer_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i-1) );
            $ultimo_dia_semana_actual = $this->fecha_unixtime_inicio + ( (86400*7)*($i) )-1;
            
           $this->db->select("sum( AES_DECRYPT(r.valor, '{$this->key_hash}')*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  )) + ( (r.redes =1)*(( AES_DECRYPT(r.valor, '{$this->key_hash}')))*( (r.fecha_pc >= ".$primer_dia_semana_actual.") AND (r.fecha_pc <= ".$ultimo_dia_semana_actual."  ))  ) ) AS puntos_semana".$i, FALSE);

          }



          $this->db->select("c.nombre cadena,l.nombre litraje,prod.nombre producto");  

          $this->db->select("AES_DECRYPT(r.ticket,'{$this->key_hash}') AS ticket", FALSE);      
          $this->db->select("( CASE WHEN r.compra = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(r.compra),'%d-%m-%Y') END ) AS fecha_compra", FALSE); 
          $this->db->select("sum(AES_DECRYPT(r.monto,'{$this->key_hash}') ) AS monto", FALSE);

          $this->db->select("sum(AES_DECRYPT(r.tienda,'{$this->key_hash}') ) AS numero_tienda", FALSE);             
          


          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');
          $this->db->join($this->catalogo_cadenas.' as c', 'r.id_cadena = c.id');
          $this->db->join($this->catalogo_litrajes.' as l', 'r.id_litraje = l.id');
          $this->db->join($this->catalogo_productos.' as prod', 'r.id_producto = prod.id');
          
                 
  
          $this->db->group_by('r.ticket');


          $result = $this->db->get();


              if ( $result->num_rows() > 0 ) {
                  return $result->result();
                    
              }  else {
                  return false; 

              }

              $result->free_result();           

      }  
      




public function exportar_participantes_cupones($data){
          
          $cadena = addslashes($data['busqueda']);
          $id_session = $this->session->userdata('id');
          
          $this->db->select("COUNT(c.id) as total_cupones"); //total de tickets
          $this->db->select("email");            
          //$this->db->select( 'GROUP_CONCAT(DISTINCT(c.valor) ORDER BY c.id SEPARATOR "|") as cupones',false);


           $this->db->select( 'GROUP_CONCAT(DISTINCT(   CONCAT("<span style=color:red>", c.valor, "</span> [",( CASE WHEN (c.fecha_participacion-21600) = 0 THEN "" ELSE DATE_FORMAT(FROM_UNIXTIME( (c.fecha_participacion-21600)  ),"%d-%m-%Y %H:%i:%s") END ),"]  "  )    ) ORDER BY c.id SEPARATOR "|") as cupones',false);
           
          $this->db->from($this->catalogo_cupones.' as c'); 
          $where = '( (c.email <>"") && (c.email is not null) )';
          $this->db->where($where);  

          //ordenacion
          $this->db->group_by('c.email'); 

          $result = $this->db->get();
 
              if ( $result->num_rows() > 0 ) {
                  return $result->result();
                    
              }  else {
                  return false; 

              }

              $result->free_result();        

      }  




public function buscador_catalogos($data){
          
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];


          switch ($columa_order) {
                   case '0':
                        $columna = 'u.nombre';
                     break;
                   case '1':
                        $columna = 'p.perfil';
                     break;
                   case '2':
                        $columna = 'email';
                     break;
                     
                   
                   default:
                        $columna = 'u.nombre';
                     break;
                 }                 

                                      




          //$id_session = $this->db->escape($this->session->userdata('id'));
           $id_session = $this->session->userdata('id');

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //

        
           $this->db->select('e.id, e.id_puerto,  e.id_destino, e.id_puertoescala,e.id_puertoescala2,e.tarifa, e.salidas, e.minimo, e.tt, e.precio');

           $this->db->select('m.lat lat_origen,  m.lng long_origen,  m.puerto puerto_origen,  m.country pais_origen');
           $this->db->select('d.lat lat_destino, d.lng long_destino, d.puerto puerto_destino, d.country pais_destino');

            

            $this->db->select("( CASE WHEN esc1.puerto is null THEN '' ELSE  esc1.puerto END ) AS escala1", FALSE);             
            $this->db->select("( CASE WHEN esc2.puerto is null THEN '' ELSE  esc2.puerto END ) AS escala2", FALSE);             
          
          

          
            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }


          $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
          $this->db->join($this->catalogo_puerto.' d', 'e.id_destino=d.id');

          $this->db->join($this->catalogo_puerto.' esc1', 'e.id_puertoescala=esc1.id','LEFT');
          $this->db->join($this->catalogo_puerto.' esc2', 'e.id_puertoescala2=esc2.id','LEFT');



             $filtro="";        

                if  ($data['id_pais']!=0){
                   $filtro.= (($filtro!="") ? " and " : "") . "(e.id_pais = ".$data["id_pais"].") ";
                }
                if ($data['inicio'] !=0) {
                  $filtro.= (($filtro!="") ? " and " : "") . "(e.id_puerto = ".$data["inicio"].") ";
                } 
                if  ($data['fin']!=0){
                   $filtro.= (($filtro!="") ? " and " : "") . "(e.id_destino = ".$data["fin"].") ";
                }


            if ($filtro!="") {
                  $this->db->where($filtro);
             }


  
          
    
          //ordenacion
         // $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                       $escala = ( ($row->escala1 =='')  AND ($row->escala2 =='') ) ? 'directo' : ($row->escala1.' <br/> '.$row->escala2);

                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->puerto_origen,
                                      2=>$row->pais_origen,
                                      3=>$row->puerto_destino,
                                      4=>$row->pais_destino,
                                      5=>$escala,
                                      6=>$row->precio,
                                      7=>$data['id_estatus'],
                                      
                                    );
                      }


                       




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => $registros_filtrados, 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      }  
      


       //editar 
        public function get_catalogo( $data ){

             $this->db->select('e.id_puerto, e.id, e.puerto title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via, pto_destino');
             
             $this->db->select('e.tarifa,e.salidas,e.minimo,e.id_destino,e.id_puertoescala, e.id_puertoescala2, e.precio');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
             $where = '(
                      (
                        ( e.id = '.$data['id'].' ) 
                      )
            ) ' ; 
            $this->db->where($where); 

            

              $result = $this->db->get();
              if ($result->num_rows() > 0){
               return ($result->row());
              }
              else 
                return FALSE;
              $login->free_result();


        }  






      public function paises($data){
            

            $this->db->select('p.id, p.puerto nombre, p.city, p.country');
            $this->db->from($this->catalogo_puerto.' p');  
            $this->db->group_by('p.id');

              $result = $this->db->get();
              if ($result->num_rows() > 0){
               return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }  



        public function edicion_catalogo( $data ){

            $timestamp = time();

            $id_session = $this->session->userdata('id');
                 
            $this->db->set( 'id_puerto', $data['id_puerto'] );
            $this->db->set( 'id_destino', $data['id_destino'] );
            $this->db->set( 'id_puertoescala', $data['id_puertoescala'] );
            $this->db->set( 'id_puertoescala2', $data['id_puertoescala2'] );

            $this->db->set( 'tarifa', $data['tarifa'] );
            $this->db->set( 'salidas', $data['salidas'] );
            $this->db->set( 'minimo', $data['minimo'] );
            $this->db->set( 'tt', $data['tt'] );
            $this->db->set( 'precio', $data['precio'] );
            $this->db->where('id', $data['id'] );

            if  ($data['id_estatus']==1) {
              $this->db->update($this->catalogo_importacion );


                
            } else { //caso de 2
                $this->db->update($this->catalogo_exportacion );
            }

            
            if ($this->db->affected_rows() > 0) {
               if  ($data['id_estatus']==1) {
                       $consulta=  "UPDATE ".$this->catalogo_importacion." as e  
                       JOIN ".$this->catalogo_puerto." as m  ON e.id_puerto=m.id
                       JOIN ".$this->catalogo_puerto." as d  ON e.id_destino=d.id

                        LEFT JOIN ".$this->catalogo_puerto." as esc1  ON e.id_puertoescala=esc1.id
                        LEFT JOIN ".$this->catalogo_puerto." as esc2  ON e.id_puertoescala2=esc2.id

                         SET e.pais = m.country,
                              e.puerto = m.puerto,
                              e.pto_destino = d.puerto,
                              e.via= CONCAT( (CASE WHEN esc1.puerto is null THEN '' ELSE  esc1.puerto end),' / ', (CASE WHEN esc2.puerto is null THEN '' ELSE  esc2.puerto end) )

                          where e.id =".$data['id'];

                          $this->db->query($consulta);


                      $consulta2=  "UPDATE ".$this->catalogo_importacion." as e  
                       JOIN ".$this->catalogo_pais." as m  ON e.pais=m.pais
                       
                         SET e.id_pais = m.id
                          where e.id =".$data['id'];

                          $this->db->query($consulta2);
                 } else {

                       $consulta=  "UPDATE ".$this->catalogo_exportacion." as e  
                       JOIN ".$this->catalogo_puerto." as m  ON e.id_puerto=m.id
                       JOIN ".$this->catalogo_puerto." as d  ON e.id_destino=d.id

                        LEFT JOIN ".$this->catalogo_puerto." as esc1  ON e.id_puertoescala=esc1.id
                        LEFT JOIN ".$this->catalogo_puerto." as esc2  ON e.id_puertoescala2=esc2.id

                         SET e.pais = m.country,
                              e.puerto = m.puerto,
                              e.pto_destino = d.puerto,
                              e.via= CONCAT( (CASE WHEN esc1.puerto is null THEN '' ELSE  esc1.puerto end),' / ', (CASE WHEN esc2.puerto is null THEN '' ELSE  esc2.puerto end) )

                          where e.id =".$data['id'];

                          $this->db->query($consulta);


                      $consulta2=  "UPDATE ".$this->catalogo_exportacion." as e  
                       JOIN ".$this->catalogo_pais." as m  ON e.pais=m.pais
                       
                         SET e.id_pais = m.id
                          where e.id =".$data['id'];

                          $this->db->query($consulta2);

                  
                 }         


        return TRUE;
      }  else
         return FALSE;
        }   



 
	} 
?>



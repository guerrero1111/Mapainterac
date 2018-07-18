<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

  class modelo extends CI_Model{
    
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
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->catalogo_puerto           = $this->db->dbprefix('catalogo_puerto');
          $this->catalogo_exportacion     = $this->db->dbprefix('catalogo_exportacion');
          $this->catalogo_importacion     = $this->db->dbprefix('catalogo_importacion');



    }

/*
SELECT e.pto_destino,m.city,e.pais,m.province FROM mapa_catalogo_exportacion as e
inner join mapa_catalogo_puerto as m on e.pto_destino=m.city

SELECT e.pto_destino,m.city,e.pais,m.province FROM mapa_catalogo_exportacion as e
inner join mapa_catalogo_puerto as m on e.puerto=m.city

                      title: "La Habana",
                   latitude: 23.1330204,
                  longitude: -82.3830414,
                  color: "#eea638",
                  valor:"ppp",



*/








      public function exportaciones(){
            
            $this->db->select('e.id, e.pais, e.puerto, e.pto_destino, e.tarifa, e.salidas, e.minimo, e.tt, e.via, e.region' );

            $this->db->select('m.city, m.city_ascii, m.lat, m.lng, m.pop, m.country, m.iso2, m.iso3, m.province');

            $this->db->from($this->catalogo_exportacion.' e');
            $this->db->join($this->catalogo_puerto.' m', 'e.pto_destino=m.city');
        
              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    




      public function importaciones_origen(){
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            $this->db->select('e.id, e.puerto title, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province');

            $this->db->from($this->catalogo_importacion.' e');
            $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
            $this->db->group_by('m.id');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){

                  foreach ($result->result() as $row) {
                      $row->svgPath = $icono_posicion;
                    }              



                return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    
      




      public function importaciones_destino(){
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            $this->db->select('e.id, e.pto_destino title, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province');

            $this->db->from($this->catalogo_importacion.' e');
            $this->db->join($this->catalogo_puerto.' m', 'e.id_destino=m.id');
            $this->db->group_by('m.id');

              $result = $this->db->get();
              if ($result->num_rows() > 0){

                  foreach ($result->result() as $row) {
                      $row->svgPath = $icono_posicion;
                    }              



                return json_encode($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    




//////////////////////dependencias////////////////////////////////

         public function pais($data){
            

            $this->db->select('e.id_pais id, e.pais nombre');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->group_by('e.id_pais');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){
               return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }  


         public function origen($data){
       

             $this->db->select('e.id_puerto id, e.puerto nombre');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
             $where = '(
                      (
                        ( e.id_pais = '.$data['id_pais'].' ) 
                      )
            ) ' ; 
            $this->db->where($where); 
            $this->db->group_by('m.id');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){

                return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    


public function destino($data){
            
          
            $this->db->select('e.id_destino id, e.pto_destino nombre');
            

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->join($this->catalogo_puerto.' m', 'e.id_destino=m.id');
             $where = '(
                      (
                        ( e.id_puerto = '.$data['inicio'].' ) 
                      )
            ) ' ; 
            $this->db->where($where); 
            $this->db->group_by('m.id');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){
               
                return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    



 public function origen_pto($data){
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            $this->db->select('e.id_puerto id, e.puerto title, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
             $where = '(
                      (
                           ( e.id_pais = '.$data['id_pais'].' )  and 
                         ( e.id_puerto = '.$data['inicio'].' ) and 
                        ( e.id_destino = '.$data['fin'].' ) 

                      )
            ) ' ; 
            $this->db->where($where); 
            $this->db->group_by('m.id');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){

                  foreach ($result->result() as $row) {
                      $row->svgPath = $icono_posicion;
                    }              



                return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    


public function destino_pto($data){
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            
            $this->db->select('e.id_destino id, e.pto_destino title, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

             $this->db->join($this->catalogo_puerto.' m', 'e.id_destino=m.id');
             $where = '(
                      (
                           ( e.id_pais = '.$data['id_pais'].' )  and 
                         ( e.id_puerto = '.$data['inicio'].' ) and 
                        ( e.id_destino = '.$data['fin'].' ) 

                      )
            ) ' ; 
            $this->db->where($where); 
            $this->db->group_by('m.id');
            

              $result = $this->db->get();
              if ($result->num_rows() > 0){

                  foreach ($result->result() as $row) {
                      $row->svgPath = $icono_posicion;
                    }              



                return ($result->result());
              }
              else 
                return FALSE;
              $login->free_result();
      }    




  } 
?>
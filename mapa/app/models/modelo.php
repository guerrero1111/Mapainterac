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
          $this->catalogo_exportacion     = $this->db->dbprefix('catalogo_exportacion_pana');
          $this->catalogo_importacion     = $this->db->dbprefix('catalogo_importacion_pana');

    }





//////////////////////dependencias////////////////////////////////

         public function pais($data){
            

            $this->db->select('e.id_pais id, e.pais nombre, e.via');

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
       

             $this->db->select('e.id_puerto id, e.puerto nombre, e.tt, e.via');

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
            
          
            $this->db->select('e.id_destino id, e.pto_destino nombre2, e.tt, e.via');

            $this->db->select('CONCAT(e.pto_destino," (",e.via,")") nombre', false);
            

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
            $this->db->group_by('m.id, e.id_puertoescala, e.id_puertoescala2');
            

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

            $this->db->select('e.id_puerto id, e.puerto title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via');

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




 public function origen_intermedio($data){
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            $this->db->select('e.'.$data["c1"].' id, e.'.$data["c2"].' title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

            $this->db->join($this->catalogo_puerto.' m', 'e.'.$data["c1"].'=m.id');
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

            
            $this->db->select('e.id_destino id, e.pto_destino title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via');

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



public function destino_intermedio($data){ 
            

              $icono_posicion = 'M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z';

              
            $this->db->select('"#eea638" as color', false);
            $this->db->select('"ppp" as valor', false);

            
            //$this->db->select('e.id_destino id, e.pto_destino title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province');

            $this->db->select('e.'.$data["c1"].' id, e.'.$data["c2"].' title, e.pais, e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via');

            if  ($data['id_estatus']==1) {
                $this->db->from($this->catalogo_importacion.' e');  
            } else { //caso de 2
                $this->db->from($this->catalogo_exportacion.' e');
            }

             //$this->db->join($this->catalogo_puerto.' m', 'e.id_destino=m.id');
             $this->db->join($this->catalogo_puerto.' m', 'e.'.$data["c1"].'=m.id');
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
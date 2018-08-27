          
  /*
          $this->db->select('e.id, e.id_puerto,  e.tt, m.city,  m.lat latitude, m.lng longitude, m.pop, m.country, m.iso2, m.iso3, m.province,e.via, pto_destino');
          
          $this->db->select('e.id_puerto, e.id, m.puerto title, m.country pais');

          $this->db->select('precio');

          //e.tt, m.city,   m.pop,  m.iso2, m.iso3, m.province,e.via, pto_destino');
          
*/




                                     
                                     
                                      



          
          
          //filtro de busqueda
       
        /*
          $where = '(

                      (
                        ( u.nombre LIKE  "%'.$cadena.'%" ) OR (u.apellidos LIKE  "%'.$cadena.'%") OR (p.perfil LIKE  "%'.$cadena.'%") 
                        OR (  AES_DECRYPT( u.email,"{$this->key_hash}")  LIKE  "%'.$cadena.'%") 
                        
                       )
            )';  


            $where = '(
                      (
                           ( e.id_pais = '.$data['id_pais'].' )  and 
                         ( e.id_puerto = '.$data['inicio'].' ) and 
                        ( e.id_destino = '.$data['fin'].' ) 

                      )
            ) ' ; 

            */ 




                                /*
                                      0=>$row->id,
                                      1=>$row->title,
                                      2=>$row->pais,
                                      3=>$row->tt,
                                      4=>$row->city,
                                      5=>$row->pto_destino,
                                      6=>$row->latitude,
                                      7=>$row->longitude,
                                      8=>$row->pop,
                                      9=>$row->country,
                                      10=>$row->iso2,
                                      11=>$row->iso3,
                                      12=>$row->province,
                                      13=>$row->via,
                                      14=>$data['id_estatus'],
                                      15=>$row->precio,*/



            $this->db->set( 'e.pais', 'm.country' );
            /*
            pais = country
            id_pais = ()
            puerto = m.puerto
            pto_destino = d.puerto
            */

            $this->db->where('id', $data['id'] );

            if  ($data['id_estatus']==1) {
              $this->db->update($this->catalogo_importacion.' as e' );
              $this->db->join($this->catalogo_puerto.' m', 'e.id_puerto=m.id');
              /*
              $this->db->join($this->catalogo_puerto.' d', 'e.id_destino=d.id');

              $this->db->join($this->catalogo_puerto.' esc1', 'e.id_puertoescala=esc1.id','LEFT');
              $this->db->join($this->catalogo_puerto.' esc2', 'e.id_puertoescala2=esc2.id','LEFT');
              */

                
            } else { //caso de 2
                $this->db->update($this->catalogo_exportacion.' as e' );
            }


<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MEliminar extends CI_Model {

    function eliminar($id,$var) {
        if($var=='codigos'){$var = "codigo";}
         if($var=='obras'){$var = "obra";}
          if($var=='colegios'){$var = "colegio";}
        $query = $this->db->query("DELETE FROM $var Where id='$id'");
        return $query;
    }
}

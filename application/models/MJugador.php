<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MJugador extends CI_Model {

    var $table = 'st_jugador';

// GENERADOR DE CONTRASEÑAS AUTOMATICAS DE JUGADOR 
    function generaPass() {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 8;
        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }
    
    //REGISTRO DE NUEVO JUGADOR 
    function registrar_jugador($tipo, $ci, $nombre, $apellido_p, $apellido_m, $fecha, $nacionalidad, $sexo, $sangre, $uploadfile_nombre, $uploadfile_nombre2, $email, $telefono, $celular, $pais, $provincia, $canton, $ciudad, $direccion, $colegio, $panombre, $celularp, $pnombre, $telefonop, $nombreent, $pcelular, $password) {

        $query = $this->db->query("SELECT ci FROM st_jugador WHERE ci = '$ci'");
        if ($query->num_rows() == 0) {

            $query = $this->db->query("INSERT INTO `st_jugador` (`tipo`, `ci`, `nombre`, `apellido`, `sexo`, `nacimiento`, `sangre`, `pais`, `provincia`, `canton`, `ciudad`, `direccion`, `email`, `celular`, `telefono`, `entrenador`, `telefono_entrenador`, `padre`, `telefono_padre`, `madre`, `telefono_madre`, `foto`, `fotocedula`,`password`) VALUES ('$tipo','$ci','$nombre','$apellido_p','$sexo','$fecha','$sangre','$pais','$provincia','$canton','$ciudad','$direccion','$email','$celular','$telefono','$nombreent','$pcelular','$panombre','$celularp','$pnombre','$telefonop','$uploadfile_nombre','$uploadfile_nombre2','$password')");
            if ($query == true) {
                $id = $this->db->insert_id();



                return $id;
            } else {
                return false;
            }
        } else {
            $id = false;

            return $id;
        }



        /* $query = $this->db->query("INSERT INTO estudiante 
          (nombre, apellido_p, apellido_m, dni, sexo, fecha_nacimiento,
          telefono,  grado, docente, correo_d)
          VALUES ( '$nombre', '$apellido_p', '$apellido_m', '$dni', '$sexo', '',
          '$telefono',  '$grado', '$docente', '$correo_d')"); */
    }

   //UBIGEO PERU 
    
    public function canton($id) {
        $query = $this->db->query("SELECT * FROM `st_canton` WHERE id_provincia='$id'");
        return $query->result();
    }
    
        public function provincias() {
        $query = $this->db->query("SELECT * FROM `st_provincias`");
        return $query->result();
    }


    



   
}

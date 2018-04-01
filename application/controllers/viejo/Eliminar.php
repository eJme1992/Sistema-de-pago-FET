<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eliminar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        session_start();
        if (isset($_SESSION['USER']) == TRUE) {
            $this->load->model('MEliminar');
        } else {
            echo "<script>location.href ='" . base_url() . "';</script>";
        }
    }

    
      public function index() {
       //
    }
    

    public function concurso($id, $var) {
        $consultas = $this->MEliminar->eliminar($id, $var);
        echo "<script>location.href ='" . base_url() . "Panel/".$var."';</script>";
    }

    public function colegios($id, $var) {
     $consultas = $this->MEliminar->eliminar($id, $var);
        echo "<script>location.href ='" . base_url() . "Panel/".$var."';</script>";
    }

    public function obras($id, $var) {
     $consultas = $this->MEliminar->eliminar($id, $var);
        echo "<script>location.href ='" . base_url() . "Panel/".$var."';</script>";
    }

    public function codigos($id,$var) {
        $consultas = $this->MEliminar->eliminar($id, $var);
        echo "<script>location.href ='" . base_url() . "Panel/".$var."';</script>";
   }
}

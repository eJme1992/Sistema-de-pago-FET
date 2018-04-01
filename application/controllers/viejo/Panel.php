<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

    public function __construct() {
        parent::__construct();

        session_start();
        if (isset($_SESSION['USER']) == TRUE) {
            $this->load->model('MPanel');
        } else {
            echo "<script>location.href ='" . base_url() . "';</script>";
        }
        
        $curso = $this->MPanel->cursoactivo();
        
       
        if (($curso!=="cerrado") AND ($curso!=="")){
        if ($curso->estado=="creado"){
        if (strtotime($curso->fecha_inicio)<=strtotime(date("Y-m-d"))) {
            
            $this->MPanel->estado($curso->id,'iniciado');
            
        } else {
           //
        }
        }
        
        if ($curso->estado=="iniciado"){
        if (strtotime($curso->fecha_final)<=strtotime(date("Y-m-d"))) {
            
            $this->MPanel->estado($curso->id,'finalizado');
            
        } else {
           //
        }
        }
        
         
        if ($curso->estado=="finalizado"){
        if (strtotime($curso->fecha_premiacion)<=strtotime(date("Y-m-d"))) {
            
            $this->MPanel->estado($curso->id,'cerrado');
            
        } else {
           //
        }
        }
        }
        
    }

    
    public function crear() {
           
        function validar($variable, &$status, &$mensaje)
            {
                if ((isset($_POST["$variable"])) OR (empty($_POST["$variable"]))) {
                    return $_POST[$variable];
                } else {
                    $mensaje = "No ingreso el campo $variable";
                    $status  = 0;
                    return 0;
                }
            }
            $status  = 1;
            $mensaje = "todo correcto";
            
            $año          = validar('año', $status, $mensaje);
            $inicio       = validar('inicio', $status, $mensaje);
            $cierre       = validar('cierre', $status, $mensaje);
            $premiacion   = validar('premiacion', $status, $mensaje);
            
               if ($status !== 0) {
                
               $this->MPanel->registrar_concurso($año, $inicio, $cierre, $premiacion);
                
                
                
                $response['status']      = 'ok';
           echo $response['mensaje']     = "<script>location.href ='" . base_url() . "concurso';</script>";

                
            }
            
            if ($status === 0) {
                    $response['status'] = 0;
             echo   'alert("Hello! I am an alert box!!");'.'location.href ="'.base_url().'concurso";';
            }
          
    }
    
   
     public function editar() {
           
        function validar($variable, &$status, &$mensaje)
            {
                if ((isset($_POST["$variable"])) OR (empty($_POST["$variable"]))) {
                    return $_POST[$variable];
                } else {
                    $mensaje = "No ingreso el campo $variable";
                    $status  = 0;
                    return 0;
                }
            }
            $status  = 1;
            $mensaje = "todo correcto";
            
            $año          = validar('año', $status, $mensaje);
            $inicio       = validar('inicio', $status, $mensaje);
            $cierre       = validar('cierre', $status, $mensaje);
            $premiacion   = validar('premiacion', $status, $mensaje);
            $id           = validar('id', $status, $mensaje);
            
               if ($status !== 0) {
                
               $this->MPanel->editar_concurso($año, $inicio, $cierre, $premiacion,$id);
                
                
                
                $response['status']      = 'ok';
           echo $response['mensaje']     = "<script>location.href ='" . base_url() . "concurso';</script>";

                
            }
            
            if ($status === 0) {
                    $response['status'] = 0;
             echo   'alert("Hello! I am an alert box!!");'.'location.href ="'.base_url().'concurso";';
            }
          
    }
    
    public function index() {
        if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
        } else {
            $cons = $consultas = $this->MPanel->cursoactivo();
            if($cons!=="cerrado") {$curso = $datos['curso'] = $cons->año;}else{$curso = $datos['curso'] = "";}
        }

        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $datos['titulo'] = "inicio";
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        
        
        if($cons!=="cerrado") {
        $datos['tabla'] = $consultas = $this->MPanel->consultarR01a($curso);
        $datos['reto'] = $consultas = $this->MPanel->consultarR01b($curso);
        $datos['sexo'] = $consultas = $this->MPanel->consultarR01c($curso);
        }
        $this->load->view('header', $datos);
        $this->load->view('contenido');
        $this->load->view('footer');
    }

    public function salir() {
        session_destroy();
        echo "<script>location.href ='" . base_url() . "';</script>";
    }

    public function concurso() {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Concurso";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarConcurso($pagina, $total_paginas);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['total_paginas'] = $total_paginas;
        $this->load->view('header', $datos);
        $this->load->view('concurso');
        $this->load->view('footer');
    }

    public function crearconcurso() {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Crear Y Editar concurso";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $this->load->view('header', $datos);
        $this->load->view('concurso_crear');
        $this->load->view('footer');
    }
    
     public function editarconcurso($id) {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Crear Y Editar concurso";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $datos['valores'] = $this->MPanel->concursodetalle($id);
        $this->load->view('header', $datos);
        $this->load->view('concurso_editar');
        $this->load->view('footer');
    }

    public function obras($pagina = 1) {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Obras";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarObra($pagina, $total_paginas);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['total_paginas'] = $total_paginas;
        $this->load->view('header', $datos);
        $this->load->view('obras-literarias');
        $this->load->view('footer');
    }

    public function codigos($pagina = 1) {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Codigos";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarCodigos($pagina, $total_paginas);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['total_paginas'] = $total_paginas;
        $this->load->view('header', $datos);
        $this->load->view('codigos');
        $this->load->view('footer');
    }

    public function colegios($pagina = 1) {
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Colegios";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarColegios($pagina, $total_paginas);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['total_paginas'] = $total_paginas;
        $this->load->view('header', $datos);
        $this->load->view('colegios');
        $this->load->view('footer');
    }

    public function r01($curso = "") {
        if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
        } else {
            $cons = $consultas = $this->MPanel->año();
            if($cons!=="cerrado") {$curso = $datos['curso'] = $cons->año;}else{$curso = $datos['curso'] = "";}
        }
        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Reporte";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $datos['tabla'] = $consultas = $this->MPanel->consultarR01a($curso);
        $datos['reto'] = $consultas = $this->MPanel->consultarR01b($curso);
        $datos['sexo'] = $consultas = $this->MPanel->consultarR01c($curso);
        $datos['curso'] = $curso;
        $this->load->view('header', $datos);
        $this->load->view('r01-resumen-estadistico');
        $this->load->view('footer');
    }

    public function r02($pagina = 1, $curso = "", $tipo = "", $buscar = "") {
       if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
        } else {
            $cons = $consultas = $this->MPanel->año();
            if($cons!=="cerrado") {$curso = $datos['curso'] = $cons->año;}else{$curso = $datos['curso'] = "";}
        }
        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
        } else {
            $tipo = "";
        }
        if (isset($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
        } else {
            $buscar = "";
        }

        $total_paginas = 0;

        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Reporte";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $datos['año'] = $this->MPanel->año();
        $consultas = $this->MPanel->consultarR02($pagina, $total_paginas, $curso, $tipo, $buscar);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['curso'] = $curso;
        $datos['tipo'] = $tipo;
        $datos['buscar'] = $buscar;
        $datos['total_paginas'] = $total_paginas;




        $this->load->view('header', $datos);
        $this->load->view('r02-registros-det-participantes');
        $this->load->view('footer');
    }

    public function r03($pagina = 1, $curso = "", $buscar = "") {

      if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
        } else {
            $cons = $consultas = $this->MPanel->año();
            if($cons!=="cerrado") {$curso = $datos['curso'] = $cons->año;}else{$curso = $datos['curso'] = "";}
        }
        if (isset($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
        } else {
            $buscar = "";
        }

         $total_paginas = 0;

        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Reporte";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarR03($pagina, $total_paginas, $curso, $buscar);
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['curso'] = $curso;
        $datos['buscar'] = $buscar;
        $datos['total_paginas'] = $total_paginas;
        
        $this->load->view('header', $datos);
        $this->load->view('r03-inscritos-por-obra');
        $this->load->view('footer');
    }

    public function r04($pagina = 1, $curso = "", $buscar = "") {

        if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
        } else {
            $cons = $consultas = $this->MPanel->año();
            if($cons!=="cerrado") {$curso = $datos['curso'] = $cons->año;}else{$curso = $datos['curso'] = "";}
        }
        if (isset($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
        } else {
            $buscar = "";
        }

         $total_paginas = 0;

        $consulta = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo'] = "Reporte";
        $datos['estadoc'] = $this->MPanel->cursoactivo();
        $consultas = $this->MPanel->consultarR04($pagina, $total_paginas, $curso, $buscar);
       
        
        $datos['tabla'] = $consultas;
        $datos['pagina'] = $pagina;
        $datos['curso'] = $curso;
        
        $datos['buscar'] = $buscar;
        $datos['total_paginas'] = $total_paginas; 
        
        $this->load->view('header', $datos);
        $this->load->view('r04-participantes-por-colegios');
        $this->load->view('footer');
    }

    public function ingreso() {
        //RC = RECIBIDO
        $RC['user'] = $this->input->post('user');
        $RC['pass'] = $this->input->post('pass');
        $this->load->view('info', $RC);
    }

}

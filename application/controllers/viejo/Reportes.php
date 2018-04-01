<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
      
        session_start();
        if (isset($_SESSION['USER']) == TRUE) {
            $this->load->model('MReportes');
        } else {
            echo "<script>location.href ='http://serviciosdigitalesperu.com/loqueleo/backoffice';</script>";
        }
    }
    
   
    
    
     public function ER04($curso="",$buscar="")
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarR04($curso,$buscar);
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Departamento')
                        ->setCellValue('B1', 'Provincia')
                        ->setCellValue('C1', 'Distrito') 
                        ->setCellValue('D1', 'Colegio')
                        ->setCellValue('E1', 'Cantidad')
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		  
                
                  $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$cel, $row->departamento)
                  ->setCellValue('B'.$cel, $row->provincial)
                  ->setCellValue('C'.$cel, $row->distrito)
                  ->setCellValue('D'.$cel, $row->nombre)                
                  ->setCellValue('E'.$cel, $row->cuantos)
               ;
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('codigos');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Inscritosporcolegio.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }
    
     public function ER03($curso="",$buscar="")
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarR03($curso,$buscar);
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Nombre')
                        ->setCellValue('B1', 'Cantidad')
                    
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		  
                
                  $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$cel, $row->nombre)
                  ->setCellValue('B'.$cel, $row->cuantos)
                 
               ;
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('codigos');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Inscritosporobra.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }
    
        public function ER02($curso="",$tipo="",$buscar="")
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarR02($curso,$tipo,$buscar);
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Codigo')
                        ->setCellValue('B1', 'Tipo de codigo')
                        ->setCellValue('C1', 'Concursante')
                        ->setCellValue('D1', 'Sexo')
                        ->setCellValue('E1', 'Dni Estudiante')
                        ->setCellValue('F1', 'Grado')
                        ->setCellValue('G1', 'Apoderado')
                        ->setCellValue('H1', 'Dni Apoderado')
                        ->setCellValue('I1', 'Telefono Apoderado')
                        ->setCellValue('J1', 'Celular Apoderado')
                        ->setCellValue('K1', 'Departamento')
                        ->setCellValue('L1', 'Provincia')
                        ->setCellValue('M1', 'Distrito')
                        ->setCellValue('N1', 'Colegio')
                        ->setCellValue('O1', 'Docente')
                        ->setCellValue('P1', 'Email Docente')
                        ->setCellValue('Q1', 'Tipo reto')
                        ->setCellValue('R1', 'Forma de entrega')
                    
                        ->setCellValue('S1', 'Nombre de la obra')
                        ->setCellValue('T1', 'Trabajo enlace')
                        ->setCellValue('U1', 'F. Registro')
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		$code=$row->code;
                $nombre=$row->nombre . ' ' . $row->apellido_p . ' ' . $row->apellido_m;
                $sexo=$row->sexo;
                $dni=$row->dni;
                $grado=$row->grado;
                $padre=$row->nombre_p . ' ' . $row->papellido_p . ' ' . $row->papellido_m;
                $pdni=$row->pdni;
                $telefono=$row->telefono;
                $celular=$row->celular;
                
                $depatamento=$row->departamento; 
                $provincia=$row->provincial; 
                $distrito=$row->distrito;
                $tipo=$row->tipo;
                $colegio=$row->colegio;
                $docente=$row->docente;
                $correo=$row->correo_d;
                $forma=$row->forma_entrega;
                $obra=$row->obra;
                $url=$row->documento1;
                $fecha=$row->fecha_registro;
                if ($row->reto==1){$reto="Fisico";} if($row->reto==2){$reto="Digital";} if($row->reto==3){$reto="Video";} 
                if ($row->documento1==="--"){$url=$row->documento1;}else{$url= base_url().$url;} 
                
                
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$cel, $code)
                ->setCellValue('B'.$cel, $tipo)        
                ->setCellValue('C'.$cel, $nombre)
                ->setCellValue('D'.$cel, $sexo)
                ->setCellValue('E'.$cel, $dni)
                ->setCellValue('F'.$cel, $grado)              
                ->setCellValue('G'.$cel, $padre)
                ->setCellValue('H'.$cel, $pdni)
                ->setCellValue('I'.$cel, $telefono)
                ->setCellValue('J'.$cel, $celular)
                ->setCellValue('K'.$cel, $depatamento)
                ->setCellValue('L'.$cel, $provincia)
                ->setCellValue('M'.$cel, $distrito)
                ->setCellValue('N'.$cel, $colegio)
                ->setCellValue('O'.$cel, $docente)
                ->setCellValue('P'.$cel, $correo)
                ->setCellValue('Q'.$cel, $reto)
                ->setCellValue('R'.$cel, $forma)
                ->setCellValue('S'.$cel, $obra)
                ->setCellValue('T'.$cel, $url)
                ->setCellValue('U'.$cel, $fecha);
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Simple');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="reporteDetallado.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }

       public function obra()
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarObra();
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Codigo')
                        ->setCellValue('B1', 'Obra')
                        ->setCellValue('C1', 'Tipo de reto')
                        ->setCellValue('D1', 'Estado')
                        ->setCellValue('E1', 'Fecha de registro')
                       
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		 if ($row->reto==1){$reto="Fisico";} if($row->reto==2){$reto="Digital";} if($row->reto==3){$reto="Video";}

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$cel, $row->id)
                ->setCellValue('B'.$cel, $row->nombre)
                ->setCellValue('C'.$cel, $reto)
                ->setCellValue('D'.$cel, 'Activo')
                ->setCellValue('E'.$cel, $row->fecha_registro);
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Simple');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Obras.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }


    
     public function colegios()
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarColegios();
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Departamento')
                        ->setCellValue('B1', 'Codigo departamento')
                        ->setCellValue('C1', 'Provincia')
                        ->setCellValue('D1', 'Codigo Provinca')
                        ->setCellValue('E1', 'Distrito')
                        ->setCellValue('F1', 'Codigo Distrito')
                        ->setCellValue('G1', 'Colegio Code')
                        ->setCellValue('H1', 'Colegio')
                        ->setCellValue('I1', 'Estado')
                        ->setCellValue('J1', 'Fecha de registro')
                     
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$cel, $row->code_dep)
                ->setCellValue('B'.$cel, $row->departamento)
                ->setCellValue('C'.$cel, $row->code_prov)
                ->setCellValue('D'.$cel, $row->provincial)
                ->setCellValue('E'.$cel, $row->code_dis)              
                ->setCellValue('F'.$cel, $row->distrito)
                ->setCellValue('G'.$cel, $row->id)
                ->setCellValue('H'.$cel, $row->nombre)
                ->setCellValue('I'.$cel, 'Activo')
                ->setCellValue('J'.$cel, $row->fecha_registro)
               ;
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('colegios');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="colegios.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }
    
     public function concurso()
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarConcurso();
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Código')
                        ->setCellValue('B1', 'Año')
                        ->setCellValue('C1', 'Periodo')
                        ->setCellValue('D1', 'Estado')
                        ->setCellValue('E1', 'F. Creado')
                        ->setCellValue('F1', 'F. Inicio')
                        ->setCellValue('G1', 'Acciones')
                                   
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		
                
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$cel, $row->id)
                            ->setCellValue('B'.$cel, $row->año)
                            ->setCellValue('C'.$cel, $row->fecha_inicio.'/'.$row->fecha_premiacion)
                            ->setCellValue('D'.$cel, $row->estado) 
                            ->setCellValue('E'.$cel, $row->fecha_registro) 
                            ->setCellValue('G'.$cel, $row->fecha_inicio)
               ;
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('codigos');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="concursos.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }

  public function codigos()
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $consultas = $this->MReportes->consultarCodigos();
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Codigo')
                        ->setCellValue('B1', 'tipo')
                        ->setCellValue('C1', 'status')                    
                    ;

                $cel=2;//Numero de fila donde empezara a crear  el reporte
                foreach ($consultas as $row) {
		if ($row->status==1){$status="Disponible";} 
                if ($row->status==2){$status="En uso";} 
                
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$cel, $row->code)
                ->setCellValue('B'.$cel, $row->tipo)
                ->setCellValue('C'.$cel, $status)
               ;
     
                $cel+=1;
	}


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('codigos');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="codigos.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }
    
      public function ER01($curso="",$buscar="")
    {
          
        $consulta           = $_SESSION['USER'];
        $datos['user_name'] = $consulta->user_name;
        $datos['titulo']    = "Reporte";
        $tabla = $consultas = $this->MReportes->consultarR01a($curso);
        $reto =  $consultas = $this->MReportes->consultarR01b($curso);
        $sexo =  $consultas = $this->MReportes->consultarR01c($curso);
 
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

         /** Incluye PHPExcel */
         require_once APPPATH."../libreria/PHPExcel.php"; 
         // Create new PHPExcel object
         $objPHPExcel = new PHPExcel();
         // Set document properties
         $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


         // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '#')
                        ->setCellValue('B1', 'MES')
                        ->setCellValue('C1', 'Cantidad')
                    
                    ;
           $i=0;
           $cel=2;//Numero de fila donde empezara a crear  el reporte
                    $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    foreach ($tabla as $row) { $i=$i+1; 
                   
                   $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue('A'.$cel,$i)
                      ->setCellValue('B'.$cel,$mes[$i-1])
                      ->setCellValue('C'.$cel,$row);
                   $cel+=1;
                  } 
            
                  
                  $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A15', 'Fisico')
                        ->setCellValue('B15', 'Digital')
                        ->setCellValue('C15', 'Video')
                        ->setCellValue('A16', $reto['1'])
                        ->setCellValue('B16', $reto['2'])
                        ->setCellValue('C16', $reto['3'])
                    ;
                  $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A18', 'Masculino')
                        ->setCellValue('B18', 'Femenino')
                     
                        ->setCellValue('A19', $sexo['M'])
                        ->setCellValue('B19', $sexo['F'])
                        
                    ;
            
     
                
	


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('codigos');


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="ReporteEstadistico.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

    }



}
    
    
    
    
    
    
    
    
    

               
    


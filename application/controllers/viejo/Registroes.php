 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registroes extends CI_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mregistroes');
    }
    
    public function index()
    {
    }
    
    public function codigo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $code      = $_POST['code'];
            $consultas = $this->Mregistroes->consultar($code);
            $concursos = $this->Mregistroes->concurso();
            $concurso  = end($concursos);
            $consulta  = end($consultas);
            
            //CONDICIONES
            if ($consulta != false) {
            if ($consulta != false) {
                if ($consulta->id_concurso == $concurso->id) {
                    if ($consulta->status == "1") {
                        
                        $response['status'] = 'ok';
                        $response['code']   = $code;
                    } else {
                        $response['status'] = 0;
                        $response['error']  = '<div class="center-block alert alert-danger"><strong>¡ERROR! </strong> El código ya fue utilizado por otra persona.</div>';
                    }
                } else {
                    $response['status'] = 0;
                    $response['error']  = '<div class="center-block alert alert-danger"><strong>¡ERROR! </strong> El código no pertenece a este concurso.</div>';
                }
            } else {
                $response['status'] = 0;
                $response['error']  = '<div class="center-block alert alert-danger"><strong>¡ERROR! </strong> El código es incorrecto.</div>';
            } 
            }else {
                $response['status'] = 0;
                $response['error']  = '<div class="center-block alert alert-danger"><strong>¡ERROR! </strong> El concurso no esta iniciado.</div>';
            } 
            
            
            echo json_encode($response);
        } else {
            echo "Debe entrar a través del formulario";
        }
    }
    
    public function reimprimir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $dni       = $_POST['dni'];
            $code      = $_POST['code'];
            $consultas = $this->Mregistroes->reimprimir($code, $dni);
            $consulta  = end($consultas);
            
            //CONDICIONES
            if ($consulta != false) {
                
                $id_registro             = $consulta->id;
                $token                   = $consulta->token;
                $response['status']      = 'ok';
                $response['id_registro'] = $id_registro;
                $response['token']       = $token;
                $response['tipo']        = 2;
                
            } else {
                $response['status'] = 0;
                $response['error']  = '<div class="center-block alert alert-danger"><strong>¡ERROR! </strong> El código o DNI es incorrecto.</div>';
                
            }
            echo json_encode($response);
        } else {
            echo "Debe entrar a través del formulario";
        }
    }
    
    public function colegio($buscar)
    {
        
        function cvf_convert_object_to_array($data)
        {
            
            if (is_object($data)) {
                $data = get_object_vars($data);
            }
            
            if (is_array($data)) {
                return array_map(__FUNCTION__, $data);
            } else {
                return $data;
            }
        }
        
        $colegios = $this->Mregistroes->colegio($buscar);
        $colegio  = end($colegios);
        
        if ($colegio != false) {
            $colegio = cvf_convert_object_to_array($colegio);
            
            $response['status']  = 'ok';
            $response['docente'] = $colegio['docente'];
            $response['correo']  = $colegio['email'];
        } else {
            $response['status'] = 'err';
            $response['result'] = '';
            
        }
        
        //returns data as JSON format
        echo json_encode($response);
   
    }
        
    public function dni()
    {
        
        $buscar = "20499564";
        
        $dnis = $this->Mregistroes->buscardni($buscar);
        $dni  = end($dnis);
        
        if ($dni != false) {
            $data['status']  = 'ok';
            $data['message'] = $dni;
        } else {
            $data['status'] = 'err';
            $data['result'] = '';
            
        }
        
        //returns data as JSON format
        echo json_encode($data);
        
    }
    
    public function registrar()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            function archivo($documento, &$status, &$mensaje)
            {
                $ruta                = "Estudiantes/"; //ruta carpeta donde queremos copiar las imágenes 
                $uploadfile_temporal = $_FILES["$documento"]['tmp_name'];
                $size                = $_FILES["$documento"]['size'];
                $uploadfile_nombre   = $ruta . "D1DNI" . $_POST['dni'] . $_FILES["$documento"]['name'];
                if ($size < 20000000) {
                    if (is_uploaded_file($uploadfile_temporal)) {
                        move_uploaded_file($uploadfile_temporal, $uploadfile_nombre);
                        return $uploadfile_nombre;
                    } else {
                        $status  = 0;
                        $mensaje = "error";
                        return 0;
                        
                    }
                } else {
                    $status  = 0;
                    $mensaje = "El archivo pesa mucho";
                    return 0;
                    
                    
                }
            }
            
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
            $token   = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789" . uniqid());
            
            //DATOS DEL ESTUDIANTE
            $nombre      = validar('nombre', $status, $mensaje);
            $apellido_p  = validar('apellido_p', $status, $mensaje);
            $apellido_m  = validar('apellido_m', $status, $mensaje);
            $dni         = validar('dni', $status, $mensaje);
            $telefono    = validar('telefono', $status, $mensaje);
            $sexo        = validar('sexo', $status, $mensaje);
            $grado       = validar('grado', $status, $mensaje);
            $docente     = validar('docente', $status, $mensaje);
            //$correo_d    = validar('correo_d', $status, $mensaje);
            $correo_d = "";
            $correo_d = $_POST['correo_d'];
            //DATOS DE APODERADO
            $pdni        = validar('pdni', $status, $mensaje);
            $pnombre     = validar('pnombre', $status, $mensaje);
            $papellido_p = validar('papellido_p', $status, $mensaje);
            $papellido_m = validar('papellido_m', $status, $mensaje);
            $ptelefono   = validar('ptelefono', $status, $mensaje);
            $pcelular    = validar('pcelular', $status, $mensaje);
            //DATOS DEL COLEGIO
            $colegio     = validar('colegio', $status, $mensaje);
            //CODIGO
            $code        = validar('code', $status, $mensaje);
            // DATOS DE LA TABLA REGISTROS
            $forma       = validar('forma', $status, $mensaje);
            $obra        = validar('obra', $status, $mensaje);
            $video       = validar('video', $status, $mensaje);
            
            
            if ($obra === "Seleccionar") {
                $status  = 0;
                $mensaje = "Debe seleccionar el campo 'obra'";
            }
            if (($colegio === "Seleccionar") or ($colegio === "")) {
                $status  = 0;
                $mensaje = "Debe seleccionar el campo 'colegio'";
            }

            $nombre      = strtoupper($nombre);
            $apellido_p  = strtoupper($apellido_p);
            $apellido_m  = strtoupper($apellido_m);
            $dni         = strtoupper($dni);
            $telefono    = strtoupper($telefono);
            $sexo        = strtoupper($sexo);
            $grado       = strtoupper($grado);
            $docente     = strtoupper($docente);
            $correo_d    = strtoupper($correo_d);
            //DATOS DE APODERADO
            $pdni        = strtoupper($pdni);
            $pnombre     = strtoupper($pnombre);
            $papellido_p = strtoupper($papellido_p);
            $papellido_m = strtoupper($papellido_m);
            //$ptelefono   = strtoupper($ptelefono);
            $pcelular    = strtoupper($pcelular);
            //DATOS DEL COLEGIO
            $colegio     = strtoupper($colegio);
            //CODIGO
            $code        = strtoupper($code);
            // DATOS DE LA TABLA REGISTROS
            $forma       = strtoupper($forma);
            $obra        = strtoupper($obra);
            $video       = strtoupper($video);
            
            
            
            if ($forma === "DIGITAL") {
                if (isset($_FILES['documento1'])) {
                    $documento1 = archivo('documento1', $status, $mensaje);
                } else {
                    $status     = 0;
                    $mensaje    = "Falta agregar el documento 1";
                    $documento1 = "--";
                }
                
                if (isset($_FILES['documento2'])) {
                    $documento2 = archivo('documento2', $status, $mensaje);
                } else {
                    $documento2 = "--";
                }
            } else {
                $documento1 = "--";
                $documento2 = "--";
            }

            //REGISTROS EN BASE DE DATOS SI NO HAY ERRORES AL SUBIR ARCHIVOS
            if ($status !== 0) {
                
                $id_estudiante = $this->Mregistroes->registrar_estudiant($nombre, $apellido_p, $apellido_m, $dni, $sexo, $telefono, $grado, $docente, $correo_d);
                
                $id_apoderado = $this->Mregistroes->registrar_apoderado($pdni, $pnombre, $papellido_p, $papellido_m, $ptelefono, $pcelular);
                
                $id_registro = $this->Mregistroes->registrar_registro($code, $obra, $id_estudiante, $colegio, $id_apoderado, $video, "$documento1", "$documento2", $forma, $token);
                
                $ok = $this->Mregistroes->registrocode($code);
                
                $response['status']      = 'ok';
                $response['mensaje']     = "¡Se ha registrado su código con Éxito!";
                $response['id_registro'] = $id_registro;
                $response['token']       = $token;
                $response['tipo']        = 1;
                
            }
            
            if ($status === 0) {
                $response['status'] = 0;
                $response['error']  = $mensaje;
            }
            
            echo json_encode($response);
        } else {
            echo "Debe ingresas por el formulario";
        }
        
    }
    
}
   
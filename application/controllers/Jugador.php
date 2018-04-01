<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jugador extends CI_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MJugador');
    }
    
    public function index()
    {
    }

   

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            
         $tipo =  $this->input->post('tipo');
         $ci =  $this->input->post('ci');
         $nombre =  $this->input->post('nombre');
         $apellido_p =  $this->input->post('apellido_p');
         $apellido_m = $this->input->post('apellido_m');
         $fecha = $this->input->post('fecha');
         $nacionalidad = $this->input->post('nacionalidad');
         $sexo = $this->input->post('sexo');
         $sangre = $this->input->post('sangre');
         $foto = $_FILES['foto'];
         $fotoc = $_FILES['fotoc'];
         $email = $this->input->post('email');
         $telefono = $this->input->post('telefono');
         $celular = $this->input->post('celular');
         $pais = $this->input->post('pais');
         $provincia = $this->input->post('provincia');
         $canton = $this->input->post('canton');
         $ciudad = $this->input->post('ciudad');
         $direccion = $this->input->post('direccion');
         $colegio = $this->input->post('colegio');
         $panombre = $this->input->post('panombre');
         $celularp = $this->input->post('celularp');
         $pnombre = $this->input->post('pnombre');
         $telefonop = $this->input->post('telefonop');
         $nombreent = $this->input->post('nombreent');
         $pcelular = $this->input->post('pcelular');
         $password = $this->MJugador->generaPass();


         //guardar fotos
        $config['upload_path']          = './fotos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 8000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['encrypt_name']         =TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto');
        $data = $this->upload->data();
       
        //echo json_encode($data);
        //die();
         $uploadfile_nombre=$data['file_name'];
         //$foto2 = $data2['file_name'];
        if (empty($uploadfile_nombre)) {
            $uploadfile_nombre="default.jpg";
        }

         $config['upload_path']          = './fotos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 8000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['encrypt_name']         =TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('fotoc');
        $data2 = $this->upload->data();
       
        //echo json_encode($data);
        //die();
         $uploadfile_nombre2=$data2['file_name'];
         //$foto2 = $data2['file_name'];
        if (empty($uploadfile_nombre2)) {
            $uploadfile_nombre2="default.jpg";
        }


                    $id = $this->MJugador->registrar_jugador($tipo ,$ci,$nombre,$apellido_p,$apellido_m,$fecha,$nacionalidad ,$sexo,$sangre,$uploadfile_nombre,$uploadfile_nombre2,$email,$telefono,$celular,$pais,$provincia,$canton,$ciudad,$direccion,$colegio,$panombre,$celularp,$pnombre,$telefonop,$nombreent,$pcelular,$password);
                    if ($id) {
                        $config = Array(
                              'protocol' => 'smtp',
                              'smtp_host' => 'ssl://mail.fet.org.ec',
                              'smtp_port' => 465,
                              'smtp_user' => 'soporte@fet.org.ec',
                              'smtp_pass' => 'Fet2018$',
                              'crlf' => "\r\n",
                              'newline' => "\r\n"
                            );

                             /*$config = array(
                                 'protocol' => 'smtp',
                                 'smtp_host' => 'smtp.googlemail.com',
                                 'smtp_user' => 'francisco20990@gmail.com', //Su Correo de Gmail Aqui
                                 'smtp_pass' => 'frank2431', // Su Password de Gmail aqui
                                 'smtp_port' => '465',
                                 'smtp_crypto' => 'ssl',
                                 'mailtype' => 'html',
                                 'wordwrap' => TRUE,
                                 'charset' => 'utf-8'
                                 );*/
                             
                     $this->load->library('email', $config);
                     $this->email->from('soporte@fet.org.ec', 'fet.com.ec');
                     $this->email->to($email);
                     //super importante, para poder envíar html en nuestros correos debemos ir a la carpeta 
                     //system/libraries/Email.php y en la línea 42 modificar el valor, en vez de text debemos poner html
                     $this->email->subject('Bienvenido/a a FET');
                     $this->email->message('<h2>'.$nombre.' '.$apellido_p.' gracias por registrarte</h2><hr><br><br>
                     Tu nombre de usuario es: ' . $email . '.<br>Tu password es: '.$password);
                         if($this->email->send(FALSE)){
                             //echo "enviado<br/>";
                            $response['status']      = 'ok';
                            $response['mensaje']     = "¡Se ha registrado su código con Éxito!";
                            $response['id_registro'] = $id;
                            $response['tipo']        = 1;
                         }else {
                            $response['status']      = 'ok';
                            $response['mensaje']     = "¡Ha ocurrido un error!";
                            $response['id_registro'] = $id;
                            $response['tipo']        = 1;
                             //echo "error: ".$this->email->print_debugger(array('headers'));
                         }
                            //var_dump($this->email->print_debugger());*/

                    }else{
                        
                      $response['status']      = 'ok';
                      $response['mensaje']     = "Ha ocurrido un error";
                      $response['id_registro'] = false;
                      $response['tipo']        = 1;

                    echo json_encode($response);
                    }

                  


        }//fin post
    }

    public function provincias()
    {

       
            foreach ($this->MJugador->provincias() as $row) {
               
               $array[] = $row;
            }

            echo json_encode($array);
    }

    public function canton($id)
    {
        foreach ($this->MJugador->canton($id) as $row) {
               
               $array[] = $row;
            }

            echo json_encode($array);
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
   
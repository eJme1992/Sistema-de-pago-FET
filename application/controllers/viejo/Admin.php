<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


   public function __construct()
        {
                parent::__construct();
				$this->load->model('MAdmin');
        }

	public function index()
	{    
		$datos['titulo'] = "Administrador Loqueleo";
		$this->load->view('admin',$datos);
	}
	
	public function ingreso()
	{    

	  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		
		
		$consultas = $this->MAdmin->consultar($user,$pass);
		$consulta =  end($consultas);





		if ($consulta!=false) {
	     
	      if($consulta->pass==$pass){
		  	session_start();
		  	$_SESSION['USER']=$consulta;
                echo "<script>location.href ='panel';</script>";
			} else { echo  '<div class="alert alert-danger"><strong>ERROR!</strong> La contraseña es incorrecta</div>'; }
		    } else { echo '<div class="alert alert-danger"><strong>ERROR!</strong> El Usuario es incorrecto</div>'; }

	}else{ echo "Debe entrar atravez del formul" ;}
	
	
}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAdmin extends CI_Model {


	 function consultar($user_name,$pass)
	{    
		$query = $this->db->query("SELECT * FROM `usuarios` WHERE user_name='$user_name'");
		return $query->result();
	}
	
}

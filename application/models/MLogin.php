<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLogin extends CI_Model {


	 function consultar($email)
	{    
		$query = $this->db->query("SELECT *  FROM `st_jugador` WHERE email='$email' ");
		return $query->result();
	}
	
}

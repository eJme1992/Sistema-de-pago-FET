<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MLogin');
    }

    public function ingreso() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $this->input->post('email');
            $password = $this->input->post('password');


            $consultas = $this->MLogin->consultar($email);
            $consulta = end($consultas);

            if ($consulta != false) {

                if ($consulta->password == $password) {
                    session_start();
                    $_SESSION['USER'] = $consulta;
                    $response['status'] = 'ok';
                    $response['code'] = "PANEL EN COSTRUCCION";
                } else {
                    $response['status'] = 0;
                    $response['error'] = ' La contraseña es incorrecta';
                }
            } else {
                $response['status'] = 0;
                $response['error'] = ' El Usuario es incorrecto';
            }
        } else {
            $response['status'] = 0;
            $response['error'] = 'El Usuario es incorrecto';
        }

        echo json_encode($response);
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Importar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        session_start();
        if (isset($_SESSION['USER']) == TRUE) {
            $this->load->model('Mimportar');
        } else {
            echo "<script>location.href ='http://serviciosdigitalesperu.com/loqueleo/backoffice';</script>";
        }
    }

    public function colegios() {

        $ruta = 'Importar/';

        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $explo = explode(".", $nombre);


            if ($explo[1] != "csv") {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->colegios($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

    public function obra() {

        $ruta = 'Importar/';

        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $explo = explode(".", $nombre);


            if ($explo[1] != "csv") {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->obra($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

    public function codigo() {

        $ruta = 'Importar/';

        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $explo = explode(".", $nombre);


            if ($explo[1] != "csv") {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->codigo($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

}

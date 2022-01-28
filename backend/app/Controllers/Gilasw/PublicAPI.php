<?php

namespace App\Controllers\Gilasw;

use CodeIgniter\Controller;

class PublicAPI extends Controller{

    public function __construct(){
        $this->bi = new \App\Libraries\Gilasw\VehiculoBI();
    }

    private function validateCredentials(){
        if( !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ){
            return false;
        }
        if( $_SERVER['PHP_AUTH_USER'] !== 'administrador' && $_SERVER['PHP_AUTH_PW'] !== 'gilasw'){
            return false;
        }
        return true;
    }

    public function listarvehiculos(){

        if( $this->validateCredentials() === false ){
            header('WWW-Authenticate: Basic realm="Public API"');
            header('HTTP/1.0 401 Unauthorized');
            die('Credenciales incorrectas');
            exit;
        }

        $responseObject = $this->bi->listar();

        echo json_encode( $responseObject );
        exit;

    }

    public function sanitizeInt( $value = null ){
        $new_value = filter_var( $value, FILTER_SANITIZE_NUMBER_INT );
        return $new_value;
    }

    public function agregarvehiculo(){

        if( $this->validateCredentials() === false ){
            header('WWW-Authenticate: Basic realm="Public API"');
            header('HTTP/1.0 401 Unauthorized');
            die('Credenciales incorrectas');
            exit;
        }

        $tipo_vehiculo = $this->request->getPost('tipo_vehiculo');
        $potencia_motor= $this->sanitizeInt( $this->request->getPost('potencia_motor') );
        $numero_llantas= 0;

        /* Validaciones en backend */
        if( $tipo_vehiculo !== 'SEDAN'  && $tipo_vehiculo !== 'MOTOCICLETA' ){
            die('Información invalida - tipo vehiculo');
            exit;
        }

        if( $tipo_vehiculo == 'SEDAN' ){
            $numero_llantas = 4;
        }

        if( $tipo_vehiculo == 'MOTOCICLETA' ){
            $numero_llantas = 2;
        }

        if( $potencia_motor <= 0 ){
            die('Información invalida - potencia');
            exit;
        }

        /* Construcción de objeto y registro de registro a travez de archivo de BI (Bussisness) */

        $vehiculoObject = (object)  array(
            'tipo_vehiculo'     => $tipo_vehiculo,
            'numero_llantas'    => $numero_llantas,
            'potencia_motor'    => $potencia_motor
        );

        $responseObject = $this->bi->insertRecordIntoTableVehiculoes( $vehiculoObject );

        /* Devolvemos respuesta en formato JSON */

        echo json_encode( $responseObject );
        exit;

    }



}
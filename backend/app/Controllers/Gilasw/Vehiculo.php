<?php

namespace App\Controllers\Gilasw;


use App\Controllers\MC_Controller;

class Vehiculo extends MC_Controller{

    public function __construct(){

        parent::__construct();

        $this->bi = new \App\Libraries\Gilasw\VehiculoBI();

    }

    public function agregar(){

        $tipo_vehiculo = $this->request->getPost('tipo_vehiculo');
        $potencia_motor= $this->sanitizeInt( $this->request->getPost('potencia_motor') );
        $numero_llantas= 0;

        /* Validaciones en backend */
        if( $potencia_motor <= 0 ){
            echo $this->getSuccess( (object) array( 'error' => 'Valores invalidos' ), false );
            exit;
        }

        if( $tipo_vehiculo !== 'SEDAN'  && $tipo_vehiculo !== 'MOTOCICLETA' ){
            echo $this->getSuccess( (object) array( 'error' => 'Valores invalidos' ), false );
            exit;
        }

        if( $tipo_vehiculo == 'SEDAN' ){
            $numero_llantas = 4;
        }

        if( $tipo_vehiculo == 'MOTOCICLETA' ){
            $numero_llantas = 2;
        }

        /* Construcción de objeto y registro de registro a travez de archivo de BI (Bussisness) */

        $vehiculoObject = (object)  array(
            'tipo_vehiculo'     => $tipo_vehiculo,
            'numero_llantas'    => $numero_llantas,
            'potencia_motor'    => $potencia_motor
        );

        $responseObject = $this->bi->insertRecordIntoTableVehiculoes( $vehiculoObject );

        /* Devolvemos respuesta en formato JSON */

        echo $this->getSuccess( $responseObject );
        exit;

    }

    public function listar(){
        $responseObject = $this->bi->listar();
        echo $this->getSuccess( $responseObject );
        exit;
    }

}
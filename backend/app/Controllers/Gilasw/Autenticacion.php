<?php

namespace App\Controllers\Gilasw;

use CodeIgniter\Controller;

class Autenticacion extends Controller{

    protected $session;

    public function  __construct(){

        $this->session = session();
       
    }

    public function issessionactive(){

       if( !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] === false ){
            echo json_encode( (object) array( 'success' => false ) );
            return;
        }

        echo json_encode( (object) array( 'success' => true ) );
        
    }

    public function login(){
        
        $username       = $this->request->getPost('username');
        $password       = $this->request->getPost('password');

        if( $username !== 'administrador' || $password !== 'gilasw' ){
            echo json_encode( (object) array( 'success' => false, 'error' => 'Credenciales invalidas' ) );
            return;
        }

        $newdata = [
            'username'  => $username,
            'isLoggedIn' => TRUE,
        ];
        
        $this->session->set($newdata);

        echo json_encode( (object) array(
            'success'   =>  true, 
            'redirect'  =>  'http://localhost:4200/vehiculos'
        ));

    }

    public function logout(){

        $this->session->destroy();
        
        header('Location: http://localhost:4200/login');

    }

}
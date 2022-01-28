<?PHP

namespace App\Controllers;

use CodeIgniter\Controller;

class MC_Controller extends Controller{

    protected $session;

    public function __construct(){

        return;

        $this->session = session();
    
        if( !isset($_SESSION['isLoggedIn']) ){
            echo $this->getSuccess( (object) array( 'fatal' => 'session no iniciada' ), false );
            exit;
        }

        if( $_SESSION['isLoggedIn'] == false ){
            echo $this->getSuccess( (object) array( 'fatal' => 'session no iniciada' ), false );
            exit;
        }

    }

     public function getSuccess( $responseObject = array(), $success = true ){

        if(!is_object($responseObject ) ){
            $responseObject = (object) $responseObject;
        }

        if( !property_exists( $responseObject, 'success' ) ){
            $responseObject->success = $success;
        }

        return json_encode( $responseObject );
        exit;

     }
    

    /*
     *
     */

    public function sanitizeInt( $value = null ){
        $new_value = filter_var( $value, FILTER_SANITIZE_NUMBER_INT );
        return $new_value;
    }

}
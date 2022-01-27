<?PHP

namespace App\Libraries\Gilasw;

class VehiculoBi{

    public function __construct(){

        $this->dao = new \App\Models\Gilasw\VehiculoDAO();

    }

    public function listar(){

        $responseObject = $this->dao->listarVehiculoes();

        return $responseObject;

    }

    public function insertRecordIntoTableVehiculoes( $insertRecord ){

        $vehiculo_k =  $this->dao->insertRecordIntoTableVehiculoes( $insertRecord );

        $responseObject = (object) array(
            'success'   => true,
            'data'      => (object) array( 'vehiculo_k' => $vehiculo_k )
        );

        return $responseObject;

    }
   

}
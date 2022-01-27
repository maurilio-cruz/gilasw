<?PHP

namespace App\Models\Gilasw;

use App\Models\MC_Model;

class VehiculoDAO extends MC_Model{

    function listarVehiculoes(){

        $db      = \Config\Database::connect();
        $builder = $db->table( 'gilasw_vehiculos' );
        $query   = $builder->get();

        $recordObject = (object) array(
            'numFilas'  => $builder->countAll(),
            'data'      => $query->getResult()
        );

        return $recordObject;
        
    }

    public function insertRecordIntoTableVehiculoes( $recordObject ){

        $vehiculo_k = $this->insertRecordIntoTable( $recordObject, 'gilasw_vehiculos' );

        return $vehiculo_k;

    }



}
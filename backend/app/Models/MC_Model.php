<?PHP

namespace App\Models;

use CodeIgniter\Model;

class MC_Model extends Model{

    protected $error_message_not_valid_input = 'Input no válido.';

    /*
     *
     */

     function insertRecordIntoTable( $recordObject = array(), $table = '' ){

        if( !is_array($recordObject) ){

            if( !is_object($recordObject) ){

                return (object) array( 
                    'success'   => false, 
                    'error'     => $this->error_message_not_valid_input,
                );

            }

            $recordObject = (array) $recordObject;

        }

        /* @todo Agregar validaciones de campos requeridos (usuario_creacion_k, fecha_hora_creacion_k, etc) */

        $db      = \Config\Database::connect();
        $builder = $db->table( $table );
        $builder->insert( $recordObject );

        return $db->insertID();

    }

}
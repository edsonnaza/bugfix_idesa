<?php 
//extension_loaded('mysqli') || dl('mysqli.so');

require_once 'Database.php';

class DesafioUno {


    public static function getClientDebt(int $clientID)
    {
        Database::setDB();
    
        $lotes = self::getLotes();
    
        $response = [
            "status" => false,
            "message" => "No hay Lotes para cobrar",
            "data" => [
                "total" => 0,
                "detail" => []
            ]
        ];
    
        foreach ($lotes as $lote) {
            if ($lote->vencimiento < date('Y-m-d')) {
                if ($lote->clientID == $clientID) {
                    $response['status'] = true;
                    $response['message'] = 'Tienes Lotes para cobrar';
                    $response['data']['total'] += $lote->precio;
                    $response['data']['detail'][] = [
                        "id" => $lote->id,
                        "lote" => $lote->lote,
                        "precio" => $lote->precio,
                        "clientID" => $lote->clientID,
                        "vencimiento" => $lote->vencimiento
                    ];
                }
            }
        }
    
        echo json_encode($response);
    }
    

    
    private static function getLotes() : array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts");
        
        // Verificar si la consulta se ejecutó correctamente
        if ($stmt !== false) {
            while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
                $rows['clientID'] = (string) $rows['clientID'];
                $lotes[] = (object) $rows;
            }
        } else {
            // Imprimir el mensaje de error de SQLite3
            echo $cnx->lastErrorMsg();
        }
        
        return $lotes;
    }
    



}

//DesafioUno::getClientDebt(123456);

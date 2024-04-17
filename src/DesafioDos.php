
<?php 
 

require_once 'Database.php';

class DesafioDos {

    public static function retriveLotes(string $loteID): array {
        Database::setDB(); 
    
        $lotes = self::getLotes($loteID);
    
        if (empty($lotes)) {
            return ["status" => false, "message" => "No se encontraron lotes para el ID proporcionado"];
        } else {
            $formattedLotes = [];
            foreach ($lotes as $lote) {
                $formattedLotes[] = [
                    "id" => $lote->id,
                    "lote" => $lote->lote,
                    "precio" => $lote->precio,
                    "clientID" => $lote->clientID,
                    "vencimiento" => $lote->vencimiento
                ];
            }
            return $formattedLotes;
        }
    }

    private static function getLotes(string $loteID) {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts WHERE lote = '$loteID' LIMIT 5");
        if ($stmt === false) {
            echo $cnx->lastErrorMsg();
        } else {
            while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
                $lotes[] = (object) $rows;
            }
        }
        return $lotes;
    }
}


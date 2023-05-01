<?php
require_once(__DIR__ .  "/../Database.php");
class commande extends Modele {
    
    public function getOrdersCount(){
        $sql = "SELECT COUNT(*) FROM commande";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

} 
?>
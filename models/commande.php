<?php
require_once(__DIR__ .  "/../Database.php");
class commande extends Modele {

    // todo: ajouter les attributs de la commande
    public ?int $id;
    public ?int $id_client;
    public  $date;

    public function __construct($id = null, $id_client = null, $date = null){
        parent::__construct();
        $this->id = $id;
        $this->id_client = $id_client;
        $this->date = $date;

    }

    public function getAll(){
        $sql = "SELECT * FROM commande";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $commandes;
    }   

    public function save(){
        $sql = "INSERT INTO commande (id_client, date) VALUES (:id_client, :date)";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":id_client" => $this->id_client,
            ":date" => $this->date
        ]);
        return $rowsAffected == 1;
    }

    public function delete(){
        $sql = "DELETE FROM commande WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([":id" => $this->id]);
        return $rowsAffected == 1;
    }

    public function update(){
        $sql = "UPDATE commande SET id_client = :id_client, date = :date WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":id_client" => $this->id_client,
            ":date" => $this->date,
            ":id" => $this->id
        ]);
        return $rowsAffected == 1;
    }

    public function getCommande($id){
        $sql = "SELECT * FROM commande WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "commande");
        $commande = $stmt->fetch(PDO::FETCH_CLASS);
        return $commande;
    }

    public function getCommandeByClient($id_client){
        $sql = "SELECT * FROM commande WHERE id_client = :id_client";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_client" => $id_client]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "commande");
        $commande = $stmt->fetch(PDO::FETCH_CLASS);
        return $commande;
        }

    public function getCommandeByDate($date){
        $sql = "SELECT * FROM commande WHERE date = :date";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":date" => $date]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "commande");
        $commande = $stmt->fetch(PDO::FETCH_CLASS);
        return $commande;
        }
    
    public function getOrdersCount(){
        $sql = "SELECT COUNT(*) FROM commande";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $ordersCount = $stmt->fetchColumn();
        return $ordersCount;
    }


}   
?>
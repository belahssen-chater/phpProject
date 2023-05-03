<?php
require_once(__DIR__ .  "/../Database.php");
class facture  extends Modele{
    public ?int $id;
    public ?int $id_commande;
    public  $date;
    public ?int $montant;

    public function __construct($id = null, $id_commande = null, $date = null, $montant = null){
        parent::__construct();
        $this->id = $id;
        $this->id_commande = $id_commande;
        $this->date = $date;
        $this->montant = $montant;
    }

    public function getAll(){
        $sql = "SELECT * FROM facture";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $factures = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $factures;
    }

    public function save(){
        $sql = "INSERT INTO facture (id_commande, date, montant) VALUES (:id_commande, :date, :montant)";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":id_commande" => $this->id_commande,
            ":date" => $this->date,
            ":montant" => $this->montant
        ]);
        return $rowsAffected == 1;
    }

    public function delete(){
        $sql = "DELETE FROM facture WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([":id" => $this->id]);
        return $rowsAffected == 1;
    }

    public function update(){
        $sql = "UPDATE facture SET id_commande = :id_commande, date = :date, montant = :montant WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $rowsAffected = $stmt->execute([
            ":id_commande" => $this->id_commande,
            ":date" => $this->date,
            ":montant" => $this->montant,
            ":id" => $this->id
        ]);
        return $rowsAffected == 1;
    }

    public function getFacture($id){
        $sql = "SELECT * FROM facture WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "facture");
        $facture = $stmt->fetch(PDO::FETCH_CLASS);
        return $facture;
    }

}

?>
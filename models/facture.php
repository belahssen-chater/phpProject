<?php
require_once("../Database.php");
class facture   {
    private $id;
    private $date;
    private $id_client;
    private $id_produit;
    private $quantite;
    private $prix;
    private $total;
    private $etat;
    private $id_commande;
    public function __construct($id = null, $date = null, $id_client = null, $id_produit = null, $quantite = null, $prix = null, $total = null, $etat = null, $id_commande = null) {
        $this->id = $id;
        $this->date = $date;
        $this->id_client = $id_client;
        $this->id_produit = $id_produit;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->total = $total;
        $this->etat = $etat;
        $this->id_commande = $id_commande;
    }
    public function create($data) {
        $db = new Database();
        $db->query("INSERT INTO facture (date, id_client, id_produit, quantite, prix, total, etat, id_commande) VALUES (:date, :id_client, :id_produit, :quantite, :prix, :total, :etat, :id_commande)");
        $db->bind(':date', $data['date']);
        $db->bind(':id_client', $data['id_client']);
        $db->bind(':id_produit', $data['id_produit']);
        $db->bind(':quantite', $data['quantite']);
        $db->bind(':prix', $data['prix']);
        $db->bind(':total', $data['total']);
        $db->bind(':etat', $data['etat']);
        $db->bind(':id_commande', $data['id_commande']);
        $db->execute();
    }
    public function read() {
        $db = new Database();
        $db->query("SELECT * FROM facture");
        $result = $db->resultSet();
        return $result;
    }
    public function readById($id) {
        $db = new Database();
        $db->query("SELECT * FROM facture WHERE id = :id");
        $db->bind(':id', $id);
        $result = $db->single();    
        return $result;

    }
    public function update($data) {
        $db = new Database();
        $db->query("UPDATE facture SET date = :date, id_client = :id_client, id_produit = :id_produit, quantite = :quantite, prix = :prix, total = :total, etat = :etat, id_commande = :id_commande WHERE id = :id");
        $db->bind(':id', $data['id']);
        $db->bind(':date', $data['date']);
        $db->bind(':id_client', $data['id_client']);
        $db->bind(':id_produit', $data['id_produit']);
        $db->bind(':quantite', $data['quantite']);
        $db->bind(':prix', $data['prix']);
        $db->bind(':total', $data['total']);
        $db->bind(':etat', $data['etat']);
        $db->bind(':id_commande', $data['id_commande']);
        $db->execute();
    }
?>
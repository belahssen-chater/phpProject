<?php
require_once(__DIR__ .  "/../Database.php");

    class Produit extends Modele{ 
            
            private $id;
            private $nom;
            private $description;
            private $prix;
    
            public function __construct($id = null, $nom = null, $description = null, $prix = null){
                parent::__construct();
                $this->id = $id;
                $this->nom = $nom;
                $this->description = $description;
                $this->prix = $prix;

            }
            public function getAll(){
                $sql = "SELECT * FROM produit";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $produits;
            }
    
    }
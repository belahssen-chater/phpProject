<?php
require_once(__DIR__ .  "/../Database.php");

    class Produit extends Modele{ 
            
            public ?int $id;
            public ?string $nom;
            public ?string $description;
            public ?int $prix;
    
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


            
            public function save(){
                $sql = "INSERT INTO produit (nom, description, prix) VALUES (:nom, :description, :prix)";
                $stmt = $this->pdo->prepare($sql);
                $rowsAffected = $stmt->execute([
                    ":nom" => $this->nom,
                    ":description" => $this->description,
                    ":prix" => $this->prix
                ]);
                return $rowsAffected == 1;
            }
            public function delete(){
                $sql = "DELETE FROM produit WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $rowsAffected = $stmt->execute([":id" => $this->id]);
                return $rowsAffected == 1;
            }

            public function update(){
                $sql = "UPDATE produit SET nom = :nom, description = :description, prix = :prix WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $rowsAffected = $stmt->execute([
                    ":nom" => $this->nom,
                    ":description" => $this->description,
                    ":prix" => $this->prix,
                    ":id" => $this->id
                ]);
                return $rowsAffected == 1;
            }
        
            public function getProduit($id){
                $sql = "SELECT * FROM produit WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":id" => $id]);
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);
                return $produit;
            }

            public function getProduitByNom($nom){
                $sql = "SELECT * FROM produit WHERE nom = :nom";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":nom" => $nom]);
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);
                return $produit;
            }
            
            public function getProduitByDescription($description){
                $sql = "SELECT * FROM produit WHERE description = :description";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":description" => $description]);
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);
                return $produit;
            }

            public function getProduitByPrix($prix){
                $sql = "SELECT * FROM produit WHERE prix = :prix";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":prix" => $prix]);
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);
                return $produit;
            }


            public function getAllByKeyword($keyword){
                $sql = "SELECT * FROM produit WHERE nom LIKE :keyword OR description LIKE :keyword ORDER BY id DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":keyword" => "%$keyword%"]);
                $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $produits;
            }

            public function getAllByKeywordAndCategorie($keyword, $categorie){
                $sql = "SELECT * FROM produit WHERE (nom LIKE :keyword OR description LIKE :keyword) AND categorie = :categorie ORDER BY id DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":keyword" => "%$keyword%", ":categorie" => $categorie]);
                $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $produits;
            }

            public function getAllByCategorie($categorie){
                $sql = "SELECT * FROM produit WHERE categorie = :categorie ORDER BY id DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([":categorie" => $categorie]);
                $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $produits;
            }

        
    
    }
<?php
require_once("../Database.php");

    class Produit{
            
            private $id;
            private $nom;
            private $description;
            private $prix;
            private $image;
            private $categorie;
    
            public function __construct($id = null, $nom = null, $description = null, $prix = null, $image = null, $categorie = null){
                $this->id = $id;
                $this->nom = $nom;
                $this->description = $description;
                $this->prix = $prix;
                $this->image = $image;
                $this->categorie = $categorie;
            }
    
            public function create($data){
                $db = new Database();
                $db->query("INSERT INTO produits (nom, description, prix, image, categorie) VALUES (:nom, :description, :prix, :image, :categorie)");
                $db->bind(':nom', $data['nom']);
                $db->bind(':description', $data['description']);
                $db->bind(':prix', $data['prix']);
                $db->bind(':image', $data['image']);
                $db->bind(':categorie', $data['categorie']);
                $db->execute();
            }
    
            public function read(){
                $db = new Database();
                $db->query("SELECT * FROM produits");
                $result = $db->resultSet();
                return $result;
            }
    
            public function readById($id){
                $db = new Database();
                $db->query("SELECT * FROM produits WHERE id = :id");
                $db->bind(':id', $id);
                $result = $db->single();
                return $result;
            }
    
            public function update($data){
                $db = new Database();
                $db->query("UPDATE produits SET nom = :nom, description = :description, prix = :prix, image = :image, categorie = :categorie WHERE id = :id");
                $db->bind(':id', $data['id']);
                $db->bind(':nom', $data['nom']);
                $db->bind(':description', $data['description']);
                $db->bind(':prix', $data['prix']);
                $db->bind(':image', $data['image']);
                $db->bind(':categorie', $data['categorie']);
                $db->execute();
            }
    
            public function delete($id){
                $db = new Database();
                $db->query("DELETE FROM produits WHERE id = :id");
                $db->bind(':id', $id);
                $db->execute();
            }
    }
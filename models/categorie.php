<?php
require_once("../Database.php");
class categorie 
{
    private $id;
    private $nom;
    private $description;
    private $image;
    private $produits;
    public function __construct($id = null, $nom = null, $description = null, $image = null, $produits = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->produits = $produits;
    }
    public function create($data)
    {
        $db = new Database();
        $db->query("INSERT INTO categories (nom, description, image) VALUES (:nom, :description, :image)");
        $db->bind(':nom', $data['nom']);
        $db->bind(':description', $data['description']);
        $db->bind(':image', $data['image']);
        $db->execute();
    }
    public function read()
    {
        $db = new Database();
        $db->query("SELECT * FROM categories");
        $result = $db->resultSet();
        return $result;
    }
    public function readById($id)
    {
        $db = new Database();
        $db->query("SELECT * FROM categories WHERE id = :id");
        $db->bind(':id', $id);
        $result = $db->single();
        return $result;
    }
    public function update($data)
    {
        $db = new Database();
        $db->query("UPDATE categories SET nom = :nom, description = :description, image = :image WHERE id = :id");
        $db->bind(':id', $data['id']);
        $db->bind(':nom', $data['nom']);
        $db->bind(':description', $data['description']);
        $db->bind(':image', $data['image']);
        $db->execute();
    }
    public function delete($id)
    {
        $db = new Database();
        $db->query("DELETE FROM categories WHERE id = :id");
        $db->bind(':id', $id);
        $db->execute();
    }
    public function getProduits()
    {
        $db = new Database();
        $db->query("SELECT * FROM produits WHERE categorie = :categorie");
        $db->bind(':categorie', $this->id);
    }
}

?>
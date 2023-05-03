<?php
require_once(__DIR__ .  "/../Database.php");
class categorie   extends Modele{

public ?int $id;
public ?string $nom;


public function __construct($id = null, $nom = null){
    parent::__construct();
    $this->id = $id;
    $this->nom = $nom;
}

public function getAll(){
    $sql = "SELECT * FROM categorie";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
}

public function save(){
    $sql = "INSERT INTO categorie (nom) VALUES (:nom)";
    $stmt = $this->pdo->prepare($sql);
    $rowsAffected = $stmt->execute([
        ":nom" => $this->nom
    ]);
    return $rowsAffected == 1;
}
public function delete(){
    $sql = "DELETE FROM categorie WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $rowsAffected = $stmt->execute([":id" => $this->id]);
    return $rowsAffected == 1;
}

public function update(){
    $sql = "UPDATE categorie SET nom = :nom WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $rowsAffected = $stmt->execute([
        ":nom" => $this->nom,
        ":id" => $this->id
    ]);
    return $rowsAffected == 1;
}

public function getCategorie($id){
    $sql = "SELECT * FROM categorie WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'categorie');
    $categorie = $stmt->fetch(PDO::FETCH_CLASS);
    return $categorie;
}


}


?>
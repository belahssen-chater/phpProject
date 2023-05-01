<?php
//modififier produit
require_once("../../models/produit.php");
$produit = new Produit();
$produit->id = $_GET['id'];
$produit->getById();
if(isset($_POST['modifierProduit_btn']))
{
    $produit->nom = $_POST['nom'];
    $produit->prix = $_POST['prix'];
    $produit->description = $_POST['description'];
    $produit->categorie = $_POST['categorie'];
    $produit->image = $_POST['image'];
    $produit->update();
    header("Location: ./produits.php");
}


?>
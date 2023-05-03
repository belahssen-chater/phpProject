<?php
    require_once("../../models/Produit.php");

    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    $produit = new Produit();
    $produit->nom = $nom;
    $produit->prix = $prix;
    $produit->description = $description;
    $res = $produit->save();

    if($res){
        header("location:../../views/admin/products.php?add=1");
    }else{
        header("location:../../views/admin/products.php?add=0");
    }

?>
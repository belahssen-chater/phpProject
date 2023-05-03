<?php
//modififier produit
require_once("../../models/produit.php");
$produit = new Produit();
$produit->id = $_POST['id'];
$produit->nom = $_POST['nom'];
$produit->prix = $_POST['prix'];
$produit->description = $_POST['description'];
$res = $produit->update();
if($res){
    header("location:../../views/admin/products.php?update=1");
}else{
    header("location:../../views/admin/products.php?update=0");
}


?>
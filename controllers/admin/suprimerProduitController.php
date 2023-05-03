<?php

    require_once("../../models/Produit.php");

    $id = $_GET['id'];

    // ask confirmation
    // with javascript


    $produit = new Produit();
    $produit->id = $id;
    $res = $produit->delete();

    if($res){
        header("location:../../views/admin/products.php?delete=1");
    }else{
        header("location:../../views/admin/products.php?delete=0");
    }
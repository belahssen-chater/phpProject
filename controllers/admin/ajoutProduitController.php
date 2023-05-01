<?php

    $data = [
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'prix' => $_POST['prix'],
        'image' => $_POST['image'],
        'categorie' => $_POST['categorie']
    ];

    $produit = new Produit();
    $produit->create($data);
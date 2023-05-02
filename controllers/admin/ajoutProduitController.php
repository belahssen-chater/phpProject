<?php

    $data = [
        'id' => $_POST['id'],
        'nom' => $_POST['Name'],
        'description' => $_POST['Description'],
        'prix' => $_POST['price'],
 
    ];

    $produit = new Produit();
    $produit->insert($data);
    header('Location: index.php?controller=admin&task=produit');
?>
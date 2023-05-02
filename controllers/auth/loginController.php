<?php

$data=[
    'email' => $_POST['email'],
    'pwd' => $_POST['pwd']
];
//si role = 1 alors admin ce connecter a la page index.php else si role = 0 alors utilisateur ce connecter a la page indexcl.php sinon message d'erreur

$utilisateur = new Utilisateur();
$utilisateur-> login($data);
if($utilisateur->role == 1){
    header('Location: index.php?controller=admin&task=produit');
}elseif($utilisateur->role == 0){
    header('Location: index.php?controller=client&task=produit');
}else{
    echo "erreur";
}


?>
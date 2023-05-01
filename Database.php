<?php
abstract class Modele {
protected $pdo;
function __construct()
{
$this->pdo =new PDO('mysql:host=localhost;dbname=societe_chater_freres','root','');
}
function __destruct()
{
$this->pdo=null;
}



}
?>
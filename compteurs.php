<?php

require_once('config/bdd/bdd.php');

$reqArt = $conn->prepare("SELECT COUNT(*) AS NMBRE_ARTICLE  FROM articles"); 
$reqArt->execute();
$ligneArt=$reqArt->fetch(PDO::FETCH_ASSOC);
$nmbrArticle=$ligneArt['NMBRE_ARTICLE'];


$reqCat = $conn->prepare("SELECT COUNT(*) AS NMBRE_CAT  FROM categories"); 
$reqCat->execute();
$ligneCat=$reqCat->fetch(PDO::FETCH_ASSOC);
$nmbrCat=$ligneCat['NMBRE_CAT'];

$date_fac =  date('Y-m-d');
$reqEntree = $conn->prepare("SELECT COUNT(*) AS NMBRE_MOUV  FROM mouvements WHERE mouvement_date = ? AND type = 'entree' "); 
$reqEntree->execute(array($date_fac));
$ligneEntree=$reqEntree->fetch(PDO::FETCH_ASSOC);
$nmbrEntree=$ligneEntree['NMBRE_MOUV'];

$date_fac =  date('Y-m-d');
$reqSortie = $conn->prepare("SELECT COUNT(*) AS NMBRE_MOUV  FROM mouvements WHERE mouvement_date = ? AND type = 'sortie' "); 
$reqSortie->execute(array($date_fac));
$ligneSortie=$reqSortie->fetch(PDO::FETCH_ASSOC);
$nmbrSortie=$ligneSortie['NMBRE_MOUV'];

?>
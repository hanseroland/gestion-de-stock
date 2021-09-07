<?php
header('Content-Type: application/json');

require_once('../bdd/bdd.php');
$reqQte = $conn->prepare("SELECT nom_article,quantite FROM articles WHERE YEAR(date_ajout) = YEAR(CURRENT_DATE())"); 
$reqQte->execute();
$resultQte = $reqQte->fetchAll(); 


$dataQte = array();
foreach ($resultQte as $rowQte) {
	$dataQte[] = array(
        'article' => $rowQte["nom_article"],
        'quantite' => $rowQte["quantite"],
        "couleur" => '#'.rand(100000,999999).''
    );
}

echo json_encode($dataQte);
?>
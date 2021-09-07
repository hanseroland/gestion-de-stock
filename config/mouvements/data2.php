<?php
header('Content-Type: application/json');

require_once('../bdd/bdd.php');

$reqG2 = $conn->prepare("SELECT mois,type, SUM(quantite) as quantite FROM mouvements WHERE type='entree'  AND YEAR(mouvement_date) = YEAR(CURRENT_DATE()) GROUP BY mois,type"); 
$reqG2->execute();
$resultG2 = $reqG2->fetchAll(); 


$data2 = array();
foreach ($resultG2 as $row2) {
	$data2[] = $row2;
}

echo json_encode($data2);
?>
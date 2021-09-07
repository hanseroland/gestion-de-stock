<?php
header('Content-Type: application/json');

require_once('../bdd/bdd.php');

$reqG3 = $conn->prepare("SELECT mois,type, SUM(quantite) as quantite FROM mouvements WHERE type='sortie'  AND YEAR(mouvement_date) = YEAR(CURRENT_DATE()) GROUP BY mois,type"); 
$reqG3->execute();
$resultG3 = $reqG3->fetchAll(); 


$data3 = array();
foreach ($resultG3 as $row3) {
	$data3[] = $row3;
}

echo json_encode($data3);
?>
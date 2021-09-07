<?php
header('Content-Type: application/json');

require_once('../bdd/bdd.php');

$reqG4 = $conn->prepare("SELECT mois,type, SUM(montant) as montant FROM mouvements WHERE type='sortie'  AND YEAR(mouvement_date) = YEAR(CURRENT_DATE())  GROUP BY mois,type"); 
$reqG4->execute();
$resultG4 = $reqG4->fetchAll(); 


$data4 = array();
foreach ($resultG4 as $row4) {
	$data4[] = $row4;
}

echo json_encode($data4);
?>
<?php
header('Content-Type: application/json');

require_once('../bdd/bdd.php');
$date1 = date("Y");
$reqG1 = $conn->prepare("SELECT mois,type, SUM(montant) as montant FROM mouvements WHERE type='entree'  AND YEAR(mouvement_date) = YEAR(CURRENT_DATE())  GROUP BY mois,type"); 
$reqG1->execute();
$resultG1 = $reqG1->fetchAll(); 


$data = array();
foreach ($resultG1 as $row) {
	$data[] = $row;
}

echo json_encode($data);
?>
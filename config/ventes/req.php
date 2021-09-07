<?php

$requete = $conn->prepare("SELECT * FROM articles"); 
$requete->execute();
$resultats = $requete->fetchAll();

$reqCli = $conn->prepare("SELECT * FROM clients"); 
$reqCli->execute();
$resultatsCli = $reqCli->fetchAll();
?>
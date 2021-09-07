<?php


# --------------------
# METHOD 2 
# --------------------
# using arrays without setting the locale ( not recommanded )
$day = array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"); 
$month = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"); 
// Now
$gDate = explode('|', date("w|d|n|Y"));
// Given time
$timestamp = time () ;
$gDate = explode('|', date( "w|d|n|Y", $timestamp ));
//echo $day[$gDate[0]] . ' ' . $gDate[1] . ' ' . $month[$gDate[2]-1] . ' ' . $gDate[3] ; // Lundi 02 mars 2015
$jour = $day[$gDate[0]];
$mois = $month[$gDate[2]-1];

 
?>
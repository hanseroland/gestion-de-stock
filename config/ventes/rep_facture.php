<?php 
session_start();
if(!$_SESSION['PROFILE']){
	header('Location:../../login.php');
  }

include("../bdd/bdd.php");
require('../getDate.php');
   
	
		if(isset($_POST["param"]))
		{		
			switch($_POST["param"])
			{


				case "recup_article":
					
					$requete_ref = $conn->prepare("SELECT * FROM articles WHERE ref_article = '".$_POST["ref_article"]."'; "); 
					$requete_ref->execute();
					$resultats_ref = $requete_ref->fetch();
					$chaine = $resultats_ref['id_article']."|".$resultats_ref['nom_article']."|".$resultats_ref['categorie']."|".$resultats_ref['prix_de_vente']."|".$resultats_ref['quantite'];
					print($chaine);
	
				break;
				
				case "recup_client":
					$requete_cli = $conn->prepare("SELECT * FROM clients WHERE ref_client = '".$_POST["ref_client"]."'; "); 
					$requete_cli->execute();
					$resultats_cli = $requete_cli->fetch();
					$chaine = $resultats_cli['nom_client'];
					print($chaine);
				
				break;

				case "creer_client":
					$requete_cli = $conn->prepare("SELECT COUNT(ref_client) AS nb FROM clients WHERE nom_client='".$_POST["nom_client"]."';");
					$requete_cli->execute();
					$resultats_cli = $requete_cli->fetch();
					if($resultats_cli["nb"]>0)	
						print("nok");
					else 
					{
						$requete_cli =$conn->prepare("INSERT INTO clients(nom_client) VALUES (?)");
						$requete_cli->execute(array($_POST['nom_client']));
						$dernier_id= $conn->lastInsertId();
						/*if($requete_cli==1)
							print($dernier_id);	
							
							  /********************************************* */
							 /* $username = $_POST['username'];
							  $date =  date('Y-m-d');
							  $action = 'Ajout Client';
							  $detail = $_POST['nom_client'];
							  $reqHis = $conn->prepare('INSERT INTO historique (his_action,his_detail,his_date,his_utilisateur)
							  VALUES (?,?,?,?)');
							  $param = array($action,$detail,$date,$username);
							  $reqHis->execute($param);*/
							  /********************************************* */

					}
				break; 
				case "facturer":
					
					//$username = $_POST['username'];
                    $username = $_SESSION['PROFILE']['nom'];
					$ref_cli = $_POST['ref_client'];
					$date_fac =  date('Y-m-d');
					$montant_total = $_POST['total_com'];
					//$catA = $_POST['categorie'];
					$catA = 'batiment'; 
					$text_com = $_POST["chaine_com"];
					$tab_com = explode('|', $text_com);
					$type = "sortie";

					$req =$conn->prepare("INSERT INTO commandes(ref_client,total_commande,vendeur,date,jours,mois) VALUES (?,?,?,?,?,?)");
					$req->execute(array($ref_cli,$montant_total,$username,$date_fac,$jour,$mois));

					  if($req==1)
						{
							$dernier_id= $conn->lastInsertId();

                             /******/
							/* 	$date =  date('Y-m-d');
								$action = 'Ajout Commande du client';
								$detail = $ref_cli;
								$reqHis = $conn->prepare('INSERT INTO historique (his_action,his_detail,his_date,his_utilisateur)
								VALUES (?,?,?,?)');
								$param = array($action,$detail,$date,$username);
								$reqHis->execute($param);*/
								/**** */ 

                           
							for($ligne=0;$ligne<sizeof($tab_com);$ligne++)
							{
								if($tab_com[$ligne]!="")
								{
									

									$ligne_com = explode(";",$tab_com[$ligne]);
									$montant = $ligne_com[1]*$ligne_com[3];
									$reqv =$conn->prepare("INSERT INTO ventes(id_commande,ref_article,nom_article,quantite_vendue,prix_de_vente,total_vente,date,jours,mois) 
														VALUES (?,?,?,?,?,?,?,?,?)");
									$reqv->execute(array($dernier_id,$ligne_com[0],$ligne_com[2],$ligne_com[1],$ligne_com[3],$montant,$date_fac,$jour,$mois));
									 
								
									$requete_art = $conn->prepare('UPDATE articles SET quantite = quantite - ? WHERE ref_article = ?'); 
									$requete_art->execute(array($ligne_com[1],$ligne_com[0]));

									/*********************Mouvement************************ */
									
									$reqMouv = $conn->prepare('INSERT INTO mouvements (id_article,ref_article,nom_article,categorie,quantite,montant,type,mouvement_date,jours,mois) VALUES (?,?,?,?,?,?,?,?,?,?)');
									$paramMouv = array($ligne_com[4],$ligne_com[0],$ligne_com[2],$ligne_com[5],$ligne_com[1],$montant,$type,$date_fac,$jour,$mois);
									$reqMouv->execute($paramMouv);

									
										/**** */ 
									    /*$date1 =  date('Y-m-d');
										$action1 = 'Ajout facture pour la commande : ';
										$details1 = $dernier_id;
										$reqHis1 = $conn->prepare('INSERT INTO historique (his_action,his_detail,his_date,his_utilisateur)
										VALUES (?,?,?,?)');
										$param1 = array($action,$details1,$date1,$username);
										$reqHis1->execute($param1);*/
									     /***/

										
									}
							}
							print($ref_cli."-".$dernier_id);
						}
						else
						{
							print("nok");
						}
				
				break;

		
			
		
			}
		}
	
	
?>